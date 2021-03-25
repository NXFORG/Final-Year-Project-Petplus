<?php
 include('modinstance.php');
 $petdob = $_POST['petdob'];
 $petspecies = $_POST['petspecies'];
 $ownername = $_POST['ownername'];
 $vetname = $_POST['vetname'];
 $treatname = $_POST['treatname'];
 $futuretreat = $_POST['futuretreat'];
 $dietname = $_POST['dietname'];
 $exercisename = $_POST['exercisename'];
 $diagnosisname = $_POST['diagnosisname'];

$conn = new mysqli('localhost','chris','test212','PetPlus');
if($conn->connect_error){
    die('connection failed: '.$conn->connect_error);
  }else{
  $sql = $conn->prepare("UPDATE Pet SET Pet_Owner_ID = '$ownername', Pet_Vet_ID = '$vetname', Pet_Species_ID = '$petspecies', Pet_DOB = '$petdob', Pet_Treatment_ID = '$treatname', Pet_Next_Treatment_Date = '$futuretreat', Pet_Diet_ID = '$dietname', Pet_Exercise_ID = '$exercisename', Pet_Diagnosis_ID = '$diagnosisname' WHERE Pet_ID = $modid");
  $success = $sql->execute();
  if($success){
    echo "success";
  }else{
    echo "Failed";
  }
  // echo $sql;
  $sql->close();
  $conn->close();
}
?>
