<?php
require_once '../vendor/autoload.php';
use wayne\Database_member;

//驗證身分
if (!empty($_POST['userName']) && !empty($_POST['userPassword'])) {
    
    $db = new Database_member();

    $auth_user = $db->Read("member", "userName",$_POST['userName']);
    if (empty($auth_user)) {
        header("HTTP/1.1 401 Unauthorized");
        echo "無此帳號，請進行註冊";
    } else {
        $password = hash('sha256',$_POST['userPassword']);
        if ($auth_user[0]['userPassword'] == $password) {
            //cookie
            //setcookie("user",$_POST['userName'],time()+600);
            //session
            session_login($password);
            echo "登入成功OK";
        } else {
            header("HTTP/1.1 401 Unauthorized");
            echo "密碼錯誤";
        }
    }
} else {
    $db->closeconn();
    header("HTTP/1.1 401 Unauthorized");
    exit("Error,User & Password not INPUT");
}

function session_login($password)
{
    require_once 'session.php';
    session_start();
    $_SESSION['userName'] = $_POST['userName'];
    $_SESSION['userPassword'] = $password;
    $_SESSION['SID'] = session_id();
}

$db->closeconn();



?>