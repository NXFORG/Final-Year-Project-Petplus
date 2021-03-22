<?php
 include_once 'petplus.php';
 $email = $_POST['email'];
 $password = $_POST['password'];

  $sql = $conn->prepare("INSERT INTO Users(Email,Password) VALUES(?,?)");
  $sql->bind_param("ss",$_POST['email'], $_POST['password']);
  $success = $sql->execute();
  if($success){
      echo "success";
  }else{
    echo "Failed";
  }
  $sql->close();
  $conn->close();

?>
