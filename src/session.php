<?php

//前置處理；設定session儲存置redis
ini_set('session.save_handler','redis');
ini_set('session.gc_maxlifetime',14400);
ini_set('session.save_path','tcp://192.168.1.111:6379?prefix=Redis:');

//example
//session_start();
//$_SESSION['user'] = "Test66";
//$_SESSION['id'] = "6666";
//$_SESSION['date'] = "2023/01/21";
//
//if(isset($_SESSION['user'])&&isset($_SESSION['id'])&&isset($_SESSION['date'])){
//    echo "session SET";
//}else{
//    echo "Not Set";
//}


?>