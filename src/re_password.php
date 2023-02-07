

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
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
          <h2 style="color: brown;">重置密碼
        </div>
        <div class="col"></div>
      </div>
      <div class="row">
        <div class="col"></div>
        <div class="col bb">
          <form id="form">
          <div class="mb-3">
              <label for="userName">帳號</label>
              <input type="text" class="form-control" id="userName" name="userName" readonly value="<?php echo $_GET['auth'];?>"></h2>
            </div>

          <div class="mb-3">
              <label for="userPassword" class="form-label">輸入密碼</label>
              <input type="password" class="form-control" id="userPassword" name="userPassword" aria-describedby="userPassword" required>
              <div class="form-text">*請輸入<a style="color: red;">8-12位包含大小寫數字及特殊字元</a> ex: @Qwe1234</div>
            </div>

            <div class="mb-3">
              <label for="userPassword" class="form-label">再次輸入密碼</label>
              <input type="password" class="form-control" id="re_userPassword" name="re_userPassword" aria-describedby="re_userPassword" required>
              <div class="form-text">*請輸入<a style="color: red;">8-12位包含大小寫數字及特殊字元</a> ex: @Qwe1234</div>
            </div>

            <button type="submit" class="btn btn-danger">重置密碼</button>
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
      url:'re_password_auth.php',
      data:$("form").serialize(),
      success:function(result){
        alert(result);
        window.location = "http://127.0.0.1/login.php";
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