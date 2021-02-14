<?php
  include_once 'petplus.php';
  include('loggedin.php');
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset = "UTF 8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PETPLUS PET MANAGER</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="petmanager.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 </head>
 <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <img class="logo" src="images/petpluslogowhite.png" alt="PETPLUS">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
     <ul class="navbar-nav">
      <li class="nav-item active">
       <a class="nav-link hvr-fade" href="petmanager.php">PET MANAGER<span class="sr-only ">(current)</span></a>
      </li>
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="petinforetriever.php">ADD NEW</a>
      </li>
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="viewpet.php">VIEW PET</a>
      </li>
     </ul>
     <a href = "logout.php">Logout</a>
    </div>
   </nav>
<div id="homeimage">
  <div class="card-img-overlay">
    <div id="form-container">
    <div class="container">
    <div class="row">
      <form id="newpetadd" action="petadd.php" method="post">
        <div class="main-card-title">New Pet Entry Form</div>
        <fieldset>
          <label class="form-label">Pet Name</label>
          <input type="text" id="petname" name="petname">
          <br>
          <br>
          <label class="form-label">Pet Date of Birth</label>
          <input type="date" id="petdob" name="petdob">
          <br>
          <br>
          <label class="form-label">Pet Breed</label>
          <select id="petspecies" name="petspecies">
            <option value="" disabled selected>Select a Breed</option>
            <option value=1>American Bulldog</option>
            <option value=2>American Pit Bull Terrier</option>
            <option value=3>Beagle</option>
            <option value=4>Bulldog</option>
            <option value=5>Collie</option>
            <option value=6>Dachshund</option>
            <option value=7>Dalmatian</option>
          </select>
          <br>
          <br>
          <label class="form-label">Owner's Name</label>
          <select id="ownername" name="ownername">
            <option value="" disabled selected>Select a Pet Owner</option>
            <?php
             $sql = "SELECT * FROM Owner";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Owner_ID'],">" . $row['Owner_FName'] . " " . $row['Owner_LName'] . "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <label class="form-label">Veterinarian's Name</label>
          <select id="vetname" name="vetname">
            <option value="" disabled selected>Select a Veterinarian</option>
            <?php
             $sql = "SELECT * FROM Vet";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Vet_ID'],">" . $row['Vet_FName'] . " " . $row['Vet_LName'] . "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <label class="form-label">Treatment Name</label>
          <select id="treatname" name="treatname">
            <option value="" disabled selected>Select a Treatment</option>
            <?php
             $sql = "SELECT * FROM Treatment";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Treatment_ID'],">" . $row['Treatment_ID'] . " " . $row['Treatment_Name'] . "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <label class="form-label">Pet Diet Prescription</label>
          <select id="dietname" name="dietname">
            <option value="" disabled selected>Select a Diet Plan</option>
            <?php
             $sql = "SELECT * FROM Diet";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Diet_ID'],">" . $row['Diet_ID'] . " " . $row['Diet_Name'] . "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <label class="form-label">Pet Exercise Plan</label>
          <select id="exercisename" name="exercisename">
            <option value="" disabled selected>Select an Exercise Plan</option>
            <?php
             $sql = "SELECT * FROM Exercise";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Exercise_ID'],">" . $row['Exercise_ID'] . " " . $row['Exercise_Name'] . "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <label class="form-label">Pet Diagnosis</label>
          <select id="diagnosisname" name="diagnosisname">
            <option value="" disabled selected>Select a Diagnosis</option>
            <?php
             $sql = "SELECT * FROM Diagnosis";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Diagnosis_ID'],">" . $row['Diagnosis_ID'] . " " . $row['Diagnosis_Name'] . "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <input type="submit" id="newpetsubmit" class="btn btn-success">
        </fieldset>
        <h4>Need to add a new Treatment, Diet Plan, Exercise Plan or Diagnosis? Click the link below.</h4>
        <a href="petinforetriever.php">Here</a>
      </form>
      <script>
        $("#newpetadd").submit(function(event) {
          event.preventDefault(); /*Stops redirect*/
          var $form = $(this),
          url = $form.attr('action');
          var posting = $.post(url, {
            petname: $('#petname').val(),
            petdob: $('#petdob').val(),
            petspecies: $('#petspecies').val(),
            ownername: $('#ownername').val(),
            vetname: $('#vetname').val(),
            treatname: $('#treatname').val(),
            dietname: $('#dietname').val(),
            exercisename: $('#exercisename').val(),
            diagnosisname: $('#diagnosisname').val()
          });
          posting.done(function(data) {
            alert("Form successfully submitted");
          });
          posting.fail(function() {
            alert("Error: Form not submitted");
          });
        });
      </script>
      <form id="petmodify" action="petupdate.php" method="post">
        <div class="main-card-title">Modify Existing Pet Entry Form</div>
        <fieldset>
          <label class="form-label">Pet ID and Name</label>
          <select id="updpetname" name="petname">
            <option value="" disabled selected>Select a Pet</option>
            <?php
             $sql = "SELECT * FROM Pet";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Pet_ID'],">" . $row['Pet_ID'] . " " . $row['Pet_Name'] .  "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <label class="form-label">Pet Owner</label>
          <select id="updownername" name="ownername">
            <option value="" disabled selected>Select a Pet Owner</option>
            <?php
             $sql = "SELECT * FROM Owner";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Owner_ID'],">" . $row['Owner_FName'] . " " . $row['Owner_LName'] . "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <label class="form-label">Pet Date of Birth</label>
          <input type="date" id="updpetdob" name="petdob">
          <br>
          <br>
          <label class="form-label">Pet Breed</label>
          <select id="updpetspecies" name="petspecies">
            <option value="" disabled selected>Select a Breed</option>
            <option value=1>American Bulldog</option>
            <option value=2>American Pit Bull Terrier</option>
            <option value=3>Beagle</option>
            <option value=4>Bulldog</option>
            <option value=5>Collie</option>
            <option value=6>Dachshund</option>
            <option value=7>Dalmatian</option>
          </select>
          <br>
          <br>
          <label class="form-label">Veterinarian's Name</label>
          <select id="updvetname" name="vetname">
            <option value="" disabled selected>Select a Veterinarian</option>
            <?php
             $sql = "SELECT * FROM Vet";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Vet_ID'],">" . $row['Vet_FName'] . " " . $row['Vet_LName'] . "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <label class="form-label">Treatment Name</label>
          <select id="updtreatname" name="treatname">
            <option value="" disabled selected>Select a Treatment</option>
            <?php
             $sql = "SELECT * FROM Treatment";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Treatment_ID'],">" . $row['Treatment_ID'] . " " . $row['Treatment_Name'] . "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <label class="form-label">Pet Diet Prescription</label>
          <select id="upddietname" name="dietname">
            <option value="" disabled selected>Select a Diet Plan</option>
            <?php
             $sql = "SELECT * FROM Diet";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Diet_ID'],">" . $row['Diet_ID'] . " " . $row['Diet_Name'] . "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <label class="form-label">Pet Exercise Plan</label>
          <select id="updexercisename" name="exercisename">
            <option value="" disabled selected>Select an Exercise Plan</option>
            <?php
             $sql = "SELECT * FROM Exercise";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Exercise_ID'],">" . $row['Exercise_ID'] . " " . $row['Exercise_Name'] . "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <label class="form-label">Pet Diagnosis</label>
          <select id="upddiagnosisname" name="diagnosisname">
            <option value="" disabled selected>Select a Diagnosis</option>
            <?php
             $sql = "SELECT * FROM Diagnosis";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Diagnosis_ID'],">" . $row['Diagnosis_ID'] . " " . $row['Diagnosis_Name'] . "</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <button type="submit" id="updsubmit" class="btn btn-success">Submit</button>
        </fieldset>
        <h4>Need to add a new Treatment, Diet Plan, Exercise Plan or Diagnosis? Click the link below.</h4>
        <a href="petinforetriever.php">Here</a>
        <p id="nxforg">NXFORG 2021</p>
      </form>
      <script>
        $("#petmodify").submit(function(event) {
          event.preventDefault(); /*Stops redirect*/
          var $form = $(this),
          url = $form.attr('action');
          var posting = $.post(url, {
            petname: $('#updpetname').val(),
            petdob: $('#updpetdob').val(),
            petspecies: $('#updpetspecies').val(),
            ownername: $('#updownername').val(),
            vetname: $('#updvetname').val(),
            treatname: $('#updtreatname').val(),
            dietname: $('#upddietname').val(),
            exercisename: $('#updexercisename').val(),
            diagnosisname: $('#upddiagnosisname').val()
          });
          posting.done(function(data) {
            alert("Form successfully submitted");
          });
          posting.fail(function() {
            alert("Error: Form not submitted");
          });
        });
      </script>
   </div>
  </div>
</div>
</div>
</div>
</div>
<footer><p>NXFORG 2021</p>
  <!--<a href="#" class="fa fa-facebook"></a>
  <a href="#" class="fa fa-twitter"></a>
  <a href="#" class="fa fa-instagram"></a>
  <a href="#" class="fa fa-snapchat-ghost"></a>-->
</footer>
 </body>
</html>
