<?php
?>

<!DOCTYPE html>
<html>
  <head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Forget</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/video.css">
<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="jquery/jquery-3.6.1.min.js"></script>
<style>.a_color{color:red;}</style>
</head>
<body>

  <div class="main">
    <div class="container">
    <div class="row">
        <div class="col-auto me-auto"></div>
        <div class="col-auto"><button id="home" type="button" class="btn btn-info">回首頁</button></div>
      </div>
      <div class="row">
        <div class="col"></div>
        <div class="col">
          <h2 style="color: brown;">找回密碼</h2>
        </div>
        <div class="col"></div>
      </div>
      <div class="row">
        <div class="col"></div>
        <div class="col bb">
          <form id="form">
          <div class="mb-3">
              <label for="userName">帳號</label>
              <input type="text" class="form-control" id="userName" name="userName" placeholder="忘記密碼的帳號" required>
              <div class="form-text">請輸入使用者帳號<a style="color: red;">(必填)</a></div>
            </div>
            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="name@email.com" required>
              <div class="form-text">請輸入接收驗證信箱<a style="color: red;">(必填)</a> mattkids0527@gmail.com</div>
            </div>

            <div class="mb-3 code_dis">
              <input type="text" class="form-control" id="code" name="code" readonly>
              <div class="form-text"><a id="code_a">請輸入驗證碼</a></div>
            </div>
            <button type="submit" class="btn btn-primary" id="code_down">發送驗證碼</button>
            <button type="button" class="btn btn-success code_dis" id="code_btn" disabled>提交驗證碼</button>
          </form>
        </div>
        <div class="col"></div>
      </div>
    </div>
  </div>

  <video class="video-container" autoplay loop muted>
    <source src="video/looking-watch1080p.mp4" type="video/mp4">
  </video>
</body>
<script>
    $("form").submit(function(){
    event.preventDefault();
    $.ajax({
      type:'POST',
      url:'forget_auth.php',
      data:$("form").serialize(),
      success:function(result){
        alert(result);
        $('#code').attr('readonly',false);
        $('#code_a').addClass('a_color');
        $('#code_btn').attr('disabled',false);
      },
      error:function(xhr){
        alert(xhr.responseText);
      }
    });
  });

  $('#code_btn').click(function(){
    $.ajax({
      type:'POST',
      url:'code_auth.php',
      data:$("form").serialize(),
      success:function(result){
        alert(result);
        window.location = "http://127.0.0.1/re_password.php?auth="+$('#userName').val();
      },
      error:function(xhr){
        alert(xhr.responseText);
      }
    });
  });
  


  $('#home').click(function(){
    window.location = "http://127.0.0.1/login.php";
  });
</script>