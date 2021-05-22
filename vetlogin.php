<?php
  //Database connection file
  include_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en-gb">
 <head>
  <meta charset = "UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PETPLUS PET MANAGER</title>
  <!--Bootsrap library link-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!--Custom CSS stylesheet-->
  <link rel="stylesheet" type="text/css" href="vetlogin.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--jQuery library link-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 </head>
 <body>
   <!--Page navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <img class="logo" src="images/petpluslogowhite.png" alt="PETPLUS">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
     <ul class="navbar-nav">
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="index.html">HOME</a>
      </li>
      <li class="nav-item active">
       <a class="nav-link hvr-fade" href="vetlogin.php">VETS<span class="sr-only ">(current)</span></a>
      </li>
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="ownerlogin.php">OWNERS</a>
      </li>
     </ul>
    </div>
   </nav>
  <div class="card-img-overlay">
    <div id="form-header">
     <input id="showLogin" type="button" onClick="document.getElementById('vetlogin').style.display='block';document.getElementById('vetregister').style.display='none';" value="Login" />
     <input id="showRegister" type="button" onClick="document.getElementById('vetlogin').style.display='none';document.getElementById('vetregister').style.display='block';" value="Register" />
    </div>
    <div id="form-container">
    <div class="container">
    <div class="row">
      <?php
      session_start();
        //Once the vet submits the login form, their entered details are checked with the database values
        if($_SERVER["REQUEST_METHOD"] == "POST") {
          //the vet's username
          $user = mysqli_real_escape_string($conn,$_POST['username']);
          //the vet's password
          $pass = mysqli_real_escape_string($conn,$_POST['password']);
          //Query to retrieve a matching email value from the database
          $sql = "SELECT User_ID,Password FROM Users WHERE Email = '$user'";
          //The query is executed
          //'conn' variable taken from the databse connection file
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
          $count = mysqli_num_rows($result);
          //if a result is found, the password is verified
          if($count == 1) {
            if(password_verify ($pass, $row['Password'])){
              $_SESSION['login_user'] = $user;
              //if the entered password matches the hashed database value, the login is successful
              header("location: addmodify.php");
            }else{
              echo "<script>alert(\"Your email or password wasn't recognised, please try again.\")</script>";
            }
          }else{
            echo "<script>alert(\"Your email or password wasn't recognised, please try again.\")</script>";
          }
        }
        ?>
      <!--HTML login form-->
      <form id="vetlogin" action = "" method = "post">
        <div class="main-card-title">Vet Login</div>
        <br>
        <label class="form-label">Email Address</label>
        <input label="Email address" type = "text" name = "username"/>
        <br>
        <br>
        <label class="form-label">Password</label>
        <input label="Password" type = "password" name = "password"/>
        <br>
        <br>
        <input label="Submit" type = "submit" id="vetbtn" value = " Submit "/><br />
        <div id="loginmsg"> </div>
      </form>
   </div>
  </div>
</div>
<div id="form-container">
<div class="container">
<div class="row">
  <!--HTML register form-->
  <form id="vetregister" action = "accountadd.php" method = "post">
    <div class="main-card-title">Register a Vet Account</div>
    <br>
    <label class="form-label">First Name</label>
    <input label="First name" type = "text" id="regfname" name = "fname"/>
    <br>
    <br>
    <label class="form-label">Last Name</label>
    <input label="Last name" type = "text" id="reglname" name = "lname"/>
    <br>
    <br>
    <label class="form-label">Email Address</label>
    <input label="Email address" type = "text" id="regemail" name = "email"/>
    <br>
    <br>
    <label class="form-label">Password</label>
    <input label="Password" type = "password" id="regpassword" name = "password"/><br/><br />
    <input label="submit" type = "submit" id="regbtn" value = " Submit "/><br />
  </form>
  <script>
    //jQuery script to prevent PHP page redirect on form submission
    //Also displays a success or error message depending on if account creation worked or not
    $("#vetregister").submit(function(event) {
      event.preventDefault(); /*Stops redirect*/
      var $form = $(this),
      url = $form.attr('action');
      var posting = $.post(url, {
        user_type: 'vet',
        user_fname: $('#regfname').val(),
        user_lname: $('#reglname').val(),
        email: $('#regemail').val(),
        password: $('#regpassword').val()
      });
      posting.done(function(data) {
        alert("Account successfully created");
        header("location:login.php");
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
<script type="text/javascript">
  document.getElementById("vetlogin").style.display="block";
  document.getElementById("vetregister").style.display="none";
</script>
<footer><p>UP854443 2021</p>
</footer>
 </body>
</html>
