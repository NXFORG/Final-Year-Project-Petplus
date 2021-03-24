<?php
  include_once 'petplus.php';
  //include('loggedin.php');
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset = "UTF 8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PETPLUS PET MANAGER</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
 </head>
 <body>
   <div id="app">
     <v-app id="inspire">
       <div>
        <v-app-bar color="blue-grey darken-3" dense dark>
         <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>
         <v-toolbar-title>PETPLUS</v-toolbar-title>
         <v-spacer></v-spacer>
       </v-app-bar>
       <v-navigation-drawer v-model="drawer" absolute temporary>
         <v-list nav dense>
           <v-list-item-group v-model="group" active-class="blue-grey--text text--accent-4"  v-for="nav in navDrawer":key="nav">
             <v-list-item :href="nav.url">
               <v-list-item-icon>
                 <v-icon>{{nav.ico}}</v-icon>
               </v-list-item-icon>
               <v-list-item-title>{{nav.title}}</v-list-item-title>
             </v-list-item>
         </v-list>
       </v-navigation-drawer>
     </div>
     <v-form ref="form" v-model="valid" lazy-validation>
       <v-text-field v-model="name" :counter="10" :rules="nameRules" label="Pet Name" required></v-text-field>
       <v-date-picker v-model="picker" label="Pet Date of Birth"></v-date-picker>
       <v-autocomplete v-model="select":items="breeds":rules="[v => !!v || 'Pet breed is required']"label="Pet Breed"required></v-autocomplete>
       <v-autocomplete v-model="select":items="petOwners":rules="[v => !!v || 'Owner's name is required']"label="Owner's Name"required>
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
         </v-autocomplete>
      <!--<form id="newpetadd" action="petadd.php" method="post">
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
          <label class="form-label">Pet Breed</label>-->
          <!--<input type="text" id="srch" name="search">-->
          <!--<select id="petspecies" name="petspecies">
            <option value="" disabled selected>Select a Breed</option>
            <option value=1>American Bulldog</option>
            <option value=2>American Pit Bull Terrier</option>
            <option value=3>Beagle</option>
            <option value=4>Bulldog</option>
            <option value=5>Collie</option>
            <option value=6>Dachshund</option>
            <option value=7>Dalmatian</option>
          </select>-->
          <!--<script>
            function bind_select_search(srch, select, arr_name) {
              window[arr_name] = []
              $(select + " option").each(function(){
                window[arr_name][this.value] = this.text
              })
              $(srch).keyup(function(e) {
                text = $(srch).val()
                if (text != '' || e.keyCode == 8) {
                  arr = window[arr_name]
                  $(select + " option").remove()
                  tmp  = ''
                  for (key in arr) {
                    option_text = arr[key].toLowerCase()
                    if (option_text.search(text.toLowerCase()) > -1 ) {
                      tmp += '<option value="'+key+'">'+ arr[key] +'</option>'
                    }
                  }
                  $(select).append(tmp)
                }
              })
              $(srch).keydown(function(e) {
                if (e.keyCode == 8) // Backspace
                $(srch).trigger('keyup')
              })

            }

            $(document).ready(function() {
              bind_select_search('#srch', '#petspecies', 'options')
            })
            }
          </script>-->
          <br>
          <br>
          <label class="form-label">Owner's Name</label>
          <select id="ownername" class="dropdownSelect" name="ownername">
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
          <label class="form-label">Last Treatment Recieved</label>
          <select id="treatname" name="treatname">
            <option value="" disabled selected>Select a Treatment</option>
            <?php
             $sql = "SELECT * FROM Treatment WHERE Treatment_Date < CURDATE()";
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
          <input type="date" id="futuretreat" name="futuretreat">
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
          <!--<input type="text" id="ownerval" name="ownerval">-->
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
             $sql = "SELECT * FROM Treatment WHERE Treatment_Date < CURDATE()";
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
          <input type="date" id="updfuturetreat" name="futuretreat">
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
            futuretreat: $('#updfuturetreat').val(),
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
   <!--</div>
  </div>
</div>
</div>
</div>
</div>-->
<v-footer dark padless>
<v-card class="flex" flat tile>
 <v-card-title class="blue-grey darken-3">
   <strong class="subheading">Follow us on social media</strong>
   <v-spacer></v-spacer>
 <v-tooltip top v-for="icon in icons":key="icon">
  <template v-slot:activator="{ on, attrs }">
    <v-btn  class="mx-4" dark icon :href="icon.url" v-bind="attrs" v-on="on">
      <v-icon size="24px" :to="icon.url">
       {{ icon.ico }}
      </v-icon>
    </v-btn>
  </template>
  <span>{{icon.label}}</span>
 </v-tooltip>
 </v-card-title>
 <v-card-text class="blue-grey darken-4 py-2 white--text text-center">
   {{ new Date().getFullYear() }} — <strong>PETPLUS</strong>
 </v-card-text>
</v-card>
</v-footer>
</v-app>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script>
  new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    data: () => ({
     picker: new Date().toISOString().substr(0, 10),
     drawer: false,
     group: null,
     valid: true,
     navDrawer: [
       {
         ico: 'mdi-home',
         title: 'Home',
         url: 'index.html',
       },
       {
         ico: 'mdi-paw',
         title: 'Veterinarian Login',
         url: 'login.php',
       },
       {
         ico: 'mdi-account',
         title: 'Owner Login',
         url: 'ownerlogin.php',
       },
     ],
     icons: [
     {
       ico: 'mdi-facebook',
       url: 'https://www.facebook.com/christopher.anstead',
       label: 'Facebook',
     },
     {
       ico: 'mdi-twitter',
       url: 'https://twitter.com/NX_FORG',
       label: 'Twitter',
     },
     {
       ico: 'mdi-instagram',
       url: 'https://github.com/NXFORG',
       label: 'Instagram',
     },
     {
       ico: 'mdi-linkedin',
       url: 'https://www.linkedin.com/in/christopher-anstead-7b2072a8/',
       label: 'LinkedIn',
     },
     ],
     name: '',
     nameRules: [
      v => !!v || 'A name is required',
      v => (v && v.length <= 10) || 'Name must be less than 10 characters',
     ],
     email: '',
     emailRules: [
      v => !!v || 'Email is required',
      v => /.+@.+\..+/.test(v) || 'Please use a valid email',
     ],
     select: null,
     breeds: [
       'American Bulldog',
       'American Pit Bull Terrier',
       'Beagle',
       'Bulldog',
       'Collie',
       'Dachshund',
       'Dalmatian',
     ],
     petOwners: [
       'American Bulldog',
       'American Pit Bull Terrier',
       'Beagle',
       'Bulldog',
       'Collie',
       'Dachshund',
       'Dalmatian',
     ],
     checkbox: false,
   })
  })
</script>
 </body>
</html>
