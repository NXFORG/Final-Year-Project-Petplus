<?php
 //include('modinstance.php');
 $petid = $_POST['updpetid'];
 $petdob = $_POST['updpetdob'];
 $microid = $_POST['updpetmicroid'];
 $petspecies = $_POST['updpetspecies'];
 $ownername = $_POST['updownername'];
 $vetname = $_POST['updvetname'];
 $treatname = $_POST['updtreatname'];
 $futuretreat = $_POST['updfuturetreat'];
 $dietname = $_POST['upddietname'];
 $exercisename = $_POST['updexercisename'];
 $diagnosisname = $_POST['upddiagnosisname'];
 echo "Value:" . $petid . "\n";
 echo "Value:" . $petdob . "\n";
 echo "Value:" . $microid . "\n";
 echo "Value:" . $petspecies . "\n";
 echo "Value:" . $ownername . "\n";
 echo "Value:" . $vetname . "\n";
 echo "Value:" . $treatname . "\n";
 echo "Value:" . $futuretreat . "\n";
 echo "Value:" . $dietname . "\n";
 echo "Value:" . $exercisename . "\n";
 echo "Value:" . $diagnosisname . "\n";


$conn = new mysqli('localhost','chris','test212','PetPlus');
if($conn->connect_error){
    die('connection failed: '.$conn->connect_error);
  }else{
  $sql = $conn->prepare("UPDATE Pet SET Pet_Owner_ID = '$ownername', Pet_System_ID = '$microid', Pet_Vet_ID = '$vetname', Pet_Species_ID = '$petspecies', Pet_DOB = '$petdob', Pet_Treatment_ID = '$treatname', Pet_Next_Treatment_Date = '$futuretreat', Pet_Diet_ID = '$dietname', Pet_Exercise_ID = '$exercisename', Pet_Diagnosis_ID = '$diagnosisname' WHERE Pet_ID = '$petid'");
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
