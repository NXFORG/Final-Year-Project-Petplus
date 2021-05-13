<?php
  //Database connection file
  include_once 'dbconnect.php';
  //Login session
  include('loggedin.php');
?>
<!DOCTYPE html>
<html lang="en-gb">
 <head>
  <meta charset = "UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PETPLUS PET MANAGER</title>
  <!--Bootstrap stylesheet-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--Custom stylesheet-->
  <link rel="stylesheet" type="text/css" href="vetview.css">
  <!--jQuery library link-->
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
       <!--A pet owner can only access this page-->
       <a class="nav-link hvr-fade" href="ownerviewpet.php">VIEW PET<span class="sr-only ">(current)</span></a>
      </li>
     </ul>
     <!--Logout link-->
     <a href = "logout.php">Logout</a>
    </div>
   </nav>
  <div class="card-img-overlay">
    <div id="form-container">
    <div class="container">
    <div class="row">
      <!--The owner enters the pet's name and postcode to retrieve information about the pet-->
      <div class="main-card-title">Pet Details</div>
       <form class="formentry" action="" method="post">
        <fieldset>
          <label class="form-label">Pet's Name</label>
          <input type="text" id="petname" name="petname">
          <br>
          <br>
          <label class="form-label">Pet's Location (Postcode)</label>
          <input type="text" id="petloc" name="petloc">
          <input type="submit" name="choosepet" class="btn btn-success">
       </fieldset>
     </form>
      <?php
       if(isset($_POST['choosepet'])){
        $petname = $_POST['petname'];
        $petloc = $_POST['petloc'];
        //Query to retrieve all important pet information
        $result = mysqli_query($conn,"SELECT Pet_ID, Pet_Name, Pet_DOB, Species_Name, Species_Breed, Pet.Pet_Next_Treatment_Date,
          Diagnosis_Name, Diagnosis_Date,Diet_Name, Diet_Start, Diet_End, Diet_Notes, Exercise_Name, Exercise_Type, Exercise_Start,
          Exercise_End, Exercise_Notes, Walk_Notes, Treatment_Name,
          Treatment_Type, Treatment_Date, Treatment_Notes, Vet_FName, Vet_LName, Vet_Title, Vet_Phone,
          Vet_Email, Practice_Name, Practice_Phone, Practice_Email, Practice_Number, Practice_Postcode
          FROM Pet
          JOIN Owner ON Owner.Owner_ID = Pet.Pet_Owner_ID
          JOIN Owner_Location ON Owner_Location.Owner_Location_ID = Owner.Owner_Location_ID
          JOIN Species ON Species.Species_ID = Pet.Pet_Species_ID
          JOIN Diagnosis ON Diagnosis.Diagnosis_ID = Pet.Pet_Diagnosis_ID
          JOIN Diet ON Diet.Diet_ID = Pet.Pet_Diet_ID
          JOIN Exercise ON Exercise.Exercise_ID = Pet.Pet_Exercise_ID
          JOIN Walk ON Walk.Walk_ID = Species.Species_ID
          JOIN Treatment ON Treatment.Treatment_ID = Pet.Pet_Treatment_ID
          JOIN Vet ON Vet.Vet_ID = Pet.Pet_Vet_ID
          JOIN Practice ON Practice.Practice_ID = Vet.Vet_Practice_ID
          JOIN Practice_Location ON Practice_Location.Practice_Location_ID
          = Practice.Practice_Location_ID
          WHERE Owner.Owner_Email = '$check' AND Pet.Pet_Name = '$petname' AND Owner_Location.Street_Postcode = '$petloc'");
          //Owner's name is retrieved from their login information and compared against the value the pet's database entry
          while($row = mysqli_fetch_array($result)){
            //Pet information is output in a HTML table
            echo "<div id=\"treatmentresults\">";
            echo "<h1>Pet Profile</h1>";
            echo "<br>";
            echo "<div id='resultsHeader'>";
            echo "<img id='resultsimg' src='images/catroof.jpeg' alt=''>";
            echo "<h4>Name:" . " " . $row['Pet_Name'] . " (" . $row['Pet_ID'] . ")</h4></div><br>";
              echo "<table>";
              echo "<tr><td><h5>Basic Information</h5></td></tr>";
              echo "<tr><td><b>Pet Date of Birth:</b>" . " " . $row['Pet_DOB'] . "</td><td><b>Breed:</b>" . " " . $row['Species_Breed'] . "</td><td><b>Species:</b>" . " " . $row['Species_Name'] . "</td></tr>";
              echo "<tr><td><br></td></tr>";
              echo "<tr><td><h5>Treatment Information</h5></td></tr>";
              echo "<tr><td><b>Diagnosis:</b> " . " " . $row['Diagnosis_Name'] . "</td><td><b>Date of Diagnosis:</b> " . " " . $row['Diagnosis_Date'] . "</td></tr>";
              echo "<tr><td><b>Treatment Name:</b> " . " " . $row['Treatment_Name'] . "</td><td><b>Treatment Type:</b> " . " " . $row['Treatment_Type'] . "</td><td><b>Treatment Date:</b> " . " " . $row['Treatment_Date'] . "</td></tr>";
              echo "<tr><td><b>Treatment Notes:</b> " . " " . $row['Treatment_Notes'] . "</td><td><b>Next Treatment Date:</b> " . " " . $row['Pet_Next_Treatment_Date'] . "</td></tr>";
              echo "<tr><td><br></td></tr>";
              echo "<tr><td><h5>Veterinarian Information</h5></td></tr>";
              echo "<tr><td><b>Vet's First Name:</b> " . " " . $row['Vet_FName'] . "</td><td><b>Vet's Last Name:</b>" . " " . $row['Vet_LName'] . "</td><td><b>Vet's Accreditations:</b> " . " " . $row['Vet_Title'] . "</td></tr>";
              echo "<tr><td><b>Vet's Phone Number:</b> " . " " . $row['Vet_Phone'] . "</td><td><b>Vet's Email Address:</b> " . " " . $row['Vet_Email'] . "</td></tr>";
              echo "<tr><td><br></td></tr>";
              echo "<tr><td><h5>Practice Information</h5></td></tr>";
              echo "<tr><td><b>Practice Name:</b> " . " " . $row['Practice_Name'] . "</td><td><b>Practice Phone Number:</b> " . " " . $row['Practice_Phone'] ."</td><td><b>Practice Email Address:</b> " . " " . $row['Practice_Email'] . "</td></tr>";
              echo "<tr><td><b>Practice Street Number:</b> " . " " . $row['Practice_Number'] . "</td><td><b>Practice Postcode:</b> " . " " . $row['Practice_Postcode'] . "</td></tr>";
              echo "<tr><td><br></td></tr>";
              echo "<tr><td><h5>Diet Information</h5></td></tr>";
              echo "<tr><td><b>Diet Name:</b> " . " " . $row['Diet_Name'] . "</td><td><b>Diet Start Date:</b> " . " " . $row['Diet_Start'] . "</td><td><b>Diet End Date:</b> " . " " . $row['Diet_End'] . "</td></tr>";
              echo "<tr><td><b>Diet Notes:</b> " . " " . $row['Diet_Notes'] . "</td></tr>";
              echo "<tr><td><br></td></tr>";
              echo "<tr><td><h5>Exercise Information</h5></td></tr>";
              echo "<tr><td><b>Exercise Name:</b> " . " " . $row['Exercise_Name'] . "</td><td><b>Exercise Start Date:</b> " . " " . $row['Exercise_Start'] . "</td><td><b>Exercise End Date:</b> " . " " . $row['Exercise_End'] . "</td></tr>";
              echo "<tr><td><b>Exercise Notes:</b> " . " " . $row['Exercise_Notes'] . "</td><td><b>Walking Notes:</b> " . " " . $row['Walk_Notes'] . "</td></tr>";
              echo "</table>";
              echo "</div>";
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
   <p>UP854443 2021</p>
  </footer>
</html>
