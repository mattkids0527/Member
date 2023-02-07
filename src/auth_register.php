<?php
require_once '../vendor/autoload.php';
use wayne\Database_member;

$db = new Database_member();
//註冊
if (!empty($_POST['userName']) && !empty($_POST['userPassword'])) {
    $check_end = check_vaild($_POST['userPassword']);
    if ($check_end) {
        $auth_user = $db->Read("member", "userName", $_POST['userName']);
        if (empty($auth_user)) {
            $array = array(
                "userName" => $_POST['userName'],
                "userPassword" => hash('sha256', $_POST['userPassword']),
                "email"=> $_POST['email']
            );
            if ($db->Insert("member", $array)) {
                $id = $db->Read('member', 'userName', $array['userName'], true);
                $db->Insert_single('information', 'user_id', $id[0]['ID']);
                 echo "註冊成功";
            }
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo "帳號已被註冊，請重新輸入";
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo $check_end;
    }
} else {
    header("HTTP/1.1 401 Unauthorized");
    echo "Error,User & Password not INPUT";
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

$db->closeconn();



?>