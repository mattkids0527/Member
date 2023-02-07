<?php
require_once '../vendor/autoload.php';
use wayne\Database_member;

$redis = new Redis();
$redis->connect('192.168.1.111', 6379);

//驗證身分
if (!empty($_POST['userName']) && !empty($_POST['email'])) {
    $email = $_POST['email'];

    $db = new Database_member();
    $auth_user = $db->Read("member", "userName", $_POST['userName']);
    if (empty($auth_user)) {
        header("HTTP/1.1 401 Unauthorized");
        echo "錯誤:查無帳號!!";
    } elseif ($redis->get($auth_user[0]['userName'])) {
        header("HTTP/1.1 400 BadRequest");
        echo "已發出驗證碼,請10分鐘後再送出";
    } else {
        $code = str_pad(rand(0, 999999), 6, "", STR_PAD_BOTH);
        if (mail_send($email, $code)) {
            send_code($redis, $auth_user[0]['userName'], $code);
            echo "已發送至信箱，請至信箱索取並驗證: " . $code;
        } else {
            header("HTTP/1.1 401 Unauthorized");
            exit("出現不預期錯誤");
        }
    }
} else {
    $db->closeconn();
    header("HTTP/1.1 401 Unauthorized");
    exit("錯誤:帳號信箱為空");
}

function send_code($redis, $userName, $code)
{
    $redis->set($userName, $code);
    $redis->expire($userName, 900);
    return true;
}

function mail_send($email, $code)
{
    //$email = "mattkids0527@gmail.com";
    $subject = "PHP_Lab-Password RESET";
    $message = "Password RESET CODE :" . $code;
    $from = 'From:waynesuwnt@gmail.com';

    if (mail($email, $subject, $message, $from)) {
        return true;
    } else {
        echo 'Unable to send email. Please try again.';
        return false;
    }
}


$db->closeconn();


?>