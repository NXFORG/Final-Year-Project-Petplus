<?php
 //Database connection file
 include_once 'dbconnect.php';

 $exercisename = $_POST['exercisename'];
 $exercisestartdate = $_POST['exercisestartdate'];
 $exerciseenddate = $_POST['exerciseenddate'];
 $exercisenotes = $_POST['exercisenotes'];

if($conn->connect_error){
    die('connection failed: '.$conn->connect_error);
  }else{
  $sql = $conn->prepare("INSERT INTO Exercise(Exercise_Name,Exercise_Start,Exercise_End,Exercise_Notes) VALUES(?,?,?,?)");
  $sql->bind_param("ssss",$_POST['exercisename'], $_POST['exercisestartdate'], $_POST['exerciseenddate'], $_POST['exercisenotes']);
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
