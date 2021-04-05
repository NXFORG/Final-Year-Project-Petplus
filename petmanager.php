<?php
  include_once 'petplus.php';
  include('loggedin.php');
  include('modinstance.php');
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset = "UTF 8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PETPLUS PET MANAGER</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw==" crossorigin="anonymous">-->
  <link rel="stylesheet" type="text/css" href="petaddmod.css">
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
      <input id="showModify" type="button" onclick="modifyShow();" value="Need to modify a pet's details instead?" />
      <input id="showAdd" type="button" onclick="addShow();" value="Need to add a new pet?" />
      <script type="text/javascript">
        $("#showAdd").hide();
      </script>
      <script type="text/javascript">
       function addShow(){
         document.getElementById("newpetadd").style.display="block";
         document.getElementById("showModify").style.display="block";
         document.getElementById("addNewAdd").style.display="block";
         $("#petmodify").hide();
         $("#showAdd").hide();
         $("#addNewModify").hide();
         $("#getPetName").hide();
       }
      </script>
      <script type="text/javascript">
        function modifyShow(){
          document.getElementById("newpetadd").style.display="none";
          document.getElementById("showModify").style.display="none";
          document.getElementById("addNewAdd").style.display="none";
          $("#petmodify").hide();
          $("#showAdd").show();
          $("#addNewModify").show();
          $("#getPetName").show();
        }
      </script>
      <form id="newpetadd" action="petadd.php" method="post">
        <div class="main-card-title">New Pet Entry Form</div>
        <fieldset>
          <label class="form-label">Pet Name</label>
          <input type="text" id="petname" name="petname">
          <br>
          <br>
          <label class="form-label">Microchip ID</label>
          <input type="text" id="microid" name="microid">
          <br>
          <br>
          <label class="form-label">Pet Date of Birth</label>
          <input type="date" id="petdob" name="petdob">
          <br>
          <br>
          <label class="form-label">Pet Breed</label>
          <!--<input type="text" id="srch" name="search">-->
          <select id="petspecies" name="petspecies">
            <option value="" disabled selected>Select a Breed</option>
            <?php
             $sql = "SELECT * FROM Species";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
             if ($resultnum > 0){
              while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Species_ID'],">" . $row['Species_Breed'] . " (" . $row['Species_Name'] . ")</option>";
               }
             }?>
          </select>
          <br>
          <br>
          <label class="form-label">Owner's Name</label>
          <select id="ownername" class="dropdownSelect" name="ownername">
            <option value="" disabled selected>Select a Pet Owner</option>
            <?php
             $sql = "SELECT DISTINCT Owner_ID, Owner_FName, Owner_LName FROM Owner
             JOIN Pet ON Pet.Pet_Owner_ID = Owner.Owner_ID
             JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check')";
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
            <?php
             $sql = "SELECT * FROM Vet WHERE Vet_Email = '$check'";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
             if ($resultnum > 0){
              while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Vet_ID'],">" . $row['Vet_FName'] . " " . $row['Vet_LName'] . "</option>";
               }
             }
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
          <label class="form-label">Last Treatment Recieved</label>
          <select id="treatname" name="treatname">
            <option value="" disabled selected>Select a Treatment</option>
            <?php
             $sql = "SELECT DISTINCT Treatment_ID, Treatment_Name FROM Treatment JOIN Pet ON Pet.Pet_Treatment_ID = Treatment.Treatment_ID
             JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check') AND Treatment_Date < CURDATE() ORDER BY Treatment_ID";
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
          <label class="form-label">Next Treatment Booked (Leave blank if not applicable)</label>
          <input type="text" id="futuretreat" name="futuretreat" value="N/A">
          <br>
          <br>
          <label class="form-label">Pet Diet Prescription</label>
          <select id="dietname" name="dietname">
            <option value="" disabled selected>Select a Diet Plan</option>
            <?php
             $sql = "SELECT * FROM Diet WHERE Diet_Name = 'None' LIMIT 1";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
             if ($resultnum > 0){
              while ($row = mysqli_fetch_assoc($result)){
               echo "<option value=",$row['Diet_ID'],">" . $row['Diet_Name'] . "</option>";
              }
             }
             $sql = "SELECT DISTINCT Diet_ID, Diet_Name FROM Diet JOIN Pet ON Pet.Pet_Diet_ID = Diet.Diet_ID
             JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check') ORDER BY Diet_ID";
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
             $sql = "SELECT * FROM Exercise WHERE Exercise_Name = 'None' LIMIT 1";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
               echo "<option value=",$row['Exercise_ID'],">" . $row['Exercise_Name'] . "</option>";
               }
              }
             $sql = "SELECT DISTINCT Exercise_ID, Exercise_Name FROM Exercise JOIN Pet ON Pet.Pet_Exercise_ID = Exercise.Exercise_ID
             JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check') ORDER BY Exercise_ID";
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
             $sql = "SELECT * FROM Diagnosis WHERE Diagnosis_Name = 'None' LIMIT 1";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Diagnosis_ID'],">" . $row['Diagnosis_Name'] . "</option>";
               }
              }
             $sql = "SELECT Diagnosis_ID, Diagnosis_Name FROM Diagnosis JOIN Pet ON Pet.Pet_Diagnosis_ID = Diagnosis.Diagnosis_ID
             JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check') ORDER BY Diagnosis_ID";
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
        <h5>Need to add a new Treatment, Diet Plan, Exercise Plan or Diagnosis? Click the link below.</h5>
      </form>
      <input id="addNewAdd" type="button" onClick="document.location.href='petinforetriever.php'" value="Add new treatment" />
      <script>
        $("#newpetadd").submit(function(event) {
          event.preventDefault(); /*Stops redirect*/
          var $form = $(this),
          url = $form.attr('action');
          var posting = $.post(url, {
            petname: $('#petname').val(),
            microid: $('#microid').val(),
            petdob: $('#petdob').val(),
            petspecies: $('#petspecies').val(),
            ownername: $('#ownername').val(),
            vetname: $('#vetname').val(),
            treatname: $('#treatname').val(),
            futuretreat: $('#futuretreat').val(),
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
      <form id="getPetName" method="post">
        <script type="text/javascript">
          $("#getPetName").hide();
        </script>
       <div class="main-card-title">Modify Existing Pet Entry Form</div>
        <fieldset>
          <label class="form-label">Pet ID and Name</label>
          <select id="modpetname" name="modpetname">
            <option value="" disabled selected>Select a Pet</option>
            <?php
             $sql = "SELECT DISTINCT Pet_ID, Pet_Name FROM Pet
             JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check')";
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
        </fieldset>
        <input type="submit" name="getPetDetails" id="choosePet" class="btn btn-success">
        <input type="submit" name="clearPet" id="clearPet" class="btn btn-primary" value="Clear current selection">
      </form>
      <form id="petmodify" action="petupdate.php" method="post">
        <script>$('#petmodify').hide();</script>
        <?php
         if(isset($_POST['getPetDetails'])){
          $mpet = $_POST['modpetname'];
          $modid = $mpet;
          echo "<script>document.getElementById('newpetadd').style.display='none';document.getElementById('showModify').style.display='none'; document.getElementById('addNewAdd').style.display='none'; $('#showAdd').show(); $('#addNewModify').show(); $('#getPetName').show(); $('#petmodify').show();</script>";
         }
         if(isset($_POST['clearPet'])){
          $modid = "";
         }
        ?>
        <div class="main-card-title">Change Pet Details</div>
        <fieldset>
          <select type="hidden" id="updpetid" name="updpetid">
            <?php
             $sql = "SELECT DISTINCT Pet_ID FROM Pet
             JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check') AND Pet_ID = '$modid'";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Pet_ID'],">" . $row['Pet_ID'] . "</option>";
               }
              }
            ?>
          </select>

          <br>
          <br>
          <label class="form-label">Pet Owner</label>
          <select id="updownername" name="updownername">
            <?php
            $sql = "SELECT * FROM Owner JOIN Pet ON Pet.Pet_Owner_ID = Owner.Owner_ID WHERE Pet_ID = '$modid'";
            $result = mysqli_query($conn, $sql);
            $resultnum = mysqli_num_rows($result);
             if ($resultnum > 0){
              while ($row = mysqli_fetch_assoc($result)){
               echo "<option value=",$row['Owner_ID'],">" . $row['Owner_FName'] . " " . $row['Owner_LName'] . " (Current)" . "</option>";
              }
             }
             $sql = "SELECT DISTINCT Owner_ID, Owner_FName, Owner_LName FROM Owner
             JOIN Pet ON Pet.Pet_Owner_ID = Owner.Owner_ID
             JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check')";
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
          <label class="form-label">Microchip ID</label>
          <?php
          $sql = "SELECT * FROM Pet WHERE Pet_ID = '$modid'";
          $result = mysqli_query($conn, $sql);
          $resultnum = mysqli_num_rows($result);
          if ($resultnum > 0){
           while ($row = mysqli_fetch_assoc($result)){
             echo "<input type='text' id='updpetmicroid' name='updpetmicroid' value=" . $row['Pet_System_ID'] . ">";
            }
          }
          ?>
          <br>
          <br>
          <label class="form-label">Pet Date of Birth</label>
          <?php
          $sql = "SELECT * FROM Pet WHERE Pet_ID = '$modid'";
          $result = mysqli_query($conn, $sql);
          $resultnum = mysqli_num_rows($result);
          if ($resultnum > 0){
           while ($row = mysqli_fetch_assoc($result)){
             echo "<input type='date' id='updpetdob' name='updpetdob' value=" . $row['Pet_DOB'] . ">";
            }
          }
          ?>
          <br>
          <br>
          <label class="form-label">Pet Breed</label>
          <select id="updpetspecies" name="updpetspecies">
            <?php
             $sql = "SELECT * FROM Species JOIN Pet ON Pet.Pet_Species_ID = Species.Species_ID WHERE Pet_ID = '$modid'";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
             if ($resultnum > 0){
              while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Species_ID'],">" . $row['Species_Breed'] . " (" . $row['Species_Name'] . ")</option>";
               }
             }
             $sql = "SELECT * FROM Species";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
              if ($resultnum > 0){
               while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Species_ID'],">" . $row['Species_Breed'] . " (" . $row['Species_Name'] . ")</option>";
               }
              }
             ?>
          </select>
          <br>
          <br>
          <label class="form-label">Veterinarian's Name</label>
          <select id="updvetname" name="updvetname">
            <?php
             $sql = "SELECT * FROM Vet JOIN Pet ON Pet.Pet_Vet_ID = Vet.Vet_ID WHERE Pet_ID = '$modid'";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
             if ($resultnum > 0){
              while ($row = mysqli_fetch_assoc($result)){
                echo "<option value=",$row['Vet_ID'],">" . $row['Vet_FName'] . " " . $row['Vet_LName'] . " (Current)" . "</option>";
               }
             }
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
          <label class="form-label">Treatment Name</label>
          <select id="updtreatname" name="updtreatname">
            <?php
             $sql = "SELECT * FROM Treatment JOIN Pet ON Pet.Pet_Treatment_ID = Treatment.Treatment_ID WHERE Pet_ID = '$modid' AND Treatment_Date < CURDATE()";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
             if ($resultnum > 0){
              while ($row = mysqli_fetch_assoc($result)){
               echo "<option value=",$row['Treatment_ID'],">" . $row['Treatment_ID'] . " " . $row['Treatment_Name'] . " (Current)" . "</option>";
              }
             }
             $sql = "SELECT DISTINCT Treatment_ID, Treatment_Name FROM Treatment
             JOIN Pet ON Pet.Pet_Treatment_ID = Treatment.Treatment_ID
             JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check') AND Treatment_Date < CURDATE() ORDER BY Treatment_ID";
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
          <label class="form-label">Next Treatment Booked (Leave blank if not applicable)</label>
          <?php
          $sql = "SELECT * FROM Pet WHERE Pet_ID = '$modid'";
          $result = mysqli_query($conn, $sql);
          $resultnum = mysqli_num_rows($result);
          if ($resultnum > 0){
           while ($row = mysqli_fetch_assoc($result)){
             echo "<input type='text' id='updfuturetreat' name='updfuturetreat' value=" . $row['Pet_Next_Treatment_Date'] . ">";
            }
          }
          ?>
          <br>
          <br>
          <label class="form-label">Pet Diet Prescription</label>
          <select id="upddietname" name="upddietname">
            <?php
            $sql = "SELECT * FROM Diet JOIN Pet ON Pet.Pet_Diet_ID = Diet.Diet_ID WHERE Pet_ID = '$modid'";
            $result = mysqli_query($conn, $sql);
            $resultnum = mysqli_num_rows($result);
             if ($resultnum > 0){
              while ($row = mysqli_fetch_assoc($result)){
               echo "<option value=",$row['Diet_ID'],">" . $row['Diet_ID'] . " " . $row['Diet_Name'] . " (Current)" . "</option>";
              }
             }
             $sql = "SELECT DISTINCT Diet_ID, Diet_Name FROM Diet
             JOIN Pet ON Pet.Pet_Diet_ID = Diet.Diet_ID
             JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check') ORDER BY Diet_ID";
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
          <select id="updexercisename" name="updexercisename">
            <?php
             $sql = "SELECT * FROM Exercise JOIN Pet ON Pet.Pet_Exercise_ID = Exercise.Exercise_ID WHERE Pet_ID = '$modid'";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
             if ($resultnum > 0){
              while ($row = mysqli_fetch_assoc($result)){
               echo "<option value=",$row['Exercise_ID'],">" . $row['Exercise_ID'] . " " . $row['Exercise_Name'] . " (Current)" . "</option>";
              }
             }
             $sql = "SELECT DISTINCT Exercise_ID, Exercise_Name FROM Exercise
             JOIN Pet ON Pet.Pet_Exercise_ID = Exercise.Exercise_ID
             JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check') ORDER BY Exercise_ID";
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
          <select id="upddiagnosisname" name="upddiagnosisname">
            <?php
             $sql = "SELECT * FROM Diagnosis JOIN Pet ON Pet.Pet_Diagnosis_ID = Diagnosis.Diagnosis_ID WHERE Pet_ID = '$modid'";
             $result = mysqli_query($conn, $sql);
             $resultnum = mysqli_num_rows($result);
             if ($resultnum > 0){
              while ($row = mysqli_fetch_assoc($result)){
               echo "<option value=",$row['Diagnosis_ID'],">" . $row['Diagnosis_ID'] . " " . $row['Diagnosis_Name'] . " (Current)" . "</option>";
              }
             }
             $sql = "SELECT DISTINCT Diagnosis_ID, Diagnosis_Name FROM Diagnosis
             JOIN Pet ON Pet.Pet_Diagnosis_ID = Diagnosis.Diagnosis_ID
             JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
             JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
             WHERE Practice_ID = (SELECT Practice_ID
             FROM Practice
             JOIN Vet ON Vet.Vet_Practice_ID = Practice.Practice_ID
             WHERE Vet_Email = '$check') ORDER BY Diagnosis_ID";
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
        <!--<h5>Need to add a new Treatment, Diet Plan, Exercise Plan or Diagnosis? Click the link below.</h5>-->
        <p id="nxforg">NXFORG 2021</p>
      </form>
      <input id="addNewModify" type="button" onClick="document.location.href='petinforetriever.php'" value="Add new treatment"/>
      <script>
        $("#addNewModify").hide();
        $("#petmodify").submit(function(event) {
          event.preventDefault(); /*Stops redirect*/
          var $form = $(this),
          url = $form.attr('action');
          var posting = $.post(url, {
            updpetid: $('#updpetid').val(),
            updpetdob: $('#updpetdob').val(),
            updpetmicroid: $('#updpetmicroid').val(),
            updpetspecies: $('#updpetspecies').val(),
            updownername: $('#updownername').val(),
            updvetname: $('#updvetname').val(),
            updtreatname: $('#updtreatname').val(),
            updfuturetreat: $('#updfuturetreat').val(),
            upddietname: $('#upddietname').val(),
            updexercisename: $('#updexercisename').val(),
            upddiagnosisname: $('#upddiagnosisname').val()
          });
          posting.done(function(data) {
            alert("Form successfully submitted");
          });
          posting.fail(function() {
            alert("Error: Form not submitted");
          });
        });
        function modFormShow(){
          $('#petmodify').show();
        }
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
