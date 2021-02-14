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
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="viewpets.css">
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
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="petmanager.php">PET MANAGER</a>
      </li>
      <li class="nav-item">
       <a class="nav-link hvr-fade" href="petinforetriever.php">ADD NEW</a>
      </li>
      <li class="nav-item active">
       <a class="nav-link hvr-fade" href="viewpet.php">VIEW PET<span class="sr-only ">(current)</span></a>
      </li>
     </ul>
     <a href = "logout.php">Logout</a>
    </div>
   </nav>
  <div class="card-img-overlay">
    <div id="form-container">
    <div class="container">
    <div class="row">
      <div class="main-card-title">Pet Details and Owner Contact Information</div>
       <form class="formentry" action="" method="post">
        <fieldset>
          <label class="form-label">Pet ID</label>
          <input type="text" id="petid" name="petid">
          <br>
          <br>
          <label class="form-label">Pet Name</label>
          <input type="text" id="petname" name="petname">
          <br>
          <br>
         <input type="submit" name="choosepet" class="btn btn-success">
       </fieldset>
     </form>
      <?php
       if(isset($_POST['choosepet'])){
        $petid = $_POST['petid'];
        $petname = $_POST['petname'];
        $result = mysqli_query($conn,"SELECT Pet_ID, Pet_Name, Pet_DOB, Species_Name, Species_Breed, Owner_FName, Owner_LName, Owner_Phone, Owner_Email, House_Number, Street_Postcode FROM Pet JOIN Owner ON Owner.Owner_ID = Pet.Pet_Owner_ID
         JOIN Owner_Location ON Owner_Location.Owner_Location_ID = Owner.Owner_Location_ID JOIN Species ON Species.Species_ID = Pet.Pet_Species_ID WHERE Pet.Pet_ID = '$petid' OR Pet.Pet_Name = '$petname'");
          while($row = mysqli_fetch_array($result)){
              echo "<ul id=\"treatmentresults\">";
              echo "<li><b>Pet ID:</b>" . " " . $row['Pet_ID'] . "</li>";
              echo "<li><b>Pet Name:</b>" . " " . $row['Pet_Name'] . "</li>";
              echo "<li><b>Pet Date of Birth:</b>" . " " . $row['Pet_DOB'] . "</li>";
              echo "<li><b>Species:</b>" . " " . $row['Species_Name'] . "</li>";
              echo "<li><b>Breed:</b>" . " " . $row['Species_Breed'] . "</li>";
              echo "<li><b>Owner's First Name:</b>" . " " . $row['Owner_FName'] . "</li>";
              echo "<li><b>Owner's Last Name:</b>" . " " . $row['Owner_LName'] . "</li>";
              echo "<li><b>Owner's Phone Number:</b>" . " " . $row['Owner_Phone'] . "</li>";
              echo "<li><b>Owner's Email Address:</b>" . " " . $row['Owner_Email'] . "</li>";
              echo "<li><b>Owner's House Number:</b>" . " " . $row['House_Number'] . "</li>";
              echo "<li><b>Owner's Postcode:</b>" . " " . $row['Street_Postcode'] . "</li>";
              echo "</ul>";
            }
            mysqli_close($conn);
          }
          ?>
       </div>
      </div>
     </div>
     <div id="form-container">
      <div class="container">
        <div class="row">
          <div class="main-card-title">Pet Treatment Information</div>
           <form class="formentry" action="" method="post">
            <fieldset>
              <label class="form-label">Pet ID</label>
              <input type="text" id="petidtreat" name="petidtreat">
              <br>
              <br>
              <label class="form-label">Pet Name</label>
              <input type="text" id="petnametreat" name="petnametreat">
              <br>
              <br>
             <input type="submit" name="choosetreatment" class="btn btn-success">
           </fieldset>
         </form>
         <?php
          if(isset($_POST['choosetreatment'])){
           $petidtreat = $_POST['petidtreat'];
           $petnametreat = $_POST['petnametreat'];
           $result = mysqli_query($conn,"SELECT Pet_ID, Pet_Name, Diagnosis_Name, Diagnosis_Date, Treatment_Name,
             Treatment_Type, Treatment_Date, Treatment_Notes, Vet_FName, Vet_LName, Vet_Title, Vet_Phone,
             Vet_Email, Practice_Name, Practice_Phone, Practice_Email, Practice_Number, Practice_Postcode FROM Pet
             JOIN Diagnosis ON Diagnosis.Diagnosis_ID = Pet.Pet_Diagnosis_ID JOIN Treatment ON
             Treatment.Treatment_ID = Pet.Pet_Treatment_ID JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID JOIN Practice
             ON Practice.Practice_ID = Vet.Vet_Practice_ID JOIN Practice_Location ON Practice_Location.Practice_Location_ID
             = Practice.Practice_Location_ID WHERE Pet.Pet_ID = '$petidtreat' OR Pet.Pet_Name = '$petnametreat'");
             while($row = mysqli_fetch_array($result)){
                 echo "<ul id=\"treatmentresults\">";
                 echo "<li><b>Pet ID:</b> " . " " . $row['Pet_ID'] . "</li>";
                 echo "<li><b>Pet Name:</b> " . " " . $row['Pet_Name'] . "</li>";
                 echo "<li><b>Diagnosis:</b> " . " " . $row['Diagnosis_Name'] . "</li>";
                 echo "<li><b>Date of Diagnosis:</b> " . " " . $row['Diagnosis_Date'] . "</li>";
                 echo "<li><b>Treatment Name:</b> " . " " . $row['Treatment_Name'] . "</li>";
                 echo "<li><b>Treatment Type:</b> " . " " . $row['Treatment_Type'] . "</li>";
                 echo "<li><b>Treatment Date:</b> " . " " . $row['Treatment_Date'] . "</li>";
                 echo "<li><b>Treatment Notes:</b> " . " " . $row['Treatment_Notes'] . "</li>";
                 echo "<li><b>Vet's First Name:</b> " . " " . $row['Vet_FName'] . "</li>";
                 echo "<li><b>Vet's Last Name:</b>" . " " . $row['Vet_LName'] . "</li>";
                 echo "<li><b>Vet's Accreditations:</b> " . " " . $row['Vet_Title'] . "</li>";
                 echo "<li><b>Vet's Phone Number:</b> " . " " . $row['Vet_Phone'] . "</li>";
                 echo "<li><b>Vet's Email Address:</b> " . " " . $row['Vet_Email'] . "</li>";
                 echo "<li><b>Practice Name:</b> " . " " . $row['Practice_Name'] . "</li>";
                 echo "<li><b>Practice Phone Number:</b> " . " " . $row['Practice_Phone'] . "</li>";
                 echo "<li><b>Practice Email Address:</b> " . " " . $row['Practice_Email'] . "</li>";
                 echo "<li><b>Practice Street Number:</b> " . " " . $row['Practice_Number'] . "</li>";
                 echo "<li><b>Practice Postcode:</b> " . " " . $row['Practice_Postcode'] . "</li>";
                 echo "</ul>";
               }
               mysqli_close($conn);
             }
             ?>
           </div>
         </div>
       </div>
       <div id="form-container">
        <div class="container">
          <div class="row">
            <div class="main-card-title">Pet Diet and Exercise Plans</div>
             <form class="formentry" action="" method="post">
              <fieldset>
                <label class="form-label">Pet ID</label>
                <input type="text" id="petiddietex" name="petiddietex">
                <br>
                <br>
                <label class="form-label">Pet Name</label>
                <input type="text" id="petnamedietex" name="petnamedietex">
                <br>
                <br>
               <input type="submit" name="choosedietex" class="btn btn-success">
             </fieldset>
             <p id="nxforg">NXFORG 2021</p>
           </form>
           <?php
            if(isset($_POST['choosedietex'])){
             $petiddietex = $_POST['petiddietex'];
             $petnamedietex = $_POST['petnamedietex'];
             $result = mysqli_query($conn,"SELECT Pet_ID, Pet_Name, Diet_Name, Diet_Start, Diet_End, Diet_Notes, Exercise_Name,
               Exercise_Type, Exercise_Start, Exercise_End, Exercise_Notes, Vet_FName, Vet_LName, Vet_Title, Vet_Phone,
               Vet_Email, Practice_Name, Practice_Phone, Practice_Email, Practice_Number, Practice_Postcode FROM Pet
               JOIN Diet ON Diet.Diet_ID = Pet.Pet_Diet_ID JOIN Exercise ON Exercise.Exercise_ID = Pet.Pet_Exercise_ID JOIN
               Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID JOIN
               Practice_Location ON Practice_Location.Practice_Location_ID = Practice.Practice_Location_ID WHERE Pet.Pet_ID
               = '$petiddietex' OR Pet.Pet_Name = '$petnamedietex'");
               while($row = mysqli_fetch_array($result)){
                   echo "<ul id=\"treatmentresults\">";
                   echo "<li><b>Pet ID:</b> " . " " . $row['Pet_ID'] . "</li>";
                   echo "<li><b>Pet Name:</b> " . " " . $row['Pet_Name'] . "</li>";
                   echo "<li><b>Diet Name:</b> " . " " . $row['Diet_Name'] . "</li>";
                   echo "<li><b>Diet Start Date:</b> " . " " . $row['Diet_Start'] . "</li>";
                   echo "<li><b>Diet End Date:</b> " . " " . $row['Diet_End'] . "</li>";
                   echo "<li><b>Diet Notes:</b> " . " " . $row['Diet_Notes'] . "</li>";
                   echo "<li><b>Exercise Name:</b> " . " " . $row['Exercise_Name'] . "</li>";
                   echo "<li><b>Exercise Type:</b> " . " " . $row['Exercise_Type'] . "</li>";
                   echo "<li><b>Exercise Start Date:</b> " . " " . $row['Exercise_Start'] . "</li>";
                   echo "<li><b>Exercise End Date:</b> " . " " . $row['Exercise_End'] . "</li>";
                   echo "<li><b>Exercise Notes:</b> " . " " . $row['Exercise_Notes'] . "</li>";
                   echo "<li><b>Vet's First Name:</b> " . " " . $row['Vet_FName'] . "</li>";
                   echo "<li><b>Vet's Last Name:</b>" . " " . $row['Vet_LName'] . "</li>";
                   echo "<li><b>Vet's Accreditations:</b> " . " " . $row['Vet_Title'] . "</li>";
                   echo "<li><b>Vet's Phone Number:</b> " . " " . $row['Vet_Phone'] . "</li>";
                   echo "<li><b>Vet's Email Address:</b> " . " " . $row['Vet_Email'] . "</li>";
                   echo "<li><b>Practice Name:</b> " . " " . $row['Practice_Name'] . "</li>";
                   echo "<li><b>Practice Phone Number:</b> " . " " . $row['Practice_Phone'] . "</li>";
                   echo "<li><b>Practice Email Address:</b> " . " " . $row['Practice_Email'] . "</li>";
                   echo "<li><b>Practice Street Number:</b> " . " " . $row['Practice_Number'] . "</li>";
                   echo "<li><b>Practice Postcode:</b> " . " " . $row['Practice_Postcode'] . "</li>";
                   echo "</ul>";
                 }
                 mysqli_close($conn);
               }
               ?>
             </div>
           </div>
         </div>
     </div>
  </body>
  <footer>
   <p>NXFORG 2021</p>
   <!--<a href="#" class="fa fa-facebook"></a>
   <a href="#" class="fa fa-twitter"></a>
   <a href="#" class="fa fa-instagram"></a>
   <a href="#" class="fa fa-snapchat-ghost"></a>-->
  </footer>
</html>
