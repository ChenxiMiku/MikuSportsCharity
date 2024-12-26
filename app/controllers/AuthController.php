<?php

class AuthController extends Controller
{
    public function login()
    {
        $title = $this->config('app')['title'];
        $email = $this->config('app')['email'];
        $phone = $this->config('app')['phone'];
        $address = $this->config('app')['address'];
        $addressLink = $this->config('app')['addressLink'];
        $description = $this->config('app')['description'];

        $this->view('auth/login', [
            'webTitle' => "Login - " . $title,
            'title' => $title,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'addressLink' => $addressLink,
            'description' => $description,
        ]);
    }
    public function register()
    {
        $title = $this->config('app')['title'];
        $email = $this->config('app')['email'];
        $phone = $this->config('app')['phone'];
        $address = $this->config('app')['address'];
        $addressLink = $this->config('app')['addressLink'];
        $description = $this->config('app')['description'];

        $this->view('auth/register', [
            'webTitle' => "$title",
            'title' => $title,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'addressLink' => $addressLink,
            'description' => $description,
        ]);
    }

    public function apiLogin()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['username']) || !isset($input['password'])) {
            echo json_encode(["success" => false, "message" => "Username and password are required."]);
            return;
        }

        $username = trim($input['username']);
        $password = $input['password'];

        $db = new Database();
        $pdo = $db->getConnection();

        $stmt = $pdo->prepare("SELECT user_id, password FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $token = bin2hex(random_bytes(32));

            $stmt = $pdo->prepare("UPDATE user SET token = :token WHERE user_id = :user_id");
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':user_id', $user['user_id']);
            $stmt->execute();

            setcookie("user_login", $token, time() + (30 * 24 * 60 * 60), "/", "", false, true);

            echo json_encode(["success" => true, "redirect" => "../public/dashboard"]);
        } else {
            echo json_encode(["success" => false, "message" => "Invalid username or password."]);
        }
    }

    public function apiRegister()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $username = $input['username'] ?? '';
        $email = $input['email'] ?? '';
        $password = $input['password'] ?? '';

        if (empty($username) || empty($email) || empty($password)) {
            echo json_encode(["success" => false, "message" => "All fields are required."]);
            return;
        }

        // Check if username already exists
        $db = new Database();
        $pdo = $db->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(["success" => false, "message" => "Username is already registered."]);
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedPassword);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "redirect" => "../public/login"]);
        } else {
            echo json_encode(["success" => false, "message" => "Registration failed. Please try again."]);
        }
    }

    public function apiLogout()
    {
        setcookie("user_login", "", time() - 3600, "/", "", false, true);
        echo json_encode(["success" => true, "message" => "Logged out successfully."]);
    }
}
