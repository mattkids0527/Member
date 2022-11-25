<?php
include_once('../db/db_con.php');
require_once '../../vendor/autoload.php';

$table = 'web1';

$faker = Faker\Factory::create('zh_TW');
$arr = [];
for($i=0;$i<4;$i++){
$msg_name = $faker->name(); //msg_name
$msg_content = $faker->realtext($maxNbChars = 20); //msg_content
$timetamp = ($faker->date('Y/m/d'))." ".($faker->time());

$tmp_arr =[
    'faker_windows',
    $msg_name,
    $msg_content,
    $timetamp
];

array_push($arr,$tmp_arr);
}
try{
 $conn = new PDO("mysql:host=$severname;dbname=$mydbname",$username,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8mb4'));
 $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = $conn->prepare("INSERT INTO $table (msg_window,msg_name,msg_content,msg_timetamp) VALUES (?,?,?,?)");

//multiple rows
$conn->beginTransaction();

foreach($arr as $sql_arr){
$sql->execute($sql_arr);
}
//$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
//multiple rows
$conn->commit();

echo "OK";
}catch(PDOException $e){
echo json_encode($e->getMessage());
//multiple rows
$conn->rollback();
}
$conn = null;

?>
