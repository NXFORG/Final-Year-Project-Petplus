<?php
 $dietname = $_POST['dietname'];
 $dietstart = $_POST['dietstartdate'];
 $dietend = $_POST['dietenddate'];
 $dietnotes = $_POST['dietnotes'];

$conn = new mysqli('localhost','chris','test212','PetPlus');
if($conn->connect_error){
    die('connection failed: '.$conn->connect_error);
  }else{
  $sql = $conn->prepare("INSERT INTO Diet(Diet_Name,Diet_Start,Diet_End,Diet_Notes) VALUES(?,?,?,?)");
  $sql->bind_param("ssss",$_POST['dietname'], $_POST['dietstartdate'], $_POST['dietenddate'], $_POST['dietnotes']);
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
