<?php
 $email = $_POST['email'];
 $password = $_POST['password'];

$conn = new mysqli('localhost','chris','test212','PetPlus');
if($conn->connect_error){
    die('connection failed: '.$conn->connect_error);
  }else{
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
}
?>
