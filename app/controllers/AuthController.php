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

        if ($this->isLoggedIn()) {
            header('Location: /dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // 验证用户信息
            if ($this->validateLogin($email, $password)) {
                // 登录成功，设置 Cookie（有效期 30 天）
                $this->setLoginCookie($email);
                header('Location: /dashboard');
                exit;
            } else {
                $error = "Invalid email or password!";
                $this->view('auth/login', ['error' => $error]);
                return;
            }
        }

        // 渲染登录页面
        $this->view('auth/login', [
            'title' => "$title",
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'addressLink' => $addressLink,
            'description' => $description,
        ]);
    }

    // 验证登录
    public function validateLogin($email, $password) {
        // 数据库连接
        $db = new Database();
        $conn = $db->getConnection();
    
        // SQL 查询
        $sql = "SELECT * FROM user WHERE email = :email";  // 使用命名参数 :email
        $stmt = $conn->prepare($sql);
    
        // 绑定参数
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);  // 使用 bindValue
    
        // 执行查询
        $stmt->execute();
    
        // 检查用户是否存在
        if ($stmt->rowCount() == 1) {
            // 获取用户信息
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // 验证密码
            if (password_verify($password, $user['password'])) {
                return true;
            }
        }
    
        // 如果验证失败，返回 false
        return false;
    }
    

    // 设置登录 cookie
    private function setLoginCookie($email) {
        // 设置一个加密的 cookie，包含用户信息（建议加密）
        $cookieValue = base64_encode($email); // 简单示例：将用户的 email 编码
        setcookie('user_login', $cookieValue, time() + (30 * 24 * 60 * 60), '/', ''); // 30 天过期
    }

    // 检查是否已登录
    private function isLoggedIn() {
        // 检查 cookie 中是否有有效的登录信息
        if (isset($_COOKIE['user_login'])) {
            $cookieValue = base64_decode($_COOKIE['user_login']);
            return !empty($cookieValue); // 如果 cookie 存在并且有效
        }

        return false;
    }
    // 退出登录
    public function logout()
    {
        // 清除 cookie
        setcookie('user_login', '', time() - 3600, '/'); // 删除 cookie
        header('Location: /login'); // 重定向到登录页面
        exit;
    }
}
?>