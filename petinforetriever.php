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
   <img class="logo" src="images/petplus.png" alt="PETPLUS">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
     <ul class="navbar-nav">
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="petmanager.php">PET MANAGER</a>
      </li>
      <li class="nav-item active">
       <a class="nav-link hvr-fade" href="petinforetriever.php">ADD NEW<span class="sr-only ">(current)</span></a>
      </li>
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="viewpet.php">VIEW PET</a>
      </li>
     </ul>
     <a href = "logout.php">Logout</a>
    </div>
   </nav>
<div id="homeimage">
 <img id="homebg" src="images/dogcliffs.jpg" alt="">
  <div class="card-img-overlay">
    <div id="form-container">
    <div class="container">
    <div class="row">
      <form id="treatadd" action="treatmentadd.php" method="post">
        <a href="petmanager.php">Go back</a>
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
            <option value="Other">Other</option>
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
      <script>
        $("#treatadd").submit(function(event) {
          event.preventDefault(); /*Stops redirect*/
          var $form = $(this),
          url = $form.attr('action');
          var posting = $.post(url, {
            treatmentname: $('#treatmentname').val(),
            treatmenttype: $('#treatmenttype').val(),
            treatdate: $('#treatdate').val(),
            treatmentnotes: $('#treatmentnotes').val(),
            treatmentcost: $('#treatmentcost').val()
          });
          posting.done(function(data) {
            alert("Form successfully submitted");
          });
          posting.fail(function() {
            alert("Error: Form not submitted");
          });
        });
      </script>
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
      <script>
        $("#dietadd").submit(function(event) {
          event.preventDefault(); /*Stops redirect*/
          var $form = $(this),
          url = $form.attr('action');
          var posting = $.post(url, {
            dietname: $('#dietname').val(),
            dietstartdate: $('#dietstartdate').val(),
            dietenddate: $('#dietenddate').val(),
            dietnotes: $('#dietnotes').val()
          });
          posting.done(function(data) {
            alert("Form successfully submitted");
          });
          posting.fail(function() {
            alert("Error: Form not submitted");
          });
        });
      </script>
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
      <script>
        $("#exerciseadd").submit(function(event) {
          event.preventDefault(); /*Stops redirect*/
          var $form = $(this),
          url = $form.attr('action');
          var posting = $.post(url, {
            exercisename: $('#exercisename').val(),
            exercisestartdate: $('#exercisestartdate').val(),
            exerciseenddate: $('#exerciseenddate').val(),
            exercisenotes: $('#exercisenotes').val()
          });
          posting.done(function(data) {
            alert("Form successfully submitted");
          });
          posting.fail(function() {
            alert("Error: Form not submitted");
          });
        });
      </script>
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
        <a href="petmanager.php">Go back</a>
      </form>
      <script>
        $("#diagnosisadd").submit(function(event) {
          event.preventDefault(); /*Stops redirect*/
          var $form = $(this),
          url = $form.attr('action');
          var posting = $.post(url, {
            diagnosisname: $('#diagnosisname').val(),
            diagnosistype: $('#diagnosistype').val(),
            diagnosisdate: $('#diagnosisdate').val(),
            diagnosisvet: $('#diagnosisvet').val()
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
  <a href="#" class="fa fa-facebook"></a>
  <a href="#" class="fa fa-twitter"></a>
  <a href="#" class="fa fa-instagram"></a>
  <a href="#" class="fa fa-snapchat-ghost"></a>
</footer>
 </body>
</html>
