<?php
session_start();
$sid = "Redis:" . session_id();
require_once '../vendor/autoload.php';
use wayne\Database_member;

$redis = new Redis();
$redis->connect('192.168.1.111', 6379);
$str = $redis->get($sid);
$db = new Database_member();

if (!empty($str)) {
  $str = str_replace("|", "\"", str_replace(";", "", $str));
  $str = array_filter(explode("\"", $str));
  $result = [];
  for ($i = 0; $i < count($str); $i = $i + 3) {
    $result[$str[$i]] = $str[$i + 2];
  }
  $rows = $db->Read('member', 'userName', $result['userName'],true);
  $rows = $db->Read('information','user_id',$rows[0]['ID']);
  ?>
  <!DOCTYPE html>
  <html lang="zh-TW">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    </link>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="jquery/jquery-3.6.1.min.js"></script>
    <style>
      #img {
        width: 60px;
        height: 60px;
        background-image: url("/img/default.png");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-color: black;
        border-radius: 99em;
      }
      th{
        color: brown;
      }
      td{
        color: blue;
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <div id="img"></div>
        <div class="collapse navbar-collapse" id="navbarColor02">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link" href="main_home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="main_personal.php">個人資料</a>
            </li>
          </ul>
          <form class="d-flex flex-column">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people"
                viewBox="0 0 16 16">
                <path
                  d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
              </svg><a>
                <?php echo $result['userName']; ?>
              </a>
            </div>
            <div><button id="logout" type="button" class="btn btn-sm btn-outline-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-steam"
                  viewBox="0 0 16 16">
                  <path
                    d="M.329 10.333A8.01 8.01 0 0 0 7.99 16C12.414 16 16 12.418 16 8s-3.586-8-8.009-8A8.006 8.006 0 0 0 0 7.468l.003.006 4.304 1.769A2.198 2.198 0 0 1 5.62 8.88l1.96-2.844-.001-.04a3.046 3.046 0 0 1 3.042-3.043 3.046 3.046 0 0 1 3.042 3.043 3.047 3.047 0 0 1-3.111 3.044l-2.804 2a2.223 2.223 0 0 1-3.075 2.11 2.217 2.217 0 0 1-1.312-1.568L.33 10.333Z">
                  </path>
                  <path
                    d="M4.868 12.683a1.715 1.715 0 0 0 1.318-3.165 1.705 1.705 0 0 0-1.263-.02l1.023.424a1.261 1.261 0 1 1-.97 2.33l-.99-.41a1.7 1.7 0 0 0 .882.84Zm3.726-6.687a2.03 2.03 0 0 0 2.027 2.029 2.03 2.03 0 0 0 2.027-2.029 2.03 2.03 0 0 0-2.027-2.027 2.03 2.03 0 0 0-2.027 2.027Zm2.03-1.527a1.524 1.524 0 1 1-.002 3.048 1.524 1.524 0 0 1 .002-3.048Z">
                  </path>
                </svg>Logout</button></div>
          </form>
        </div>
      </div>
    </nav>

    <div class="container-xxl">
      <br><br><br><br>
      <div class="row align-items-center">
        <h2>個人資料</h2>
      </div>
      <div class="">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">性別</th>
      <th scope="col">名稱</th>
      <th scope="col">個人圖片</th>
      <th scope="col">使用者ID</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      foreach($rows[0] as $row){
        if($row==null||$row==""){
          echo "<td>尚未填入</td>";
        }else{
          echo "<td>".$row."</td>";
        }
      }
      ?>
    </tr>
  </tbody>
</table>
      </div>
    </div>
  </body>
  <script type="text/javascript">


    $('#logout').click(function () {
      if (confirm("確認要登出嗎?") == true) {
        alert('已登出');
        window.location.href = "logout.php";
      }
    });
  </script>
  <?php
} else {
  echo "您尚未登入，系統將於【" . "<span id='timer'>5</span>" . "】秒後回登入頁面。";
  echo "<script type='text/javascript'>setTimeout('countdown()', 1000)</script>";
}
?>
<script type='text/javascript'>
  function countdown() {
    var s = document.getElementById('timer');
    s.innerHTML = s.innerHTML - 1;
    if (s.innerHTML == 0)
      window.location = 'http://127.0.0.1/login.php';
    else
      setTimeout('countdown()', 1000);
  }
</script>

</html>