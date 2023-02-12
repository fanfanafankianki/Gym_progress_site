<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Gym progress site</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style_second.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="style.css">
<style>
.css-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.css-wide {font-family: "Montserrat", sans-serif;}
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php
function connectToDb() {
  $servername = "127.0.0.1";
  $username = "bartek";
  $password = "gymsitedb321";
  $dbname = "gymsitedatabase_final3";

  // Tworzenie połączenia
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Sprawdzanie połączenia
  if (!$conn) {
    die("Połączenie nieudane: " . mysqli_connect_error());
  }
  return $conn;
}
?>

<?php
function addUser($profile_name_to_add, $user_id) {
  $conn = connectToDb();

  // Zapytanie SQL
  $sql = "INSERT INTO userProfiles(profile_name, user_id) VALUES ('$profile_name_to_add', '$user_id')";

  if (mysqli_query($conn, $sql)) {
    $counter = 0;
    for($i = 0; $i < $_SESSION['profiles']; $i++){ 
        $counter++;
    }
    $profile_id = mysqli_insert_id($conn);
    $_SESSION["profile_id_" . $counter] = $profile_id;
    $_SESSION['profiles']++;
    $counter++;
    echo "<p>Liczba profili: ".$counter."</p>";
    echo "<p>Ostatnio dodane profile_id: ".$profile_id."</p>";
  } else {
    echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
  }

  // Zamykanie połączenia
  mysqli_close($conn);
  echo "<script>reloadSite()</script>";
}

if (isset($_POST['submit1'])) {
  $profile_name = $_POST['text'];
  echo $_SESSION['user_id'];
  addUser($profile_name, $_SESSION['user_id']);

}
?>
<body class="css-content css-color4" style="max-width:1200px">


<?php
  function select_user_training_info($profile_id) {
    $conn = connectToDb();
    $query = "SELECT UserProfiles.profile_id, UserProfiles.profile_name, Trainings.training_id, Trainings.training_name
    FROM UserProfiles
    JOIN Trainings ON UserProfiles.profile_id = Trainings.profile_id
    WHERE UserProfiles.profile_id = $profile_id";

    $query2="SELECT UserProfiles.profile_id, UserProfiles.profile_name FROM UserProfiles WHERE UserProfiles.profile_id = $profile_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows(mysqli_query($conn, $query)) == 0) {
      $result = mysqli_query($conn, $query2);
      $record = mysqli_fetch_assoc($result);
      $profile_id = $record["profile_id"];
      $profile_name = $record["profile_name"];
      echo "<script>document.addEventListener('DOMContentLoaded', function() {createUserElement('$profile_id', '$profile_name');});</script>";
    } else {
      $training_names = array();
      while($record = mysqli_fetch_assoc($result)) {
        $profile_id = $record["profile_id"];
        $profile_name = $record["profile_name"];
        $training_ids[] = $record["training_id"];
        $training_names[] = $record["training_name"];
      }
      echo "<script>document.addEventListener('DOMContentLoaded', function() {createUserElement('$profile_id', '$profile_name', " . json_encode($training_names) . ", " . json_encode($training_ids) . ");});</script>";
    }
    $conn->close();
  } 
?>

<?php
function select_training_with_exercise($training_with_exercises_id) {

  $conn = connectToDb();
  $query = "SELECT TrainingWithExercises.*, Trainings.training_name, UserProfiles.profile_id, Exercises1.exercise_name AS exercise_name1, Exercises2.exercise_name AS exercise_name2, Exercises3.exercise_name AS exercise_name3, Exercises4.exercise_name AS exercise_name4, Exercises5.exercise_name AS exercise_name5, Exercises6.exercise_name AS exercise_name6, Exercises7.exercise_name AS exercise_name7, Exercises8.exercise_name AS exercise_name8, Exercises9.exercise_name AS exercise_name9
  FROM TrainingWithExercises
  JOIN Trainings ON TrainingWithExercises.training_id = Trainings.training_id
  JOIN Exercises AS Exercises1 ON TrainingWithExercises.exercise_1 = Exercises1.exercise_id
  JOIN Exercises AS Exercises2 ON TrainingWithExercises.exercise_2 = Exercises2.exercise_id
  JOIN Exercises AS Exercises3 ON TrainingWithExercises.exercise_3 = Exercises3.exercise_id
  LEFT JOIN Exercises AS Exercises4 ON TrainingWithExercises.exercise_4 = Exercises4.exercise_id
  LEFT JOIN Exercises AS Exercises5 ON TrainingWithExercises.exercise_5 = Exercises5.exercise_id
  LEFT JOIN Exercises AS Exercises6 ON TrainingWithExercises.exercise_6 = Exercises6.exercise_id
  LEFT JOIN Exercises AS Exercises7 ON TrainingWithExercises.exercise_7 = Exercises7.exercise_id
  LEFT JOIN Exercises AS Exercises8 ON TrainingWithExercises.exercise_8 = Exercises8.exercise_id
  LEFT JOIN Exercises AS Exercises9 ON TrainingWithExercises.exercise_9 = Exercises9.exercise_id
  JOIN UserProfiles ON Trainings.profile_id = UserProfiles.profile_id
  WHERE training_with_exercises_id = $training_with_exercises_id;
  ";

  $result = mysqli_query($conn, $query);
  $record = mysqli_fetch_assoc($result);
  $training_with_exercises_id = $record["training_with_exercises_id"];
  $training_id = $record["training_id"];
  $exercise_1 = $record["exercise_1"];
  $exercise_2 = $record["exercise_2"];
  $exercise_3 = $record["exercise_3"];
  $training_name = $record["training_name"];
  $exercise_name1 = $record["exercise_name1"];
  $exercise_name2 = $record["exercise_name2"];
  $exercise_name3 = $record["exercise_name3"];
  $profile_id = $record["profile_id"];
  echo "training_name: " . $training_name . "<br>";
  echo "Training With Exercises ID: " . $training_with_exercises_id . "<br>";
  echo "Training training_id: " . $training_id . "<br>";
  echo "profile_id profile_id: " . $profile_id . "<br>";
  echo "exercise_1 1: " . $exercise_1 . " Repetitions 1: " . $exercise_name1 . "<br>";
  echo "exercise_1 2: " . $exercise_2 . " Repetitions 2: " . $exercise_name2 . "<br>";
  echo "exercise_1 3: " . $exercise_3 . " Repetitions 3: " . $exercise_name3 . "<br>";
  
  echo "</table>";

  $conn->close();
}

?>
<!-- Sidebar/menu -->
<nav class="sidebar css-bar-block css-color4 css-collapse css-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="css-container css-display-container css-padding-16">
    <i onclick="sidebar()" class="fa fa-remove css-hide-large css-button css-display-topright"></i>
    <h3 onclick="reloadSite()" class="css-wide css-button"><b>Gym Site</b>
    </h3>
  </div>
  <div id='target' class="css-padding-64 css-large css-text-grey" style="font-weight:bold">
    <a onclick="loadBMICalculator()" href="javascript:void(0)" class="css-button css-block2 css-left-align" id="object_one">
        BMI Calculator
    </a>
    <a onclick="loadCaloriesCalculator()" href="javascript:void(0)" class="css-button css-block2 css-left-align" id="object_one">
        Calories Calculator
    </a>
    <a onclick="loadFFMICalculator()" href="javascript:void(0)" class="css-button css-block2 css-left-align" id="object_one">
        FFMI Calculator
    </a>
</nav>

<!-- Top menu on small screens -->
<header class="css-bar css-top css-hide-large css-black css-xlarge">
  <div class="css-bar-item css-padding-24 css-wide css-black">Gym Site</div>
  <a href="javascript:void(0)" class="css-bar-item css-button css-padding-24 css-right" onclick="sidebar_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="css-overlay css-hide-large" onclick=sidebar()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="css-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="css-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
  <header class="css-container css-xlarge css-color1">


   

    <p class="css-right">
    <div style="display: flex; justify-content: space-between; line-height: 25px; padding: 5px; align-items: center;">


      <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
      <?php } ?>
      <?php if (empty($_SESSION['profile_id'])) : ?>
      <div style="float: left; text-align: left;  align-items: center;">
      Log in and track your progress!
      </div>
      <div style="float: right; text-align: right; align-items: center; line-height: 25px;">
      <form action="http://localhost/Gym_Site/login.php" method="post" class="css-right">
        <label for="text" style="width: 100px; height: 20px; font-size: 15px; padding: 5px;">Nazwa użytkownika:</label>
        <input type="text" name="login" style="width: 100px; height: 20px; font-size: 15px; padding: 5px;"/> 
        <br/> 
        <label for="password" style="width: 100px; height: 20px; font-size: 15px; padding: 5px;">Hasło:</label>
        <input type="password" name="password" style="width: 100px; height: 20px; font-size: 15px; padding: 5px;"/>
        <br/>
        <button type="submit" style="width: 100px; height: 35px; font-size: 15px; padding: 5px;">Zaloguj się</button>
      </form>

      <script>document.addEventListener('DOMContentLoaded', function() {createRegisterElement();});</script>
      </div>
      <?php else : ?>
        <div style="float: right; text-align: right; align-items: center; line-height: 25px;">
        <p>Hi, <?=$_SESSION['profile_id']?> <a href="http://localhost/Gym_Site/logout.php">logout</a> </p>
        <?php 
        $counter = 0;
        echo "<script>document.addEventListener('DOMContentLoaded', function() {createAddUserElement();});</script>";
        for($i = 0; $i < $_SESSION['profiles']; $i++){ 
            $counter++;
        ?>
      <?php if (isset($_SESSION['profile_id_0']))
      echo select_user_training_info($_SESSION['profile_id_'.$i]);
      }
      
      ?>
          </p>
            
        <?php endif; ?>
      </p>
      </div>
  </header>



  <p></p>


  <!-- Product grid -->
  <div class="parent">
    <div id="empty_place_for_divs" class="css-color3" style="text-align: center; align-items: center;">
      <div id="welcome_site" style="font-weight: bold; font-size: 17px; letter-spacing:3px;">
        <br>
        <br>
        Welcome to Gym Site! 
        <br>
        <br>
        Here you can configure your training routine, track your trainings and your progress! 
        <br>
        <br>
        Add your everyday trainings and your exercise routine.
        <br>
        <br>
        You can also use BMI, FFMI and Calorie calculator!
        <br>
        <br>
        Register now and start tracking your progress.
        <br>
        <br>
        <br>
          <div id="welcome_site2" style="font-weight: bold; font-size: 17px; letter-spacing:3px; line-height: 35px;">
          </div>
        </div>
    </div>
  </div> 


  <div id="klasa6" class="klasa6">
    <div id="recordContainer">

        <a onclick="getRecord()" href="#" class="css-bar-item css-button">Click</a>
    </div>
  </div>  
  <div id="klasa7" class="klasa7">
    <div id="tendiv" class="div1">

    </div>
  </div> 
  <div id="klasa_on2" class="klasa_on2">
    <form method="post">
      <br><br>Dodaj nowy profil/osobę: <br><br>
      <input type="text" name="text" class="css-input css-border" placeholder="Nazwa profilu"><br>
      <input type="submit" name="submit1" class="css-button css-block css-black" value="Dodaj profil">
    </form>
  </div>
  <p></p>
  <!-- Footer -->
  <footer class="css-padding-16 css-color2 css-small css-center" id="footer">
    <div class="css-row-padding" style="align-items: center; margin: 0 auto; display: flex;">
      <div class="css-col s4">
        <h4>Kontakt</h4>
        <p>Masz pytanie? Zadaj je tutaj!</p>
        <form action="/action_page.php" target="_blank">
          <p><input class="css-input css-border" type="text" placeholder="Imię" name="Name" required></p>
          <p><input class="css-input css-border" type="text" placeholder="Email" name="Email" required></p>
          <p><input class="css-input css-border" type="text" placeholder="Temat" name="Subject" required></p>
          <p><input class="css-input css-border" type="text" placeholder="Wiadomość" name="Message" required></p>
          <button onclick="reloadSite()" type="submit" class="css-button css-block css-black">Wyślij</button>
        </form>
      </div>
    </div>
  </footer>

  <div class="css-black css-center css-padding-24">Powered by <a href="https://github.com/fanfanafankianki" title="fanfanafankianki" target="_blank" class="css-hover-opacity">fanfanafankianki</a</div>

  <!-- End page content -->
</div>

<script>
  function loadBMICalculator() {
    var BMICalculator = `<br><br> Kalkulator BMI <br><br>
    <input type="text" id="weight" placeholder="Waga"><br><br>
    <input type="text" id="height" placeholder="Wzrost"><br><br>
    <button onclick="calculateBMI()">Oblicz BMI</button><br><br>
    <div id="result"></div>`;
    let target = document.getElementById("empty_place_for_divs");
    document.getElementById('empty_place_for_divs').innerHTML = BMICalculator;
  }

  function calculateBMI() {
  // Pobieranie wartości wagi i wzrostu z pól input
  var weight = document.getElementById("weight").value;
  var height = document.getElementById("height").value;

  // Konwersja pól input na liczby
  weight = parseFloat(weight);
  height = parseFloat(height);

  // Sprawdzanie, czy wprowadzono prawidłowe dane
  if (isNaN(weight) || isNaN(height) || height <= 0) {
    document.getElementById("result").innerHTML = "Wprowadzono nieprawidłowe dane.";
    return;
  }

  // Obliczenie BMI
  var bmi = (weight / (height * height))*10000;

  // Wyświetlenie wyniku
  document.getElementById("result").innerHTML = "Twoje BMI wynosi: " + bmi.toFixed(2);
  }

  function loadCaloriesCalculator() {
    var CaloriesCalculator = `<br><br> Kalkulator zapotrzebowania kalorycznego <br><br>
    <input type="text" id="weight" placeholder="Waga"><br><br>
    <input type="text" id="height" placeholder="Wzrost"><br><br>
    <input type="text" id="age" placeholder="Wiek"><br><br>
    <select id="gender">
        <option value="male">Mężczyzna</option>
        <option value="female">Kobieta</option>
    </select><br><br>
    <select id="activity">
        <option value="1.20">Prawie brak</option>
        <option value="1.40">Lekka aktywność</option>
        <option value="1.60">Umiarkowana aktywność</option>
        <option value="1.80">Duża aktywność</option>
        <option value="2.00">Bardzo duża aktywność</option>
    </select><br><br>
    <button onclick="calculateCaloricRequirement()">Oblicz zapotrzebowanie kaloryczne</button><br><br>
    <div id="result"></div><br>`;
    let target = document.getElementById("empty_place_for_divs");
    document.getElementById('empty_place_for_divs').innerHTML = CaloriesCalculator;
  }

  function calculateCaloricRequirement() {
    // Pobieranie wartości wagi, wzrostu i wieku z pól input
    var weight = document.getElementById("weight").value;
    var height = document.getElementById("height").value;
    var age = document.getElementById("age").value;
    var gender = document.getElementById("gender").value;
    var activity = document.getElementById("activity").value;
    
    // Konwersja pól input na liczby
    weight = parseFloat(weight);
    height = parseFloat(height);
    age = parseFloat(age);

    // Sprawdzanie, czy wprowadzono prawidłowe dane
    if (isNaN(weight) || isNaN(height) || isNaN(age) || height <= 0) {
      document.getElementById("result").innerHTML = "Wprowadzono nieprawidłowe dane.";
      return;
    }

    // Obliczenie zapotrzebowania kalorycznego
    var PPM;
    var BMR;
    var BMR_Masa;
    var BMR_Redukcja;
    if (gender === "male") {
      PPM = 66  + (13.7 * weight) + (5 * height) - (6.8 * age);
      BMR = (66  + (13.7 * weight) + (5 * height) - (6.8 * age)) * activity;
      BMR_Masa = ((66  + (13.7 * weight) + (5 * height) - (6.8 * age)) * activity) + 150;
      BMR_Redukcja = ((66  + (13.7 * weight) + (5 * height) - (6.8 * age)) * activity) - 150;
    } else {
      PPM = 655  + (9.6 * weight) + (1.8 * height) - (4.7 * age);
      BMR = (655  + (9.6 * weight) + (1.8 * height) - (4.7 * age)) * activity;
      BMR_Masa = ((655  + (9.6 * weight) + (1.8 * height) - (4.7 * age)) * activity) + 150;
      BMR_Redukcja = ((655  + (9.6 * weight) + (1.8 * height) - (4.7 * age)) * activity) - 150;
    }

    // Wyświetlenie wyniku
    document.getElementById("result").innerHTML = "Twoje Podstawowa Przemiana Materii wynosi około: " + PPM.toFixed(2) + " kalorii. <br><br>";
    document.getElementById("result").innerHTML += "Twoje dzienne zapotrzebowanie kaloryczne wynosi około: " + BMR.toFixed(2) + " kalorii. <br><br>";
    document.getElementById("result").innerHTML += "Twoje dzienne zapotrzebowanie kaloryczne na masie wynosi około: " + BMR_Masa.toFixed(2) + " kalorii. <br><br>";
    document.getElementById("result").innerHTML += "Twoje dzienne zapotrzebowanie kaloryczne na redukcji wynosi około: " + BMR_Redukcja.toFixed(2) + " kalorii. <br><br>";
  
  }

  function loadFFMICalculator() {
    var FFMICalculator = `<br><br> Kalkulator FFMI <br><br>
    <input type="text" id="weight" placeholder="Waga"><br><br>
    <input type="text" id="height" placeholder="Wzrost"><br><br>
    <input type="text" id="fat" placeholder="Poziom tkanki tłuszczowej"><br><br>
    <button onclick="calculateFFMI()">Oblicz FFMI</button><br><br>
    <div id="result"></div>`;
    let target = document.getElementById("empty_place_for_divs");
    document.getElementById('empty_place_for_divs').innerHTML = FFMICalculator;
  }

  function calculateFFMI() {
    // Pobieranie wartości wagi, wzrostu i poziomu tkanki tłuszczowej z pól input
    var weight = document.getElementById("weight").value;
    var height = document.getElementById("height").value;
    var fat = document.getElementById("fat").value;

    // Konwersja pól input na liczby
    weight = parseFloat(weight);
    height = parseFloat(height);
    fat = parseFloat(fat);

    // Sprawdzanie, czy wprowadzono prawidłowe dane
    if (isNaN(weight) || isNaN(height) || isNaN(fat) || height <= 0 || fat < 0 || fat > 100) {
      document.getElementById("result").innerHTML = "Wprowadzono nieprawidłowe dane.";
      return;
    }

    // Obliczenie masy beztłuszczowej
    var leanMass = weight * (1 - (fat / 100));

    // Obliczenie FFMI
    var ffmi = (leanMass /((height/100) * (height/100)));

    var normalized_ffmi = ffmi + 6.1*(1.8-(height/100));

    // Wyświetlenie wyniku
    document.getElementById("result").innerHTML = "Twoje FFMI wynosi: " + ffmi.toFixed(2) + "<br> Twoje Normalized FFMI wynosi: " + normalized_ffmi.toFixed(2);
  }

  // Accordion 
  function myAccFunc(arg) {
    var x = document.getElementById(arg);
    if (x.className.indexOf("css-show") == -1) {
      x.className += " css-show";
    } else {
      x.className = x.className.replace(" css-show", "");
    }
  }

  function createUserElement(profile_id, profile_name, trainingList = [], trainingIds = []) {
    let a = document.createElement("a");
    a.innerHTML = profile_name;
    a.setAttribute("href", "javascript:void(0)");
    a.setAttribute("onclick", `myAccFunc('${profile_name}_items')`);
    a.setAttribute("class", "css-button css-block css-left-align css-show");
    a.setAttribute("id", profile_name);
    let target = document.getElementById("target");
    target.insertBefore(a, target.firstChild);



    createChildElements(a, profile_id, profile_name); 
    if (trainingList.length === trainingIds.length && trainingList.length > 0) {
      for (let i = 0; i < trainingList.length; i++) {
        createTrainingElement(trainingList[i], trainingIds[i], profile_name);
      }
    }

  }

  function createAddUserElement() {
    let a2 = document.createElement("a");
    a2.innerHTML = "Dodaj nowy profil";
    a2.setAttribute("onclick", "loadDiv('klasa_on2')");
    a2.setAttribute("href", "#");
    a2.setAttribute("class", "css-button css-block2 css-left-align");

    let target = document.getElementById("target");
    target.insertBefore(a2, target.firstChild);
  }


  function createChildElements(parent, profile_id, profile_name) {
    let div = document.createElement("div");
    div.setAttribute("id", profile_name+"_items");
    div.setAttribute("class", "css-bar-block css-hide css-padding-large css-medium css-show");

    let a1 = document.createElement("a");
    a1.innerHTML = "Dodaj trening";
    a1.setAttribute("onclick", "loadAddTrainingDiv("+profile_id+")");
    a1.setAttribute("href", "#");
    a1.setAttribute("class", "css-bar-item css-button");
    div.appendChild(a1);

    let a2 = document.createElement("a");
    a2.innerHTML = "Historia treningów";
    a2.setAttribute("onclick", "loadTrainingHistoryDiv("+profile_id+")");
    a2.setAttribute("href", "#");
    a2.setAttribute("class", "css-bar-item css-button");
    div.appendChild(a2);

    let a3 = document.createElement("a");
    a3.innerHTML = "Wykresy";
    a3.setAttribute("onclick", "loadChartDiv("+profile_id+")");
    a3.setAttribute("href", "#");
    a3.setAttribute("class", "css-bar-item css-button");
    div.appendChild(a3);



    parent.parentNode.insertBefore(div, parent.nextSibling);
  }

  function createTrainingElement(training, training_id, profile_name) {
    let a1 = document.createElement("a");
    a1.innerHTML = training;
    a1.setAttribute("onclick", "loadTrainingDiv("+training_id+")");
    a1.setAttribute("href", "#");
    a1.setAttribute("class", "css-bar-item css-button css-show");
    let target = document.getElementById(profile_name+"_items");
    target.insertBefore(a1, target.firstChild);
  }

  function loadDiv(klasa) {
    document.getElementById('empty_place_for_divs').innerHTML = document.getElementById(klasa).innerHTML;
    document.querySelectorAll(klasa).style.display = "block";
  }

  function createRegisterElement() {
    var registerForm = `
      <form action="http://localhost/Gym_Site/registration.php" method="post">
        Register now! <br>
        <input type="text" id="username" name="username" placeholder="Username">
        <br>
        <input type="email" id="email" name="email" placeholder="Email">
        <br>
        <input type="password" id="password" name="password" placeholder="Password">
        <br>
        <input type="submit" name="submitRegistration" value="Zarejestruj">
      </form><br>
    `;

    document.getElementById("welcome_site2").innerHTML += registerForm;
  }

  function loadTrainingDiv(training_id) {

  var xhr = new XMLHttpRequest();

  xhr.open("POST", "selectTrainingWithExercise.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function() {
    if (this.status == 200) {
      
      var newDiv1 = document.createElement("div");
      newDiv1.id = "klasa4";
      newDiv1.className = "klasa4";

      var newDiv2 = document.createElement("div");
      newDiv2.id = "record2Container";

      var records = JSON.parse(this.responseText);
      var table = document.createElement("table");
      table.setAttribute("border", "1");

      table.style.margin = "0 auto";
      var form = document.createElement("form");
      form.id = "addTrainingForm";
      form.action = "insertTrainingWithDate.php";
      form.method = "post";
      newDiv2.appendChild(form);
      for (var i = 0; i < records.length; i++) {
        var row = table.insertRow();
        table.style.width = "30%";
        var cell0 = row.insertCell(0);
        cell0.innerHTML = records[i]['training_name'] + "<input type='hidden' name='Training_With_Exercises_ID' value='" + records[i]['training_with_exercises_id'] + "'>";
        cell0.style.textAlign = "center";
        cell0.style.fontWeight = "bold";

        
        for (var j = 0; j < records[i]['exercises'].length; j++) {
            var subRow = table.insertRow();
            var subCell0 = subRow.insertCell(0);
            var subCell1 = subRow.insertCell(0);
            var subCell2 = subRow.insertCell(0);

            
            subCell0.innerHTML = "<input type='text' name='Weight_" + j + "' placeholder='Ciężar'>"
            subCell0.style.textAlign = "center";
            subCell1.innerHTML = "<input type='text' name='Reps_" + j + "' placeholder='Ilość powtórzeń'> <input type='hidden' name='Exercise_ID_" + j + "' value='" + records[i]['exercise_id'][j] + "'>"
            subCell1.style.textAlign = "center";
            subCell2.innerHTML = records[i]['exercises'][j];
            subCell2.style.textAlign = "center";
        }
      }  
      var subCell4 = subRow.insertCell(3);
      subCell4.innerHTML = "<input type='submit' name='WstawDate' class='css-button css-black' value='Wyślij'>"
      subCell4.style.textAlign = "center"; 



      form.appendChild(table);
      newDiv1.appendChild(newDiv2);
      addDisplayBlockToChilds(newDiv1);
      document.querySelector("#empty_place_for_divs").innerHTML = newDiv1.outerHTML;
    } else {
      console.error('An error occurred while loading the training div. Response status: ', this.status);
    }
  };

  xhr.send("training_id=" + training_id);

  }


  function getRecord() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_record.php", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Dokonaj renderowania rekordu w element HTML
        document.getElementById("recordContainer").innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  }

  function loadChartDiv(profile_id) {

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "getTrainingsByUserId.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
      if (this.status == 200) {
        var newDiv1 = document.createElement("div");
        newDiv1.id = "klasa7";
        newDiv1.className = "klasa7";
        var newDiv2 = document.createElement("div");
        newDiv2.id = "tendiv";
        newDiv2.innerHTML = this.responseText;
        newDiv1.appendChild(newDiv2);
        addDisplayBlockToChilds(newDiv1);
        document.querySelector("#empty_place_for_divs").innerHTML = newDiv1.outerHTML;
      } else {
        console.error('An error occurred while loading the training div. Response status: ', this.status);
      }
    };
    xhr.send("profile_id=" + profile_id);
  }

  function showTrainingWithExercisesDetails(training_id) {

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "getExercisesByTrainingId.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
      if (this.status == 200) {
        var newDiv1 = document.createElement("div");
        newDiv1.id = "klasa7";
        newDiv1.className = "klasa7";
        var newDiv2 = document.createElement("div");
        newDiv2.id = "tendiv";
        newDiv2.innerHTML = this.responseText;
        newDiv1.appendChild(newDiv2);
        addDisplayBlockToChilds(newDiv1);
        document.querySelector("#empty_place_for_divs").innerHTML = newDiv1.outerHTML;
      } else {
        console.error('An error occurred while loading the training div. Response status: ', this.status);
      }
    };
    xhr.send("training_id=" + training_id);
  }

  function showTrainingHistoryDetails(training_history_id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "getExercisesByHistoryId.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
      if (this.status == 200) {
        var newDiv1 = document.createElement("div");
        newDiv1.id = "klasa7";
        newDiv1.className = "klasa7";
        var newTable = document.createElement("table");
        newTable.id = "training_history_table";
        newTable.className = "training_history_table";
        newTable.setAttribute("border", "1");
        newTable.style.margin = "0 auto";
        newTable.style.width = "30%";
        // Parsuj odpowiedź responsetext i dodaj ją jako wiersze i komórki tabeli
        var responseData = JSON.parse(this.responseText);
        for (var i = 0; i < responseData.length; i++) {
          var newRow = newTable.insertRow();
          var exerciseCell = newRow.insertCell();
          exerciseCell.style.textAlign = "center";
          exerciseCell.style.fontWeight = "bold";
          exerciseCell.innerHTML = responseData[i].exercise_name;
          var weightCell = newRow.insertCell();
          weightCell.style.textAlign = "center";
          weightCell.innerHTML = responseData[i].weight;
          var repsCell = newRow.insertCell();
          repsCell.style.textAlign = "center";
          repsCell.innerHTML = responseData[i].reps;
        }
        
        newDiv1.appendChild(newTable);
        addDisplayBlockToChilds(newDiv1);
        document.querySelector("#empty_place_for_divs").innerHTML = newDiv1.outerHTML;
      } else {
        console.error('An error occurred while loading the training div. Response status: ', this.status);
      }
    };
    xhr.send("training_history_id=" + training_history_id);
  }

  function showExerciseDetailsChart(exercise_id, training_id) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "getExerciseDetails.php?exercise_id=" + exercise_id + "&training_id=" + training_id, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        document.getElementById("tendiv").innerHTML = xhr.responseText + '<div style="display: block;"><canvas id="myChart"></canvas></div>';
        createChart(response.dates, response.weights, response.repetitions);
      }
    };
    xhr.send();
  }

  function createChart(dates, weights, repetitions) {
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: dates,
        datasets: [{
          label: 'Waga',
          data: weights,
          borderWidth: 1
        },
        {
          label: 'Powtórzenia',
          data: repetitions,
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        interaction: {
          mode: 'index',
          intersect: true,
        },
        stacked: false,
        plugins: {
          title: {
            display: true,
            text: 'Wykres dla treningu'
          }
        }
      }
    });
  }




  function loadTrainingHistoryDiv(profile_id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "getTrainingHistoryByUserId.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
      if (this.status == 200) {
        var newDiv1 = document.createElement("div");
        newDiv1.id = "klasa6";
        newDiv1.className = "klasa6";
        var newDiv2 = document.createElement("div");
        newDiv2.id = "recordContainer";
        newDiv2.innerHTML = this.responseText;
        newDiv1.appendChild(newDiv2);
        addDisplayBlockToChilds(newDiv1);
        document.querySelector("#empty_place_for_divs").innerHTML = newDiv1.outerHTML;
      } else {
        console.error('An error occurred while loading the training div. Response status: ', this.status);
      }
    };
    xhr.send("profile_id=" + profile_id);
  }


  function loadAddTrainingDiv(profile_id) {
    var newDiv1 = document.createElement("div");
    newDiv1.id = "klasa5";
    newDiv1.className = "klasa5";

    var newDiv2 = document.createElement("div");
    newDiv2.id = "tendiv";
    newDiv2.className = "div1";
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "selectTrainingWithExercise.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send("profile_id=" + profile_id);
    newDiv2.innerHTML = `

    <form id="addTrainingForm" action="insertTrainingWithExercises.php" method="post">
      <input type="hidden" name="profile_id" value="${profile_id}">
      <input type="text" name="text1" class="css-input css-border" placeholder="Nazwa treningu">
      <input type="text" name="text2" class="css-input css-border" placeholder="Ćwiczenie 1">
      <input type="text" name="text3" class="css-input css-border" placeholder="Ćwiczenie 2">
      <input type="text" name="text4" class="css-input css-border" placeholder="Ćwiczenie 3">
      <input type="text" name="text5" class="css-input css-border" placeholder="Ćwiczenie 4">
      <input type="text" name="text6" class="css-input css-border" placeholder="Ćwiczenie 5">
      <input type="text" name="text7" class="css-input css-border" placeholder="Ćwiczenie 6">
      <input type="text" name="text8" class="css-input css-border" placeholder="Ćwiczenie 7">
      <input type="text" name="text9" class="css-input css-border" placeholder="Ćwiczenie 8">
      <input type="text" name="text10" class="css-input css-border" placeholder="Ćwiczenie 9">
      <input type="submit" name="submit2" class="css-button css-block css-black" value="Dodaj trening">
    </form>`;
    newDiv1.appendChild(newDiv2);

    addDisplayBlockToChilds(newDiv1);

    document.querySelector("#empty_place_for_divs").innerHTML = newDiv1.outerHTML;
  }










  function addDisplayBlockToChilds(div) {
    div.style.display = "block";
    var allDescendants = div.getElementsByTagName("*");
    for (var i = 0; i < allDescendants.length; i++) {
        allDescendants[i].style.display = "block";
    }
  }

  function addClassOnClick(event) {
    const allElements = document.querySelectorAll('*');
    allElements.forEach((element) => {
      element.classList.remove('css-light-grey');
    });

    if (event.target.classList.contains("css-button")) {
      event.target.classList.add("css-light-grey");
    }   
  }

  document.querySelectorAll("div").forEach(function(element) {
    element.addEventListener("click", addClassOnClick);
  });


  function showTrainingDetails(training_id, profile_id) {

  var xhr = new XMLHttpRequest();

  xhr.open("POST", "selectTrainingWithExercise.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function() {
    if (this.status == 200) {
      
      var newDiv1 = document.createElement("div");
      newDiv1.id = "klasa4";
      newDiv1.className = "klasa4";

      var newDiv2 = document.createElement("div");
      newDiv2.id = "record2Container";
      newDiv2.innerHTML = this.responseText;
      newDiv1.appendChild(newDiv2);
      addDisplayBlockToChilds(newDiv1);
      document.querySelector("#tendiv").innerHTML = newDiv1.outerHTML;
    } else {
      console.error('An error occurred while loading the training div. Response status: ', this.status);
    }
  };
  xhr.send("training_id=" + training_id);
  }




  function reloadSite() {
    location.reload();
  }

  // Open and close sidebar
  function sidebar_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
  }
  
  function sidebar_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
  }
</script>

</body>
</html>
