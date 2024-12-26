<?php
class ApiController
{
    public function verifyLogin()
    {
        $token = $_COOKIE['user_login'] ?? null;

        if (!$token) {
            echo json_encode(['success' => false, 'message' => 'Token is missing']);
            return;
        }

        $db = new Database();
        $pdo = $db->getConnection();

        $stmt = $pdo->prepare("SELECT user_id, username, avatar_path FROM user WHERE token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo json_encode([
                'success' => true,
                'username' => $user['username'],
                'avatarPath' => $user['avatar_path'],
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid token'
            ]);
        }
    }

    public function getEventsTimes() {
        try {
            $db = new Database();
            $pdo = $db->getConnection();
    
            // 查询事件及其时间段
            $query = "
                SELECT 
                    e.event_id AS event_id, 
                    e.event_name AS event_name, 
                    t.start_time, 
                    t.end_time 
                FROM 
                   volunteerevent e
                JOIN 
                    event_times t 
                ON 
                    e.event_id = t.event_id
                ORDER BY 
                    e.event_id, t.start_time
            ";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if (!$results) {
                echo json_encode(['success' => false, 'message' => 'No events or times found.']);
                return;
            }
    
            // 处理数据，按事件分组
            $events = [];
            foreach ($results as $row) {
                $eventId = $row['event_id'];
                if (!isset($events[$eventId])) {
                    $events[$eventId] = [
                        'event_id' => $eventId,
                        'event_name' => htmlspecialchars($row['event_name'], ENT_QUOTES, 'UTF-8'),
                        'times' => []
                    ];
                }
                $events[$eventId]['times'][] = [
                    'start' => $row['start_time'],
                    'end' => $row['end_time']
                ];
            }
    
            // 返回 JSON 格式响应
            echo json_encode(['success' => true, 'events' => array_values($events)]);
        } catch (Exception $e) {
            // 捕获并返回异常信息
            http_response_code(500);
            echo json_encode([
                'success' => false, 
                'message' => 'An error occurred while fetching event times.', 
                'error' => $e->getMessage()
            ]);
        }
    }
    
    public function getUserDetails() {
        try {

            $token = $_COOKIE['user_login'] ?? null;
            if (!$token) {
                echo json_encode(['success' => false, 'message' => 'Token is missing']);
                return;
            }

            $db = new Database();
            $pdo = $db->getConnection();

            $stmt = $pdo->prepare("SELECT user_id FROM user WHERE token = :token");
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                echo json_encode(['success' => false, 'message' => 'Invalid token']);
                return;
            }

            $userId = $user['user_id'];
    
            $query = "
                SELECT 
                    user_id, 
                    username, 
                    name,
                    email, 
                    contact_number, 
                    avatar_path 
                FROM 
                    user 
                WHERE 
                    user_id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userDetails) {
                echo json_encode(['success' => false, 'message' => 'User details not found.']);
                return;
            }

            echo json_encode(['success' => true, 'user' => $userDetails]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false, 
                'message' => 'An error occurred while fetching user details.', 
                'error' => $e->getMessage()
            ]);
        }
    }

    public function submitVolunteer() {
        try {
            // Check for user authentication token
            $token = $_COOKIE['user_login'] ?? null;
            if (!$token) {
                echo json_encode(['success' => false, 'message' => 'Authentication token is missing.']);
                return;
            }
    
            $db = new Database();
            $pdo = $db->getConnection();
    
            // Validate the token and fetch the user
            $stmt = $pdo->prepare("SELECT user_id FROM user WHERE token = :token");
            $stmt->bindParam(':token', $token);
            $stmt->execute();
    
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$user) {
                echo json_encode(['success' => false, 'message' => 'Invalid or expired token.']);
                return;
            }
    
            $userId = $user['user_id'];
    
            // Parse input data
            $data = json_decode(file_get_contents('php://input'), true);
            $name = trim($data['name'] ?? '');
            $email = trim($data['email'] ?? '');
            $phone = trim($data['phone'] ?? '');
            $events = $data['selectedEvents'] ?? [];
    
            // Validate input fields
            if (empty($name) || empty($email) || empty($phone) || empty($events)) {
                echo json_encode(['success' => false, 'message' => 'All fields are required.']);
                return;
            }
    
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
                return;
            }
    
            if (!preg_match('/^\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}$/', $phone)) {
                echo json_encode(['success' => false, 'message' => 'Invalid phone number format.']);
                return;
            }
    
            // Update user information
            $updateQuery = "
                UPDATE user
                SET name = :name, email = :email, contact_number = :phone
                WHERE user_id = :user_id";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->bindParam(':name', $name);
            $updateStmt->bindParam(':email', $email);
            $updateStmt->bindParam(':phone', $phone);
            $updateStmt->bindParam(':user_id', $userId);
            $updateStmt->execute();
    
            $responseMessages = [];
    
            // Prepare SQL queries
            $checkQuery = "
                SELECT v.id, ve.event_name
                FROM volunteer v
                JOIN volunteerevent ve ON v.event_id = ve.event_id
                WHERE v.user_id = :user_id AND v.event_id = :event_id AND v.time_slot = :time_slot";
            $checkStmt = $pdo->prepare($checkQuery);
    
            $updateVolunteerQuery = "
                UPDATE volunteer
                SET time_slot = :time_slot
                WHERE id = :id";
            $updateVolunteerStmt = $pdo->prepare($updateVolunteerQuery);
    
            $insertQuery = "
                INSERT INTO volunteer (user_id, event_id, time_slot) 
                VALUES (:user_id, :event_id, :time_slot)";
            $insertStmt = $pdo->prepare($insertQuery);
    
            foreach ($events as $event) {
                $eventId = $event['event_id'] ?? null;
                $time = $event['time'] ?? '';
    
                if (!$eventId || !$time) {
                    continue;
                }
    
                // Check if the registration already exists
                $checkStmt->bindParam(':user_id', $userId);
                $checkStmt->bindParam(':event_id', $eventId);
                $checkStmt->bindParam(':time_slot', $time);
                $checkStmt->execute();
    
                $existing = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
                if ($existing) {
                    // Update the existing registration
                    $updateVolunteerStmt->bindParam(':time_slot', $time);
                    $updateVolunteerStmt->bindParam(':id', $existing['id']);
                    $updateVolunteerStmt->execute();
                    $responseMessages[] = "Updated registration for {$existing['event_name']} with time slot {$time}. </br>";
                } else {
                    // Insert a new registration
                    $insertStmt->bindParam(':user_id', $userId);
                    $insertStmt->bindParam(':event_id', $eventId);
                    $insertStmt->bindParam(':time_slot', $time);
                    $insertStmt->execute();
    
                    $eventNameStmt = $pdo->prepare("SELECT event_name FROM volunteerevent WHERE id = :event_id");
                    $eventNameStmt->bindParam(':event_id', $eventId);
                    $eventNameStmt->execute();
                    $eventName = $eventNameStmt->fetchColumn();
    
                    $responseMessages[] = "Inserted new registration for {$eventName} with time slot {$time}. </br>";
                }
            }
    
            echo json_encode([
                'success' => true,
                'message' => implode(' ', $responseMessages),
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }    
     
}
