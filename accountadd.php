<?php
 include_once 'petplus.php';
 $user_type = $_POST['user_type'];
 $user_fname = $_POST['user_fname'];
 $user_lname = $_POST['user_lname'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = $conn->prepare("INSERT INTO Users(User_Type,User_FName,User_LName,Email,Password) VALUES(?,?,?,?,?)");
  $sql->bind_param("sssss",$_POST['user_type'],$_POST['user_fname'],$_POST['user_lname'],$_POST['email'], $hashed_password);
  $success = $sql->execute();
  if($success){
      echo "success";
  }else{
    echo "Failed";
  }
  $sql->close();
  $conn->close();

?>
