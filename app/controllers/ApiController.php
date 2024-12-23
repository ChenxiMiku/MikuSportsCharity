<?php
    // 在 AuthController 中新增 verifyLogin 方法
class AuthController {
    // 验证用户登录状态
    public function verifyLogin() {
        // 获取前端传递的电子邮件
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['email'])) {
            $email = $data['email'];

            $db = new Database();
            $conn = $db->getConnection();

            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'User not found']);
            }

            $stmt->close();
            $db->closeConnection();
        } else {
            echo json_encode(['success' => false, 'message' => 'No email provided']);
        }
    }
}
?>