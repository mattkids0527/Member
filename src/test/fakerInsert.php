<?php
include_once('../db/db_con.php');
require_once '../../vendor/autoload.php';

$table = 'web1';

$faker = Faker\Factory::create('zh_TW');
$msg_name = $faker->name(); //msg_name
$msg_content = $faker->realtext($maxNbChars = 20); //msg_content
$timetamp = ($faker->date('Y/m/d'))." ".($faker->time());

$arr =[
    'faker_windows',
    $msg_name,
    $msg_content,
    $timetamp
];

try{
 $conn = new PDO("mysql:host=$severname;dbname=$mydbname",$username,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8mb4'));
 $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//$sql = $conn->prepare("SELECT * FROM $table WHERE 1");
//$sql = $conn->prepare("SELECT count(*) FROM $table");
$sql = $conn->prepare("INSERT INTO $table (msg_window,msg_name,msg_content,msg_timetamp) VALUES (?,?,?,?)");

//multiple rows
//$sql -> beginTransaction();
$sql->execute($arr);

echo "OK";
//$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
//multiple rows
//$sql -> commit();
}catch(PDOException $e){
echo json_encode($e->getMessage());
//multiple rows
//$sql -> rollback();
}
$conn = null;

?>
