<?php

session_start();
$sid = "Redis:" . session_id();

$redis = new Redis();
$redis->connect('192.168.1.111', 6379);
$str = $redis->get($sid);
if (!empty($str)) {
  header("location:main.php");
}
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/video.css">
<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="jquery/jquery-3.6.1.min.js"></script>
<script>
  function vaildform(){
    var userPassword = $('#userPassword').val();
    if(userPassword.length<8){
      alert('密碼少於8位數');
      return false;
    }else{
      return true;
    }
  }
</script>
<body>

  <div class="main">
    <div class="container">
      <div class="row">
        <div class="col-auto me-auto"></div>
        <div class="col-auto"><button id="regier" type="button" class="btn btn-success">註冊帳號?</button></div>
      </div>
      <br><br><br>
      <div class="row">
        <div class="col"></div>
        <div class="col">
          <h2 style="color: antiquewhite;">登入頁面</h2>
        </div>
        <div class="col"></div>
      </div>
      <div class="row">
        <div class="col"></div>
        <div class="col bb">
          <form id="form">
            <div class="mb-3">
              <label for="userName" class="form-label">User</label>
              <input type="text" class="form-control" id="userName" name="userName" aria-describedby="userName" required>
              <div id="userName" class="form-text">該欄位要輸入使用者帳號</div>
            </div>
            <div class="mb-3">
              <label for="userPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="userPassword" name="userPassword" aria-describedby="userPassword" required>
              <div id="userPassword" class="form-text">該欄位要輸入使用者密碼</div>
            </div>
            <div class="mb-3">
              <a href="forget.php">忘記密碼</a>
            </div>
            <button type="submit" class="btn btn-primary">登入</button>
            <button type="button" id="freset" class="btn btn-info">重置</button>
          </form>
        </div>
        <div class="col"></div>
      </div>
    </div>
  </div>

  <video class="video-container" autoplay loop muted>
    <source src="video/swimming-1080p.mp4" type="video/mp4">
  </video>
</body>
<script>
  $("form").submit(function(){
    event.preventDefault();
    if(vaildform()==true){
    $.ajax({
      type:'POST',
      url:'auth_login.php',
      data:$("form").serialize(),
      success:function(result){
        alert(result);
        window.location ="http://127.0.0.1/main_home.php";
      },
      error:function(xhr){
        alert(xhr.responseText);
      }
    });
  }
  });

  $('#regier').click(function(){
    window.location ="http://127.0.0.1/register.php";
  });

  $('#freset').click(function(){
    $('#form')[0].reset();
  });
</script>
</html>