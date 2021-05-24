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
   <div id="form-header">
    <input id="showTreat" type="button" onClick="document.getElementById('treatadd').style.display='block';document.getElementById('dietadd').style.display='none';document.getElementById('exerciseadd').style.display='none';document.getElementById('diagnosisadd').style.display='none';" value=" Add Treatment" />
    <input id="showDiet" type="button" onClick="document.getElementById('treatadd').style.display='none';document.getElementById('dietadd').style.display='block';document.getElementById('exerciseadd').style.display='none';document.getElementById('diagnosisadd').style.display='none';" value="Add Diet" />
    <input id="showExercise" type="button" onClick="document.getElementById('treatadd').style.display='none';document.getElementById('dietadd').style.display='none';document.getElementById('exerciseadd').style.display='block';document.getElementById('diagnosisadd').style.display='none';" value="Add Exercise" />
    <input id="showDiagnosis" type="button" onClick="document.getElementById('treatadd').style.display='none';document.getElementById('dietadd').style.display='none';document.getElementById('exerciseadd').style.display='none';document.getElementById('diagnosisadd').style.display='block';" value="Add Diagnosis" />
   </div>
   <div id="form-container">
    <div class="container">
     <div class="row">
      <input id="goBack" type="button" onClick="document.location.href='addmodify.php'" value="Go to add/modify form" />
      <!--This first form is for a vet to add a new treatment to the system-->
      <form id="treatadd" action="treatmentadd.php" method="post">
        <div class="main-card-title">Add a Treatment</div>
        <fieldset>
          <label class="form-label">Treatment Name</label>
          <input type="text" id="treatmentname" name="treatmentname" minlength="4" required>
          <br>
          <br>
          <label class="form-label">Treatment Date</label>
          <input type="date" id="treatdate" name="treatdate" required>
          <br>
          <br>
          <label class="form-label">Treatment Notes</label>
          <input type="text" id="treatmentnotes" name="treatmentnotes">
          <br>
          <br>
          <!--A treatment can be one of the following types-->
          <label class="form-label">Treatment Type</label>
          <select id="treatmenttype" name="treatmenttype" required>
            <option value="Follow up">Follow-up</option>
            <option value="Surgery">Surgery</option>
            <option value="Blood test">Blood test</option>
            <option value="Other">Other</option>
          </select>
          <br>
          <br>
          <!--Retrieves fixed costs for all treatment types-->
          <label class="form-label">Treatment Cost</label>
          <input type="text" id="treatmentcost" name="treatmentcost" required>
          <br>
          <br>
          <label class="form-label">Treatment Performed By</label required>
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
          <!--Submits treatment form-->
          <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </fieldset>
      </form>
      <!--jQuery script to prevent redirection on form submission-->
      <script>
      $(document).ready(function() {
        $("#treatadd").validate({
         rules: {
           treatname: {
             required: true,
             minlength: 4
           },
           treatdate: {
             required: true
           },
           treatcost: {
             required: true
           },
           treatvet: {
             required: true
           }
         }
       });
     });
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
            location.reload();
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
          <input type="text" id="dietname" name="dietname" minlength="4" required>
          <br>
          <br>
          <label class="form-label">Diet Start Date</label>
          <input type="date" id="dietstartdate" name="dietstartdate" required>
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
          <label class="form-label">Diet Prescribed By</label>
          <select id="dietvet" name="dietvet" required>
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
          <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </fieldset>
      </form>
      <!--jQuery form to prevent default PHP navigation-->
      <script>
      $(document).ready(function() {
        $("#dietadd").validate({
         rules: {
           dietname: {
             required: true,
             minlength: 4
           },
           dietstartdate: {
             required: true
           },
           dietvet: {
             required: true
           }
         }
       });
     });
        $("#dietadd").submit(function(event) {
          event.preventDefault(); /*Stops redirect*/
          var $form = $(this),
          url = $form.attr('action');
          var posting = $.post(url, {
            dietname: $('#dietname').val(),
            dietstartdate: $('#dietstartdate').val(),
            dietenddate: $('#dietenddate').val(),
            dietnotes: $('#dietnotes').val(),
            dietvet: $('#dietvet').val()
          });
          //Form error checking
          posting.done(function(data) {
            alert("Form successfully submitted");
            location.reload();
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
          <input type="text" id="exercisename" name="exercisename" minlength="4" required>
          <br>
          <br>
          <label class="form-label">Exercise Start Date</label>
          <input type="date" id="exercisestartdate" name="exercisestartdate" required>
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
          <label class="form-label">Exercise Plan Set By</label>
          <select id="exercisevet" name="exercisevet" required>
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
          <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </fieldset>
      </form>
      <!--jQuery script to prevent default navigation on form submission-->
      <script>
      $(document).ready(function() {
        $("#exerciseadd").validate({
         rules: {
           exercisename: {
             required: true,
             minlength: 4
           },
           exercisestartdate: {
             required: true
           },
           exercisevet: {
             required: true
           }
         }
       });
     });
        $("#exerciseadd").submit(function(event) {
          event.preventDefault(); /*Stops redirect*/
          var $form = $(this),
          url = $form.attr('action');
          var posting = $.post(url, {
            exercisename: $('#exercisename').val(),
            exercisestartdate: $('#exercisestartdate').val(),
            exerciseenddate: $('#exerciseenddate').val(),
            exercisenotes: $('#exercisenotes').val(),
            exercisevet: $('#exercisevet').val()
          });
          //Form error checking
          posting.done(function(data) {
            alert("Form successfully submitted");
            location.reload();
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
          <input type="text" id="diagnosisname" name="diagnosisname" minlength="4" required>
          <br>
          <br>
          <label class="form-label">Diagnosis Type</label>
          <input type="text" id="diagnosistype" name="diagnosistype" required>
          <br>
          <br>
          <label class="form-label">Diagnosis Date</label>
          <input type="date" id="diagnosisdate" name="diagnosisdate" required>
          <br>
          <br>
          <label class="form-label">Diagnosed By (Vet)</label>
          <!--Retrieves the current vet's name from their login information-->
          <select id="diagnosisvet" name="diagnosisvet" required>
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
          <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </fieldset>
      </form>
      <!--Link to add/modify form-->
      <input id="goBack2" type="button" onClick="document.location.href='addmodify.php'" value="Go to add/modify form" />
      <!--jQuery script to prevent default PHP navigation on form submission-->
      <script>
        $(document).ready(function() {
          $("#diagnosisadd").validate({
           rules: {
             diagnosisname : {
               required: true,
               minlength: 4
             },
             diagnosistype: {
               required: true
             },
             diagnosisdate: {
               required: true
             },
             diagnosisvet: {
               required: true
             }
           }
         });
       });
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
            location.reload();
          });
          posting.fail(function() {
            alert("Error: Form not submitted");
          });
        });
      </script>
   </div>
  </div>
</div>
<script type="text/javascript">
  document.getElementById("treatadd").style.display="block";
  document.getElementById("dietadd").style.display="none";
  document.getElementById("exerciseadd").style.display="none";
  document.getElementById("diagnosisadd").style.display="none";
</script>
</div>
</div>
</div>
<footer><p>UP854443 2021</p>
</footer>
 </body>
</html>
