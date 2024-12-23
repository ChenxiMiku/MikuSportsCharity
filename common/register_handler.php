<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error_message'] = 'All fields are required.';
        header('Location: ../register.php');
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error_message'] = 'Passwords do not match.';
        header('Location: ../register.php');
        exit();
    }

    $score = 0;
    if (strlen($password) >= 8) $score += 1;
    if (strlen($password) >= 12) $score += 1; 
    if (preg_match('/[A-Za-z]/', $password)) $score += 1;
    if (preg_match('/\d/', $password)) $score += 1;
    if (preg_match('/[^A-Za-z\d]/', $password)) $score += 1;

    if ($score <= 2) {
        $_SESSION['error_message'] = 'Password is too weak. Please choose a stronger password.';
        header('Location: ../register.php');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = 'Invalid email format.';
        header('Location: ../register.php');
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $db = new Database();
    $conn = $db->getConnection();

    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error_message'] = 'Email is already registered.';
        header('Location: ../register.php');
        exit();
    }

    $stmt->close();

    $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Account created successfully. You can now log in.';
        header('Location: ../register.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Error occurred while creating the account.';
        header('Location: ../register.php');
        exit();
    }

    $stmt->close();
    $db->closeConnection();
}
