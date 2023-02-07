<?php
require_once '../vendor/autoload.php';
use wayne\Database_member;
$redis = new Redis();
$redis->connect('192.168.1.111', 6379);




if(!empty($_POST['userPassword']) && !empty($_POST['re_userPassword']) && !empty($_POST['userName']) && $redis->get($_POST['userName'])){

$password = $_POST['userPassword'];
$re_password = $_POST['re_userPassword'];
$userName = $_POST['userName'];

    $db = new Database_member();
//驗證身分
if(!empty($password) && !empty($re_password) && strlen($password)==strlen($re_password)){
    if(check_vaild($password)){
            $db->Update("member", $userName, hash('sha256',$password));
            echo "重置成功";
    }else{
        header("HTTP/1.1 401 Unauthorized");
        echo $password;
    }
} else{
    header("HTTP/1.1 401 Unauthorized");
    exit("輸入密碼不一致");
}

}else{
    header("HTTP/1.1 401 Unauthorized");
    header("Refresh:3; url=forget.php");
    echo "錯誤:先進行信箱驗證";
}

function check_vaild($match)
{
    $check_len = '/[0-9]/';
    $check_uppercase = '/[a-z]/';
    $check_lowercase = '/[A-Z]/';
    $check_special = '/[~!@#$%^&*()_\-=+{};:<,.>?]/';

    if (!preg_match($check_len, $match)) {
        echo "至少包含數字";
        return false;
    } elseif (!preg_match($check_uppercase, $match)) {
        echo "至少包含小寫字元";
        return false;
    } elseif (!preg_match($check_lowercase, $match)) {
        echo "至少包含大寫字元";
        return false;
    } elseif (!preg_match($check_special, $match)) {
        echo "至少包含特殊字元";
        return false;
    } elseif (mb_strlen($match) < 8 || mb_strlen($match) > 12) {
        echo "請輸入8到12個含大小寫特殊字元及數字";
        return false;
    } else {
        return true;
    }

}


?>