<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json'); 
require_once '../common/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo json_encode(["success" => false, "message" => "Email and password are required."]);
        exit();
    }

    $db = new Database();
    $conn = $db->getConnection();

    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['username'];

            echo json_encode(["success" => true, "redirect" => "dashboard.php"]);
        } else {
            echo json_encode(["success" => false, "message" => "Invalid email or password!"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid email or password!"]);
    }

    $stmt->close();
    $db->closeConnection();
}
?>
