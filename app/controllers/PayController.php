<?php
class PayController extends Controller
{

    private $sign_type = 'MD5';

    private function getDatabaseConnection()
    {
        $db = new Database();
        return $db->getConnection();
    }

    public function pay()
    {
        $config = $this->config('pay');
        $notify_url = $config['notifyUrl'];
        $return_url = $config['returnUrl'];
        $apiPid = $config['apiPid'];

        $pdo = $this->getDatabaseConnection();

        $data = json_decode(file_get_contents('php://input'), true);
        $amount = $data['amount'] ?? null;
        $title = $data['eventName'] ?? null;
        $eventName = $title . ' Donation' ?? null;
        $donor_name = $data['name'] ?? null;
        $donor_email = $data['email'] ?? null;
        $anonymous = $data['anonymous'] ?? 0;

        if (!$amount || !$title || !$donor_name || !$donor_email) {
            echo json_encode(['success' => false, 'message' => 'Missing required parameters.']);
            return;
        }

        try {
            $sql = "SELECT donation_id FROM donation WHERE title = :title";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->execute();
            $donation_id = $stmt->fetch(PDO::FETCH_ASSOC)['donation_id'] ?? null;

            if (!$donation_id) {
                echo json_encode(['success' => false, 'message' => 'Donation project not found.']);
                return;
            }

            $sql = "INSERT INTO donation_records (amount, name, donor_name, donor_email, anonymous, donation_id) VALUES (:amount, :name, :donor_name, :donor_email, :anonymous, :donation_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $stmt->bindParam(':name', $eventName, PDO::PARAM_STR);
            $stmt->bindParam(':donor_name', $donor_name, PDO::PARAM_STR);
            $stmt->bindParam(':donor_email', $donor_email, PDO::PARAM_STR);
            $stmt->bindParam(':anonymous', $anonymous, PDO::PARAM_INT);
            $stmt->bindParam(':donation_id', $donation_id, PDO::PARAM_INT);
            $stmt->execute();

            $outTradeNo = $pdo->lastInsertId();

            $params = [
                'pid' => $apiPid,
                'type' => 'alipay',
                'out_trade_no' => $outTradeNo,
                'notify_url' => $notify_url,
                'return_url' => $return_url,
                'name' => $eventName,
                'money' => $amount,
            ];

            $html = $this->pagePay($params, 'Redirecting to Payment Page...');
            echo $html;
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error processing payment: ' . $e->getMessage()]);
        }
    }

    private function pagePay($params, $button = 'Submit')
    {
        $config = $this->config('pay');
        $submit_url = $config['apiUrl'] . 'submit.php';
        $params = $this->buildRequestParam($params);
        $html = '<form id="dopay" action="' . $submit_url . '" method="post">';
        foreach ($params as $k => $v) {
            $html .= '<input type="hidden" name="' . htmlspecialchars($k) . '" value="' . htmlspecialchars($v) . '"/>';
        }
        $html .= '<input type="submit" value="' . htmlspecialchars($button) . '"></form><script>document.getElementById("dopay").submit();</script>';
        return $html;
    }

    private function buildRequestParam($params)
    {
        $params['sign'] = $this->getSign($params);
        $params['sign_type'] = $this->sign_type;
        return $params;
    }

    private function getSign($param)
    {
        $config = $this->config('pay');
        $key = $config['apiKey'];
        ksort($param);
        reset($param);
        $signstr = '';

        foreach ($param as $k => $v) {
            if ($k != "sign" && $k != "sign_type" && $v != '') {
                $signstr .= $k . '=' . $v . '&';
            }
        }
        $signstr = substr($signstr, 0, -1);
        $signstr .= $key;
        $sign = md5($signstr);
        return $sign;
    }

    public function returnUrl()
    {
        $title = $this->config('app')['title'];
        $email = $this->config('app')['email'];
        $phone = $this->config('app')['phone'];
        $address = $this->config('app')['address'];
        $addressLink = $this->config('app')['addressLink'];
        $description = $this->config('app')['description'];

        $this->view('pages/result', [
            'webTitle' => "Payment Result - " . $title,
            'title' => $title,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'addressLink' => $addressLink,
            'description' => $description,
        ]);
        $params = $_GET;

        $sign = $params['sign'] ?? '';
        unset($params['sign'], $params['sign_type']);

        $calculatedSign = $this->getSign($params);

        if ($sign !== $calculatedSign) {
            echo "Signature validation failed.";
            return;
        }

        if ($params['trade_status'] === 'TRADE_SUCCESS') {
            echo "Payment successful!";
            echo "<br>Order ID: " . htmlspecialchars($params['out_trade_no']);
            echo "<br>Amount: " . htmlspecialchars($params['money']);
        } else {
            echo "Payment failed or invalid status.";
        }
    }
}
