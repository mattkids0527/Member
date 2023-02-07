<?php
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
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
        <div class="col-auto"><button id="home" type="button" class="btn btn-info">回首頁</button></div>
      </div>
      <br><br><br>
      <div class="row">
        <div class="col"></div>
        <div class="col">
          <h2 style="color: antiquewhite;">註冊頁面</h2>
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
              <div class="form-text">*請輸入使用者帳號</div>
            </div>
            <div class="mb-3">
              <label for="userPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="userPassword" name="userPassword" aria-describedby="userPassword" required>
              <div class="form-text">*請輸入<a style="color: red;">8-12位包含大小寫數字及特殊字元</a> ex: @Qwe1234</div>
            </div>
            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="name@email.com">
              <div class="form-text">請輸入使用者信箱(非必填)</div>
            </div>

            <button type="submit" class="btn btn-primary">註冊</button>
            <button type="button" id="freset" class="btn btn-info">重置</button>
          </form>
        </div>
        <div class="col"></div>
      </div>
    </div>
  </div>

  <video class="video-container" autoplay loop muted>
    <source src="video/beach-1080p.mp4" type="video/mp4">
  </video>
</body>
<script>
  $("form").submit(function(){
    event.preventDefault();
    if(vaildform()==true){
    $.ajax({
      type:'POST',
      url:'auth_register.php',
      data:$("form").serialize(),
      success:function(result){
        alert(result);
        window.location = "http://127.0.0.1/login.php"
      },
      error:function(xhr){
        alert(xhr.responseText);
        //window.location.reload(true);
      }
    });
  }
  });

  $('#home').click(function(){
    window.location = "http://127.0.0.1/login.php";
  });

  

  $('#freset').click(function(){
    $('#form')[0].reset();
  });
</script>