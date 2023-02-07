<?php

$userName = $_POST['userName'];
$code = $_POST['code'];

$redis = new Redis();
$redis->connect('192.168.1.111', 6379);

$redis_code = $redis->get($userName);
if($redis_code==$code){
    echo "驗證成功，請重置密碼";
}else{
    header("HTTP/1.1 401 Unauthorized");
    exit("錯誤");
}
?>