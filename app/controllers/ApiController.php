<?php

class ApiController extends Controller
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

    public function updateCharity()
    {

        $data = json_decode(file_get_contents('php://input'), true);
        $action = $data['action'] ?? null;

        if (!$action) {
            echo json_encode(['success' => false, 'message' => 'Invalid action.']);
            return;
        }

        try {
            switch ($action) {
                case 'add':
                    $name = $data['name'] ?? '';
                    if (empty($name)) {
                        throw new Exception('Charity name is required.');
                    }

                    $id = $this->addCharityToDatabase($name);
                    echo json_encode(['success' => true, 'charity' => ['id' => $id, 'name' => $name]]);
                    break;

                case 'edit':
                    $id = $data['id'] ?? null;
                    $name = $data['name'] ?? '';
                    if (!$id || empty($name)) {
                        throw new Exception('Charity ID and name are required.');
                    }

                    $this->updateCharityInDatabase($id, $name);
                    echo json_encode(['success' => true]);
                    break;

                case 'delete':
                    $id = $data['id'] ?? null;
                    if (!$id) {
                        throw new Exception('Charity ID is required.');
                    }

                    $this->deleteCharityFromDatabase($id);
                    echo json_encode(['success' => true]);
                    break;

                default:
                    echo json_encode(['success' => false, 'message' => 'Unknown action.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function addCharityToDatabase($name)
    {
        $pdo = $this->getDatabaseConnection();
        $stmt = $pdo->prepare("INSERT INTO charity (charity_name) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $pdo->lastInsertId();
    }

    private function updateCharityInDatabase($id, $name)
    {
        $pdo = $this->getDatabaseConnection();
        $stmt = $pdo->prepare("UPDATE charity SET charity_name = :name WHERE charity_id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    private function deleteCharityFromDatabase($id)
    {
        $pdo = $this->getDatabaseConnection();
        $stmt = $pdo->prepare("DELETE FROM charity WHERE charity_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function volunteerEvents()
    {
        try {
            $volunteerEventModel = $this->model('VolunteerEvent');
            $events = $volunteerEventModel->getAllWithCharity();

            echo json_encode(['success' => true, 'events' => $events]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function donations()
    {
        try {
            $donationModel = $this->model('Donation');
            $donations = $donationModel->getAllDonations();

            echo json_encode(['success' => true, 'donations' => $donations]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateEvent()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $eventName = $data['title'] ?? '';
            $charityName = $data['charityName'] ?? '';
            $description = $data['description'] ?? '';
            $location = $data['eventLocation'] ?? '';
            $date = $data['eventDate'] ?? '';
            $endTime = $data['end_time'] ?? '';
            $fundingGoal = $data['fundingGoal'] ?? 0;
            $type = $data['type'] ?? '';
            $volunteerGoal = $data['volunteerGoal'] ?? 0;
            $action = $data['action'] ?? '';
            $image_path = $data['image_path'] ?? 'images/image.png';
            $data['id'] = $data['id'] ?? null;

            $timeSlots = $data['timeSlots'] ?? [];

            $charityModel = $this->model('Charity');
            $charityId = $charityModel->getCharityIdByName($charityName);

            if ($type === 'donation') {
                $donationModel = $this->model('Donation');
                if ($action === 'create') {
                    $donationModel->addDonation($eventName, $charityId, $description, $fundingGoal, $image_path);
                } else if ($action === 'delete') {
                    $donationId = $data['id'] ?? null;
                    if (!$donationId) {
                        throw new Exception('Donation ID is required.');
                    }
                    $donationModel->deleteDonation($donationId);
                } else {
                    $donationId = $data['id'] ?? null;
                    if (!$donationId) {
                        throw new Exception('Donation ID is required.');
                    }
                    $donationModel->updateDonation($donationId, $eventName, $charityId, $description, $fundingGoal);
                }
            } else {
                $volunteerEventModel = $this->model('VolunteerEvent');
                if ($action === 'create') {
                    $newEventId = $volunteerEventModel->addEvent($eventName, $charityId, $description, $location, $date, $volunteerGoal);

                    foreach ($timeSlots as $slot) {
                        $startTime = $slot['startTime'] ?? null;
                        $endTime = $slot['endTime'] ?? null;

                        if ($startTime && $endTime) {
                            $volunteerEventModel->addEventTime($newEventId, $startTime, $endTime);
                        }
                    }
                } else if ($action === 'delete') {
                    $eventId = $data['id'] ?? null;
                    if (!$eventId) {
                        throw new Exception('Event ID is required.');
                    }
                    $volunteerEventModel->deleteEvent($eventId);
                } else {
                    $eventId = $data['id'] ?? null;
                    if (!$eventId) {
                        throw new Exception('Event ID is required.');
                    }
                    $volunteerEventModel->updateEvent($eventId, $eventName, $charityId, $description, $location, $date, $volunteerGoal);

                    // Delete existing timeSlots for this event and re-insert them
                    $volunteerEventModel->deleteEventTimes($eventId);
                    foreach ($timeSlots as $slot) {
                        $startTime = $slot['startTime'] ?? null;
                        $endTime = $slot['endTime'] ?? null;

                        if ($startTime && $endTime) {
                            $volunteerEventModel->addEventTime($eventId, $startTime, $endTime);
                        }
                    }
                }
            }

            echo json_encode(['success' => true, 'message' => 'Event updated successfully.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
