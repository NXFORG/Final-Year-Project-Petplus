<?php
 $petname = $_POST['petname'];
 $petdob = $_POST['petdob'];
 $petspecies = $_POST['petspecies'];
 $ownername = $_POST['ownername'];
 $vetname = $_POST['vetname'];
 $treatname = $_POST['treatname'];
 $dietname = $_POST['dietname'];
 $exercisename = $_POST['exercisename'];
 $diagnosisname = $_POST['diagnosisname'];

$conn = new mysqli('localhost','chris','test212','PetPlus');
if($conn->connect_error){
    die('connection failed: '.$conn->connect_error);
  }else{
  $sql = $conn->prepare("INSERT INTO Pet(Pet_Name,Pet_DOB,Pet_Owner_ID,Pet_Vet_ID,Pet_Species_ID,Pet_Treatment_ID,Pet_Diet_ID,Pet_Exercise_ID,Pet_Diagnosis_ID) VALUES(?,?,?,?,?,?,?,?,?)");
  $sql->bind_param("ssiiiiiii",$_POST['petname'], $_POST['petdob'], $_POST['ownername'], $_POST['vetname'], $_POST['petspecies'], $_POST['treatname'], $_POST['dietname'], $_POST['exercisename'], $_POST['diagnosisname']);
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