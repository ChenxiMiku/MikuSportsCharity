<?php

class ApiController
{
    // Get user ID from token
    private function getUserIdFromToken($pdo)
    {
        $token = $_COOKIE['user_login'] ?? null;

        if (!$token) {
            throw new Exception('Authentication token is missing.');
        }

        $stmt = $pdo->prepare("SELECT user_id FROM user WHERE token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception('Invalid or expired token.');
        }

        return $user['user_id'];
    }

    // Get database connection
    private function getDatabaseConnection()
    {
        $db = new Database();
        return $db->getConnection();
    }

    // Validate email
    private function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email address.');
        }
    }

    private function validatePhone($phone)
    {
        if (!preg_match('/^\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}$/', $phone)) {
            throw new Exception('Invalid phone number format.');
        }
    }



    // Verify login
    public function verifyLogin()
    {
        try {
            $pdo = $this->getDatabaseConnection();
            $userId = $this->getUserIdFromToken($pdo);

            $stmt = $pdo->prepare("SELECT username, `role`, avatar_path FROM user WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                echo json_encode(['success' => false, 'message' => 'User not found']);
                return;
            }

            echo json_encode([
                'success' => true,
                'username' => $user['username'],
                'avatarPath' => $user['avatar_path'],
                'role' => $user['role']
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Get all events
    public function getEventsTimes()
    {
        try {
            $pdo = $this->getDatabaseConnection();

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
                    e.event_id, t.start_time";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$results) {
                echo json_encode(['success' => false, 'message' => 'No events or times found.']);
                return;
            }

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

            echo json_encode(['success' => true, 'events' => array_values($events)]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Get user details
    public function getUserDetails()
    {
        try {
            $pdo = $this->getDatabaseConnection();
            $userId = $this->getUserIdFromToken($pdo);

            $stmt = $pdo->prepare("
                SELECT 
                    user_id, username, name, email, contact_number, role, created_at, avatar_path 
                FROM user 
                WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userDetails) {
                echo json_encode(['success' => false, 'message' => 'User details not found.']);
                return;
            }

            echo json_encode(['success' => true, 'user' => $userDetails]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Change user password
    public function changePassword()
    {
        try {
            $pdo = $this->getDatabaseConnection();
            $userId = $this->getUserIdFromToken($pdo);

            $data = json_decode(file_get_contents('php://input'), true);
            $currentPassword = trim($data['oldPassword'] ?? '');
            $newPassword = trim($data['newPassword'] ?? '');

            if (empty($currentPassword) || empty($newPassword)) {
                throw new Exception('All fields are required.');
            }

            $stmt = $pdo->prepare("SELECT password FROM user WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user || !password_verify($currentPassword, $user['password'])) {
                throw new Exception('Current password is incorrect.');
            }

            $updateQuery = "
                UPDATE user
                SET password = :password
                WHERE user_id = :user_id";
            $stmt = $pdo->prepare($updateQuery);
            $stmt->bindParam(':password', password_hash($newPassword, PASSWORD_DEFAULT));
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Password changed successfully.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Change user avatar
    public function changeAvatar()
    {
        try {
            $pdo = $this->getDatabaseConnection();
            $userId = $this->getUserIdFromToken($pdo);

            if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('File upload failed.');
            }

            $file = $_FILES['avatar'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxFileSize = 2 * 1024 * 1024;

            if (!in_array($file['type'], $allowedTypes)) {
                throw new Exception('Invalid file type. Only JPEG, PNG, and GIF are allowed.');
            }

            if ($file['size'] > $maxFileSize) {
                throw new Exception('File size exceeds the 2MB limit.');
            }

            $uploadDir = '../upload/avatars/';
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = $userId . '_' . time() . '.' . $extension;
            $filePath = $uploadDir . $fileName;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                throw new Exception('Failed to save the uploaded file.');
            }

            $relativePath = '../upload/avatars/' . $fileName;

            $updateQuery = "
                UPDATE user
                SET avatar_path = :avatar_path
                WHERE user_id = :user_id";
            $stmt = $pdo->prepare($updateQuery);
            $stmt->bindParam(':avatar_path', $relativePath);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Avatar updated successfully.', 'avatarPath' => $relativePath]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateProfile()
    {
        try {
            $pdo = $this->getDatabaseConnection();
            $userId = $this->getUserIdFromToken($pdo);

            $data = json_decode(file_get_contents('php://input'), true);
            $name = trim($data['name'] ?? '');
            $email = trim($data['email'] ?? '');
            $phone = trim($data['phone'] ?? '');

            if (empty($name) || empty($email) || empty($phone)) {
                throw new Exception('All fields are required.');
            }

            $this->validateEmail($email);
            $this->validatePhone($phone);

            $updateQuery = "
                UPDATE user
                SET name = :name, email = :email, contact_number = :phone
                WHERE user_id = :user_id";
            $stmt = $pdo->prepare($updateQuery);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function submitVolunteer()
    {
        try {
            $pdo = $this->getDatabaseConnection();
            $userId = $this->getUserIdFromToken($pdo);

            $data = json_decode(file_get_contents('php://input'), true);
            $name = trim($data['name'] ?? '');
            $email = trim($data['email'] ?? '');
            $phone = trim($data['phone'] ?? '');
            $events = $data['selectedEvents'] ?? [];

            if (empty($name) || empty($email) || empty($phone) || empty($events)) {
                throw new Exception('All fields are required.');
            }

            $this->validateEmail($email);
            $this->validatePhone($phone);

            $updateUserQuery = "
                UPDATE user
                SET name = :name, email = :email, contact_number = :phone
                WHERE user_id = :user_id";
            $stmt = $pdo->prepare($updateUserQuery);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            $responseMessages = [];

            $volunteerQuery = "
                INSERT INTO volunteer (user_id, event_id, time_slot)
                VALUES (:user_id, :event_id, :time_slot)
                ON DUPLICATE KEY UPDATE time_slot = VALUES(time_slot)";
            $volunteerStmt = $pdo->prepare($volunteerQuery);

            foreach ($events as $event) {
                $eventId = $event['event_id'] ?? null;
                $timeSlot = $event['time'] ?? null;

                if (!$eventId || !$timeSlot) {
                    continue;
                }

                $volunteerStmt->bindParam(':user_id', $userId);
                $volunteerStmt->bindParam(':event_id', $eventId);
                $volunteerStmt->bindParam(':time_slot', $timeSlot);
                $volunteerStmt->execute();

                $eventNameQuery = "SELECT event_name FROM volunteerevent WHERE event_id = :event_id";
                $eventNameStmt = $pdo->prepare($eventNameQuery);
                $eventNameStmt->bindParam(':event_id', $eventId);
                $eventNameStmt->execute();
                $eventName = $eventNameStmt->fetchColumn() ?? 'Unknown Event';

                $responseMessages[] = "Registered for event '{$eventName}' at time slot '{$timeSlot}'.";
            }

            echo json_encode([
                'success' => true,
                'message' => implode(' ', $responseMessages),
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
