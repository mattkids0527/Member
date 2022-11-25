<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewLog</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="jquery/jquery-3.6.1.min.js"></script>
</head>
<style>
table td{
    white-space: nowrap;
}

</style>
<body>
<?php
include('db/db_con.php');

$table = "web1";
$pages = 5;


if(!isset($_GET['page'])){
 $page = 1;
}else{
 $page = $_GET['page'];
}

try{
 $conn = new PDO("mysql:host=$severname;dbname=$mydbname",$username,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8mb4'));
 $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//$sql = $conn->prepare("SELECT * FROM $table WHERE 1");
$sql = $conn->prepare("SELECT count(*) FROM $table");
$sql->execute();
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
$all_pages = ceil($rows[0]['count(*)']/$pages);
//-------------------------------------------------

if($page==1){
	$start = 0;
}else{
	$start = ($page-1)*$pages;
}

$sql = $conn->prepare("SELECT * FROM $table ORDER BY id limit ".$start.",".$pages );
$sql->execute();
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
$counts = count($rows);

?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">訊息發送窗口</th>
      <th scope="col">訊息發送人</th>
      <th scope="col">訊息內容</th>
      <th scope="col">訊息發送時間</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
        <tfoot>
                <nav aria-label="Pages">
                  <ul id="pages" class="pagination"><li class="page-item" id="pre_li" ><a id="pre_link" onclick="Previous();" class="page-link" href="#">Previous</a></li></ul>
                </nav>
        </tfoot>

</body>

<script>
$(document).ready(function(){
<?php
for($i=1;$i<=$all_pages;$i++){
 echo "$('#pages').append('<li id=\"page$i\" class=\"page-item\"><a class=\"page-link\" href=?page=$i>$i</a></li>');";
}

for($i=0;$i<$counts;$i++){
	echo "$('.table tbody').append('<tr id=$i></tr>');";
	foreach($rows[$i] as $key => $value){
		if($key=='text'){
		$str = preg_replace('/\s/','',$value);
			echo "$('.table tbody #$i').append('<td><pre>{$str}</pre></td>');";
		}else{
			echo "$('.table tbody #$i').append('<td>{$value}</td>');";
		}
		echo "\n";
	}
}

echo "$('#pages').append('<li id=\"next\" class=\"page-item\"><a id=\"next_link\" onclick=\"next();\" class=\"page-link\" href=\"#\">Next</a></li>');";

echo "$('#page$page').addClass(\"active\");";

if($page==1){
  echo "$('#pre_li').addClass('disabled')";
}else if($page==$all_pages){
  echo "$('#next').addClass('disabled')";
}
?>

});



function Previous(){
 <?php
  $tmp1 = $page;
  if($tmp1>1){
    $tmp1 = $tmp1-1;
    echo "$('#pre_link').attr('href','?page=$tmp1');";
  }
 ?>
}

function next(){
 <?php
  $tmp2 = $page;
  if($tmp2 < $all_pages){
    $tmp2 = $tmp2+1;
    echo "$('#next_link').attr('href','?page=$tmp2');";
  }
 ?>
}


</script>

</html>

<?php
}catch(PDOException $e){
echo json_encode($e->getMessage());
}
$conn = null;

?>
