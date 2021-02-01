<?php
    $speciesname = $_POST['speciesname'];//Pet name variable from login page form
    $conn=mysqli_connect("localhost","chris","test212","PetPlus");//database connection

    if (mysqli_connect_errno()){
        echo "Failed to connect to database" . mysqli_connect_error();
      }

    $result = mysqli_query($conn,"SELECT * FROM `Species` Where `Species_Breed` = '$speciesname'");//Query to list all pets with the given name
     echo "<table>";
     while($row = mysqli_fetch_array($result)){
        echo "<tr><td>" . $row['Species_ID'] . "</td><td> " . $row['Species_Breed'] . "</td><td> " . $row['Species_Name'] ."</td></tr>"; //these are the fields that you have stored in your database table employee
      }
     echo "</table>";
     mysqli_close($conn);//close connection
    ?>
