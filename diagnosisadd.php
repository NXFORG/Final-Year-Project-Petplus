<?php
 $diagnosisname = $_POST['diagnosisname'];
 $diagnosistype = $_POST['diagnosistype'];
 $diagnosisdate = $_POST['diagnosisdate'];
 $diagnosisvet = $_POST['diagnosisvet'];

$conn = new mysqli('localhost','chris','test212','PetPlus');
if($conn->connect_error){
    die('connection failed: '.$conn->connect_error);
  }else{
  $sql = $conn->prepare("INSERT INTO Diagnosis(Diagnosis_Name,Diagnosis_Type,Diagnosis_Date,Diagnosis_Vet) VALUES(?,?,?,?)");
  $sql->bind_param("sssi",$_POST['diagnosisname'], $_POST['diagnosistype'], $_POST['diagnosisdate'], $_POST['diagnosisvet']);
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
