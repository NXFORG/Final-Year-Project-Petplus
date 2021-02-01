<?php
 $treatmentname = $_POST['treatmentname'];
 $treatmenttype = $_POST['treatmenttype'];
 $treatdate = $_POST['treatdate'];
 $treatmentnotes = $_POST['treatmentnotes'];
 $treatmentcost = $_POST['treatmentcost'];

$conn = new mysqli('localhost','chris','test212','PetPlus');
if($conn->connect_error){
    die('connection failed: '.$conn->connect_error);
  }else{
  $sql = $conn->prepare("INSERT INTO Treatment(Treatment_Name,Treatment_Type,Treatment_Date,Treatment_Notes,Treatment_Cost_ID) VALUES(?,?,?,?,?)");
  $sql->bind_param("ssssi",$_POST['treatmentname'], $_POST['treatmenttype'], $_POST['treatdate'], $_POST['treatmentnotes'],$_POST['treatmentcost']);
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
