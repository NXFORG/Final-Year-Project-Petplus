<?php
 //Database connection file
 include_once 'dbconnect.php';

 $treatmentname = $_POST['treatmentname'];
 $treatdate = $_POST['treatdate'];
 $treatmentnotes = $_POST['treatmentnotes'];
 $treatmenttype = $_POST['treatmenttype'];
 $treatmentcost = $_POST['treatmentcost'];
 $treatmentvet = $_POST['treatmentvet'];

if($conn->connect_error){
    die('connection failed: '.$conn->connect_error);
  }else{
  $sql = $conn->prepare("INSERT INTO Treatment(Treatment_Name,Treatment_Date,Treatment_Notes,Treatment_Type,Treatment_Cost_ID,Treatment_Vet) VALUES(?,?,?,?,?,?)");
  $sql->bind_param("sssssi",$_POST['treatmentname'], $_POST['treatdate'], $_POST['treatmentnotes'], $_POST['treatmenttype'], $_POST['treatmentcost'], $_POST['treatmentvet']);
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
