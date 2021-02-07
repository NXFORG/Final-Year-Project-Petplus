<?php
  include_once 'petplus.php';
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset = "UTF 8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PETPLUS PET MANAGER</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="login.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 </head>
 <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <img class="logo" src="images/petplus.png" alt="PETPLUS">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
     <ul class="navbar-nav">
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="index.html">HOME</a>
      </li>
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="about.html">ABOUT</a>
      </li>
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="login.php">VETS</a>
      </li>
      <li class="nav-item active">
       <a class="nav-link hvr-fade" href="ownerlogin.php">OWNERS<span class="sr-only ">(current)</span></a>
      </li>
     </ul>
    </div>
   </nav>
  <div class="card-img-overlay">
    <div id="form-container">
    <div class="container">
    <div class="row">
      <?php
      session_start();
        if($_SERVER["REQUEST_METHOD"] == "POST") {
          $user = mysqli_real_escape_string($conn,$_POST['username']);
          $pass = mysqli_real_escape_string($conn,$_POST['password']);
          $sql = "SELECT User_ID FROM Users WHERE Email = '$user' and Password = '$pass'";
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
          $count = mysqli_num_rows($result);
          if($count == 1) {
            $_SESSION['login_user'] = $user;
            header("location: ownerviewpet.php");
          }else{
            echo "<script>alert(\"Your email or password wasn't recognised, please try again.\")</script>";
          }
        }
        ?>
      <form action = "" method = "post">
        <div class="main-card-title">Pet Owner Login</div>
        <br>
        <label class="form-label">Email Address</label>
        <input type = "text" name = "username"/><br /><br />
        <label class="form-label">Password</label>
        <input type = "password" name = "password"/><br/><br />
        <input type = "submit" id="vetbtn" value = " Submit "/><br />
        <div id="loginmsg"> </div>
      </form>
   </div>
  </div>
</div>
<div id="form-container">
<div class="container">
<div class="row">
  <form id="vetregister" action = "accountadd.php" method = "post">
    <div class="main-card-title">Register an Owner Account</div>
    <br>
    <label class="form-label">Email Address</label>
    <input type = "text" id="regemail" name = "email"/><br /><br />
    <label class="form-label">Password</label>
    <input type = "password" id="regpassword" name = "password"/><br/><br />
    <input type = "submit" id="regbtn" value = " Submit "/><br />
  </form>
  <script>
    $("#vetregister").submit(function(event) {
      event.preventDefault(); 
      var $form = $(this),
      url = $form.attr('action');
      var posting = $.post(url, {
        vetemail: $('#regemail').val(),
        vetpassword: $('#regpassword').val()
      });
      posting.done(function(data) {
        alert("Account successfully created");
      });
      posting.fail(function() {
        alert("Error: Account not created");
      });
    });
  </script>
</div>
</div>
</div>
</div>
<footer><p>NXFORG 2021</p>
  <a href="#" class="fa fa-facebook"></a>
  <a href="#" class="fa fa-twitter"></a>
  <a href="#" class="fa fa-instagram"></a>
  <a href="#" class="fa fa-snapchat-ghost"></a>
</footer>
 </body>
</html>
