<?php
  include_once 'petplus.php';
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
   <img class="logo" src="images/petplus.png" alt="PETPLUS">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
     <ul class="navbar-nav">
      <li class="nav-item active">
       <a class="nav-link hvr-fade" href="index.html">HOME</a>
      </li>
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="about.html">ABOUT</a>
      </li>
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="petmanager.html">PET MANAGER<span class="sr-only ">(current)</span></a>
      </li>
     </ul>
    </div>
   </nav>
<div id="homeimage">
 <img id="homebg" src="images/dogcliffs.jpg" alt="">
  <div class="card-img-overlay">
    <div id="form-container">
    <div class="container">
    <div class="row">
      <form id="newpetadd" action="petadd.php" method="post">
        <div class="main-card-title">New Pet Entry Form</div>
        <fieldset>
          <legend>Pet Name<legend>
          <input type="text" class="form-control" id="petname" name="petname">
          <br>
          <legend>Pet Date of Birth<legend>
          <input type="date" class="form-control" id="petdob" name="petdob">
          <br>
          <legend>Pet Species<legend>
          <select id="petspecies" name="petspecies">
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
          <legend>Owner's Name<legend>
          <select id="ownername" name="ownername">
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
          <legend>Veterinarian's Name<legend>
          <select id="vetname" name="vetname">
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
          <legend>Treatment Name<legend>
          <select id="treatname" name="treatname">
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
          <legend>Pet Diet Prescription<legend>
          <select id="dietname" name="dietname">
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
          <legend>Pet Exercise Plan<legend>
          <select id="exercisename" name="exercisename">
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
          <legend>Pet Diagnosis<legend>
          <select id="diagnosisname" name="diagnosisname">
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
          <legend>Pet Name<legend>
          <select id="updpetname" name="petname">
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
          <legend>Pet Owner<legend>
          <select id="updownername" name="ownername">
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
          <legend>Pet Date of Birth<legend>
          <input type="date" class="form-control" id="updpetdob" name="petdob">
          <br>
          <legend>Pet Species<legend>
          <select id="updpetspecies" name="petspecies">
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
          <legend>Veterinarian's Name<legend>
          <select id="updvetname" name="vetname">
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
          <legend>Treatment Name<legend>
          <select id="updtreatname" name="treatname">
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
          <legend>Pet Diet Prescription<legend>
          <select id="upddietname" name="dietname">
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
          <legend>Pet Exercise Plan<legend>
          <select id="updexercisename" name="exercisename">
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
          <legend>Pet Diagnosis<legend>
          <select id="upddiagnosisname" name="diagnosisname">
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
      <form id="treatadd" action="treatmentadd.php" method="post">
        <div class="main-card-title">Add Treatment</div>
        <fieldset>
          <legend>Treatment Name<legend>
          <input type="text" class="form-control" id="treatmentname" name="treatmentname">
          <br>
          <br>
          <legend>Treatment Date<legend>
          <input type="date" class="form-control" id="treatdate" name="treatdate">
          <br>
          <br>
          <legend>Treatment Notes<legend>
          <input type="text" class="form-control" id="treatmentnotes" name="treatmentnotes">
          <br>
          <br>
          <legend>Treatment Type<legend>
          <select id="treatmenttype" name="treatmenttype">
            <option value="Follow up">Follow-up</option>
            <option value="Surgery">Surgery</option>
            <option value="Blood test">Blood test</option>
            <option value="Blood test">Other</option>
          </select>
          <br>
          <br>
          <legend>Treatment Cost<legend>
          <select id="treatmentcost" name="treatmentcost">
            <?php
              $sql = "SELECT * FROM Treatment_Cost";
              $result = mysqli_query($conn, $sql);
              $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
                while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Treatment_Cost_ID'],">" . $row['Treatment_Cost'] . "</option>";
                }
              }
              ?>
          </select>
          <br>
          <br>
          <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </fieldset>
      </form>
      <form id="dietadd" action="dietadd.php" method="post">
        <div class="main-card-title">Add Diet Prescription</div>
        <fieldset>
          <legend>Diet Name<legend>
          <input type="text" class="form-control" id="dietname" name="dietname">
          <br>
          <br>
          <legend>Diet Start Date<legend>
          <input type="date" class="form-control" id="dietstartdate" name="dietstartdate">
          <br>
          <br>
          <legend>Diet End Date<legend>
          <input type="date" class="form-control" id="dietenddate" name="dietenddate">
          <br>
          <br>
          <legend>Diet Notes<legend>
          <input type="text" class="form-control" id="dietnotes" name="dietnotes">
          <br>
          <br>
          <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </fieldset>
      </form>
      <form id="exerciseadd" action="exerciseadd.php" method="post">
        <div class="main-card-title">Add Exercise Plan</div>
        <fieldset>
          <legend>Exercise Name<legend>
          <input type="text" class="form-control" id="exercisename" name="exercisename">
          <br>
          <br>
          <legend>Exercise Start Date<legend>
          <input type="date" class="form-control" id="exercisestartdate" name="exercisestartdate">
          <br>
          <br>
          <legend>Exercise End Date<legend>
          <input type="date" class="form-control" id="exerciseenddate" name="exerciseenddate">
          <br>
          <br>
          <legend>Exercise Notes<legend>
          <input type="text" class="form-control" id="exercisenotes" name="exercisenotes">
          <br>
          <br>
          <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </fieldset>
      </form>
      <form id="diagnosisadd" action="diagnosisadd.php" method="post">
        <div class="main-card-title">Add Diagnosis</div>
        <fieldset>
          <legend>Diagnosis Name<legend>
          <input type="text" class="form-control" id="diagnosisname" name="diagnosisname">
          <br>
          <br>
          <legend>Diagnosis Type<legend>
          <input type="text" class="form-control" id="diagnosistype" name="diagnosistype">
          <br>
          <br>
          <legend>Diagnosis Date<legend>
          <input type="date" class="form-control" id="diagnosisdate" name="diagnosisdate">
          <br>
          <br>
          <legend>Diagnosed By (Vet)<legend>
          <select id="diagnosisvet" name="diagnosisvet">
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
          <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </fieldset>
      </form>
   </div>
  </div>
</div>
</div>
</div>
</div>
<footer><p>NXFORG 2021</p>
  <a href="#" class="fa fa-facebook"></a>
  <a href="#" class="fa fa-twitter"></a>
  <a href="#" class="fa fa-instagram"></a>
  <a href="#" class="fa fa-snapchat-ghost"></a>
</footer>
 </body>
</html>
