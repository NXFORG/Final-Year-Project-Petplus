<?php
   //uses the databse connection file
   include('dbconnect.php');
   session_start();

   //takes the login session started by a vet or owner
   $check = $_SESSION['login_user'];
   //retrieves the user's email address from their session
   //the email address is used on other pages for auto-filling form fields
   $ses_sql = mysqli_query($conn,"SELECT Email FROM Users WHERE Email = '$check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   //if a user logs out, end the session and send them back to the home page
   if(!isset($_SESSION['login_user'])){
      header("location:index.html");
      die();
   }
?>
