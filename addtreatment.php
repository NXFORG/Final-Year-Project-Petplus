<?php
  //Database connection file
  include_once 'dbconnect.php';
  //Login session file
  include('loggedin.php');
?>
<!DOCTYPE html>
<html lang="en-gb">
 <head>
  <meta charset = "UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PETPLUS PET MANAGER</title>
  <!--Bootstrap library-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!--Custom stylesheet-->
  <link rel="stylesheet" type="text/css" href="addnew.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--jQuery library link-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 </head>
 <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <img class="logo" src="images/petpluslogowhite.png" alt="PETPLUS">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>
    <!--The vet can only access other site pages relevant to their role-->
    <div class="collapse navbar-collapse" id="navbarNav">
     <ul class="navbar-nav">
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="addmodify.php">PET MANAGER</a>
      </li>
      <li class="nav-item active">
       <a class="nav-link hvr-fade" href="addtreatment.php">ADD NEW<span class="sr-only ">(current)</span></a>
      </li>
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="vetview.php">VIEW PET</a>
      </li>
     </ul>
     <!--Clicking 'logout' ends the login session-->
     <a href = "logout.php">Logout</a>
    </div>
   </nav>
  <div class="card-img-overlay">
    <div id="form-container">
    <div class="container">
    <div class="row">
      <input id="goBack" type="button" onClick="document.location.href='addmodify.php'" value="Go to add/modify form" />
      <!--This first form is for a vet to add a new treatment to the system-->
      <form id="treatadd" action="treatmentadd.php" method="post">
        <div class="main-card-title">Add a Treatment</div>
        <fieldset>
          <label class="form-label">Treatment Name</label>
          <input type="text" id="treatmentname" name="treatmentname">
          <br>
          <br>
          <label class="form-label">Treatment Date</label>
          <input type="date" id="treatdate" name="treatdate">
          <br>
          <br>
          <label class="form-label">Treatment Notes</label>
          <input type="text" id="treatmentnotes" name="treatmentnotes">
          <br>
          <br>
          <!--A treatment can be one of the following types-->
          <label class="form-label">Treatment Type</label>
          <select id="treatmenttype" name="treatmenttype">
            <option value="Follow up">Follow-up</option>
            <option value="Surgery">Surgery</option>
            <option value="Blood test">Blood test</option>
            <option value="Other">Other</option>
          </select>
          <br>
          <br>
          <!--Retrieves fixed costs for all treatment types-->
          <label class="form-label">Treatment Cost</label>
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
          <label class="form-label">Treatment Performed By</label>
          <select id="treatmentvet" name="treatmentvet">
            <?php
             //Retrieves the current vet from their login email
             $sql = "SELECT * FROM Vet WHERE Vet_Email = '$check'";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
             if ($resultnum > 0){
              while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Vet_ID'],">" . $row['Vet_FName'] . " " . $row['Vet_LName'] . "</option>";
               }
             }
             //Retrieves other vets from the logged-in vet's employing practice
             $sql = "SELECT * FROM Vet
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check')";
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
          <!--Submits treatment form-->
          <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </fieldset>
      </form>
      <!--jQuery script to prevent redirection on form submission-->
      <script>
        $("#treatadd").submit(function(event) {
          event.preventDefault(); /*Stops redirect*/
          var $form = $(this),
          url = $form.attr('action');
          var posting = $.post(url, {
            //Form data field values
            treatmentname: $('#treatmentname').val(),
            treatdate: $('#treatdate').val(),
            treatmentnotes: $('#treatmentnotes').val(),
            treatmenttype: $('#treatmenttype').val(),
            treatmentcost: $('#treatmentcost').val(),
            treatmentvet: $('#treatmentvet').val()
          });
          //Form error checking
          posting.done(function(data) {
            alert("Form successfully submitted");
          });
          posting.fail(function() {
            alert("Error: Form not submitted");
          });
        });
      </script>
      <!--The second form is for a vet to add a new diet plan-->
      <form id="dietadd" action="dietadd.php" method="post">
        <div class="main-card-title">Add Diet Prescription</div>
        <fieldset>
          <label class="form-label">Diet Name</label>
          <input type="text" id="dietname" name="dietname">
          <br>
          <br>
          <label class="form-label">Diet Start Date</label>
          <input type="date" id="dietstartdate" name="dietstartdate">
          <br>
          <br>
          <label class="form-label">Diet End Date</label>
          <input type="date" id="dietenddate" name="dietenddate">
          <br>
          <br>
          <label class="form-label">Diet Notes</label>
          <input type="text" id="dietnotes" name="dietnotes">
          <br>
          <br>
          <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </fieldset>
      </form>
      <!--jQuery form to prevent default PHP navigation-->
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
          //Form error checking
          posting.done(function(data) {
            alert("Form successfully submitted");
          });
          posting.fail(function() {
            alert("Error: Form not submitted");
          });
        });
      </script>
      <!--Form to add a new exercise plan-->
      <form id="exerciseadd" action="exerciseadd.php" method="post">
        <div class="main-card-title">Add Exercise Plan</div>
        <fieldset>
          <label class="form-label">Exercise Name</label>
          <input type="text" id="exercisename" name="exercisename">
          <br>
          <br>
          <label class="form-label">Exercise Start Date</label>
          <input type="date" id="exercisestartdate" name="exercisestartdate">
          <br>
          <br>
          <label class="form-label">Exercise End Date</label>
          <input type="date" id="exerciseenddate" name="exerciseenddate">
          <br>
          <br>
          <label class="form-label">Exercise Notes</label>
          <input type="text" id="exercisenotes" name="exercisenotes">
          <br>
          <br>
          <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </fieldset>
      </form>
      <!--jQuery script to prevent default navigation on form submission-->
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
          //Form error checking
          posting.done(function(data) {
            alert("Form successfully submitted");
          });
          posting.fail(function() {
            alert("Error: Form not submitted");
          });
        });
      </script>
      <!--The last form is for adding a new diagnosis-->
      <form id="diagnosisadd" action="diagnosisadd.php" method="post">
        <div class="main-card-title">Add Diagnosis</div>
        <fieldset>
          <label class="form-label">Diagnosis Name</label>
          <input type="text" id="diagnosisname" name="diagnosisname">
          <br>
          <br>
          <label class="form-label">Diagnosis Type</label>
          <input type="text" id="diagnosistype" name="diagnosistype">
          <br>
          <br>
          <label class="form-label">Diagnosis Date</label>
          <input type="date" id="diagnosisdate" name="diagnosisdate">
          <br>
          <br>
          <label class="form-label">Diagnosed By (Vet)</label>
          <!--Retrieves the current vet's name from their login information-->
          <select id="diagnosisvet" name="diagnosisvet">
            <?php
              $sql = "SELECT DISTINCT Vet_ID, Vet_FName, Vet_LName FROM Vet
               JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
               WHERE Practice_ID = (SELECT Practice_ID
               FROM Practice
               JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
               WHERE Vet_Email = '$check')";
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
        <p id="nxforg">UP854443 2021</p>
      </form>
      <!--Link to add/modify form-->
      <input id="goBack2" type="button" onClick="document.location.href='addmodify.php'" value="Go to add/modify form" />
      <!--jQuery script to prevent default PHP navigation on form submission-->
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
          //Form error checking
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
<footer><p>UP854443 2021</p>
</footer>
 </body>
</html>