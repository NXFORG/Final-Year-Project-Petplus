<?php
   include('petplus.php');
   session_start();

   $check = $_SESSION['login_user'];
   $ses_sql = mysqli_query($conn,"SELECT Email FROM Users WHERE Email = '$check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>
