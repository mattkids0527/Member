<?php
session_start();
$sid = "Redis:" . session_id();
$redis = new Redis();
$redis->connect('192.168.1.111', 6379);
$redis->delete($sid);
header("location:login.php");
?>