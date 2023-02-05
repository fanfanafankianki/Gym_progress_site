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
</head>
<body class="css-content" style="max-width:1200px">

<?php
if (isset($_POST['submit1'])) {
  $text = $_POST['text'];

  // Połączenie z bazą danych
  $servername = "127.0.0.1";
  $username = "bartek";
  $password = "gymsitedb321";
  $dbname = "gym site database";

  // Tworzenie połączenia
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Sprawdzanie połączenia
  if (!$conn) {
    die("Połączenie nieudane: " . mysqli_connect_error());
  }

  // Zapytanie SQL
  $sql = "INSERT INTO users(user_name)
  VALUES ('$text')";

  if (mysqli_query($conn, $sql)) {
    echo "Rekord został dodany";
  } else {
    echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
  }
  // Zamykanie połączenia
  mysqli_close($conn);
}
?>

<?php
if (isset($_POST['submit2'])) {
  $text1 = $_POST['text1'];
  $text2 = $_POST['text2'];
  $text3 = $_POST['text3'];
  $text4 = $_POST['text4'];

  // Połączenie z bazą danych
  $servername = "127.0.0.1";
  $username = "bartek";
  $password = "gymsitedb321";
  $dbname = "gym site database";

  // Tworzenie połączenia
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Sprawdzanie połączenia
  if (!$conn) {
    die("Połączenie nieudane: " . mysqli_connect_error());
  }

  // Zapytanie SQL

  $sql1 = "INSERT INTO trainings (training_name, user_id)
  VALUES ('$text1', (SELECT user_id FROM Users WHERE user_name = 'Jarek'));";

  if (mysqli_query($conn, $sql1)) {
    echo "Rekord został dodany!!!";
  } else {
    echo "B2łąd podczas dodawania rekordu: " . mysqli_error($conn);
  }

  $sql2 = "INSERT INTO exercises (exercise_name)
  VALUES ('$text2'), ('$text3'), ('$text4');";

  if (mysqli_query($conn, $sql2)) {
    echo "Rekord został dodany2";
  } else {
    echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
  }

  $sql3 = "INSERT INTO TrainingWithExercises (training_id, exercise_1, exercise_2, exercise_3)
  VALUES (10, 
        (SELECT exercise_id FROM Exercises WHERE exercise_name = '$text2'), 
        (SELECT exercise_id FROM Exercises WHERE exercise_name = '$text3'), 
        (SELECT exercise_id FROM Exercises WHERE exercise_name = '$text4')
  );";

  if (mysqli_query($conn, $sql3)) {
    echo "Rekord został dodany3";
  } else {
    echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
  }

  // Zamykanie połączenia
  mysqli_close($conn);
}
?>

<!-- Sidebar/menu -->
<nav class="sidebar css-bar-block css-white css-collapse css-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="css-container css-display-container css-padding-16">
    <i onclick=sidebar()" class="fa fa-remove css-hide-large css-button css-display-topright"></i>
    <h3 onclick="reloadSite()" class="css-wide css-button"><b>Gym Site</b>
    </h3>
  </div>
  <div class="css-padding-64 css-large css-text-grey" style="font-weight:bold">
    <a onclick="myAccFunc('object_one_items')" href="javascript:void(0)" class="css-button css-block2 css-white css-left-align" id="object_one">
      Dominika
    </a>
    <div id="object_one_items" class="css-bar-block css-hide css-padding-large css-medium">
      <a onclick="loadDiv('klasa1')" href="#" class="css-bar-item css-button css-light-grey"></i>Trening 1</a>
      <a onclick="loadDiv('klasa2')" href="#" class="css-bar-item css-button">Trening 2</a>
      <a onclick="loadDiv('klasa3')" href="#" class="css-bar-item css-button">Trening 3</a>
      <a onclick="loadDiv('klasa4')" href="#" class="css-bar-item css-button">Trening 4</a>
      <a onclick="loadDiv('klasa5')" href="#" class="css-bar-item css-button">Dodaj trening</a>
      <a onclick="loadDiv('klasa6')" href="#" class="css-bar-item css-button">Historia treningów</a>
      <a onclick="loadDiv('klasa7')" href="#" class="css-bar-item css-button">Wykresy</a>
    </div>
    <a onclick="myAccFunc('object_two_items')" href="javascript:void(0)" class="css-button css-block2 css-white css-left-align" id="object_two">
      Bartek
    </a>
    <div id="object_two_items" class="css-bar-block css-hide css-padding-large css-medium">
      <a onclick="loadDiv('klasa8')" href="#" class="css-bar-item css-button css-light-grey">Trening 1</a>
      <a onclick="loadDiv('klasa9')" href="#" class="css-bar-item css-button">Trening 2</a>
      <a onclick="loadDiv('klasa10')" href="#" class="css-bar-item css-button">Trening 3</a>
      <a onclick="loadDiv('klasa11')" href="#" class="css-bar-item css-button">Trening 4</a>
      <a onclick="loadDiv('klasa5')" href="#" class="css-bar-item css-button">Dodaj trening</a>
      <a onclick="loadDiv('klasa6')" href="#" class="css-bar-item css-button">Historia treningów</a>
      <a onclick="loadDiv('klasa7')" href="#" class="css-bar-item css-button">Wykresy</a>
    </div>
    <a onclick="loadDiv('klasa12')" href="javascript:void(0)" class="css-button css-block2 css-white css-left-align" id="object_one">
      Dodaj nową osobę
    </a>
</nav>

<!-- Top menu on small screens -->
<header class="css-bar css-top css-hide-large css-black css-xlarge">
  <div class="css-bar-item css-padding-24 css-wide">Gym Site</div>
  <a href="javascript:void(0)" class="css-bar-item css-button css-padding-24 css-right" onclick="sidebar_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="css-overlay css-hide-large" onclick=sidebar()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="css-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="css-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
  <header class="css-container css-xlarge css-sand">
    <p class="css-left">Trening</p>
    <p class="css-right">
      <i class="fa fa-shopping-cart css-margin-right"></i>
      <i class="fa fa-search"></i>
    </p>
  </header>



  <div class="css-container css-text-grey" id="number_of_items">
    <p>6 items</p>
  </div>

  <!-- Product grid -->
  <div class="parent">
    <div id="empty_place_for_divs">
      Welcome to Gym Site! Here you can configure your training routine, track your trainings and your progress! 
    </div>
  </div> 


  <div id="klasa1" class="klasa1">
    <div id="recordContainer">
      <?php
      function select_training_with_exercise($training_with_exercises_id) {

        // Połączenie z bazą danych
        $servername = "127.0.0.1";
        $username = "bartek";
        $password = "gymsitedb321";
        $dbname = "gym site database";

        // Tworzenie połączenia
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $query = "SELECT TrainingWithExercises.*, Trainings.training_name, Exercises1.exercise_name AS exercise_name1, Exercises2.exercise_name AS exercise_name2, Exercises3.exercise_name AS exercise_name3, Exercises4.exercise_name AS exercise_name4, Exercises5.exercise_name AS exercise_name5, Exercises6.exercise_name AS exercise_name6, Exercises7.exercise_name AS exercise_name7, Exercises8.exercise_name AS exercise_name8, Exercises9.exercise_name AS exercise_name9
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
        echo "training_name: " . $training_name . "<br>";
        echo "Training With Exercises ID: " . $training_with_exercises_id . "<br>";
        echo "Training training_id: " . $training_id . "<br>";
        echo "exercise_1 1: " . $exercise_1 . " Repetitions 1: " . $exercise_name1 . "<br>";
        echo "exercise_1 2: " . $exercise_2 . " Repetitions 2: " . $exercise_name2 . "<br>";
        echo "exercise_1 3: " . $exercise_3 . " Repetitions 3: " . $exercise_name3 . "<br>";
        
        echo "</table>";

        $conn->close();
      }
      select_training_with_exercise(6);
      ?>
    </div>
  </div>
  <div id="klasa2" class="klasa2">
    <div id="recordContainer">
      <?php
        select_training_with_exercise(7);
      ?>
    </div>
  </div>
  <div id="klasa3" class="klasa3">
    <div id="recordContainer">
      <?php
        select_training_with_exercise(10);
      ?>
    </div>
  </div>
  <div id="klasa4" class="klasa4">
    <div class="div1">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 41" name="Name" required></p>  
    </div>
    <div class="div2"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 42" name="Name" required></p>
    </div>
    <div class="div3">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 43" name="Name" required></p>
    </div>
    <div class="div4"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 44" name="Name" required></p>
    </div>
    <div class="div5"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 45" name="Name" required></p>
    </div>
    <div class="div6"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 46" name="Name" required></p>
    </div>
  </div>
  <div id="klasa5" class="klasa5">
    <div class="div1">
      <form method="post">
        <input type="text" name="text1" class="css-input css-border" placeholder="Nazwa treningu">
        <input type="text" name="text2" class="css-input css-border" placeholder="Ćwiczenie 1">
        <input type="text" name="text3" class="css-input css-border" placeholder="Ćwiczenie 2">
        <input type="text" name="text4" class="css-input css-border" placeholder="Ćwiczenie 3">
        <input type="submit" name="submit2" class="css-button css-block css-black" value="Dodaj trening">
      </form>
    </div>
  </div>  
  <div id="klasa6" class="klasa6>
    <div id="recordContainer">
        <?php
          // Połączenie z bazą danych
          $servername = "127.0.0.1";
          $username = "bartek";
          $password = "gymsitedb321";
          $dbname = "gym site database";

          // Tworzenie połączenia
          $conn = mysqli_connect($servername, $username, $password, $dbname);
          $query = "SELECT * FROM TrainingHistory WHERE training_with_exercises_id = 6";
          $result = mysqli_query($conn, $query);
          $record = mysqli_fetch_assoc($result);
          $training_history_id = $record["training_history_id"];
          $training_with_exercises_id = $record["training_with_exercises_id"];
          $training_date = $record["training_date"];
          $weight_1 = $record["weight_1"];
          $reps_1 = $record["reps_1"];
          $weight_2 = $record["weight_2"];
          $reps_2 = $record["reps_2"];
          $weight_3 = $record["weight_3"];
          $reps_3 = $record["reps_3"];
          echo "Training History ID: " . $training_history_id . "<br>";
          echo "Training With Exercises ID: " . $training_with_exercises_id . "<br>";
          echo "Training Date: " . $training_date . "<br>";
          echo "Weight 1: " . $weight_1 . " Repetitions 1: " . $reps_1 . "<br>";
          echo "Weight 2: " . $weight_2 . " Repetitions 2: " . $reps_2 . "<br>";
          echo "Weight 3: " . $weight_3 . " Repetitions 3: " . $reps_3 . "<br>";
        ?>
        <a onclick="getRecord()" href="#" class="css-bar-item css-button">Click</a>
    </div>
  </div>  
  <div id="klasa7" class="klasa7">
    <div class="div1">
      <form method="post">
        <input type="text" name="text1" class="css-input css-border" placeholder="Nazwa treningu">
      </form>
    </div>
  </div> 
  <div id="klasa8" class="klasa8">
    <div class="div1">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 51" name="Name" required></p>  
      </div>
      <div class="div2"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 52" name="Name" required></p>
      </div>
      <div class="div3">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 53" name="Name" required></p>
      </div>
      <div class="div4"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 54" name="Name" required></p>
      </div>
      <div class="div5"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 55" name="Name" required></p>
      </div>
      <div class="div6"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 56" name="Name" required></p>
      </div>
  </div>
  <div id="klasa9" class="klasa9">
      <div class="div1">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 61" name="Name" required></p>  
      </div>
      <div class="div2"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 62" name="Name" required></p>
      </div>
      <div class="div3">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 63" name="Name" required></p>
      </div>
      <div class="div4"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 64" name="Name" required></p>
      </div>
      <div class="div5"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 65" name="Name" required></p>
      </div>
      <div class="div6"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 66" name="Name" required></p>
      </div>
  </div>
  <div id="klasa10" class="klasa10">
    <div class="div1">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 71" name="Name" required></p>  
    </div>
    <div class="div2"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 72" name="Name" required></p>
    </div>
    <div class="div3">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 73" name="Name" required></p>
    </div>
    <div class="div4"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 74" name="Name" required></p>
    </div>
    <div class="div5"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 75" name="Name" required></p>
    </div>
    <div class="div6"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 76" name="Name" required></p>
    </div>
  </div>
  <div id="klasa_on" class="klasa_on">
    <div class="div1">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 81" name="Name" required></p>  
    </div>
    <div class="div2"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 82" name="Name" required></p>
    </div>
    <div class="div3">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 83" name="Name" required></p>
    </div>
    <div class="div4"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 84" name="Name" required></p>
    </div>
    <div class="div5"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 85" name="Name" required></p>
    </div>
    <div class="div6"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 86" name="Name" required></p>
    </div>
  </div>
  <div id="klasa_on2" class="klasa_on2">
    <form method="post">
      <input type="text" name="text" class="css-input css-border" placeholder="Imię nowej osoby">
      <input type="submit" name="submit1" class="css-button css-block css-black" value="Dodaj osobę">
    </form>
  </div>
  
  <!-- Footer -->
  <footer class="css-padding-16 css-teal css-small css-center" id="footer">
    <div class="css-row-padding">
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
// Accordion 
function myAccFunc(arg) {
  var x = document.getElementById(arg);
  if (x.className.indexOf("css-show") == -1) {
    x.className += " css-show";
  } else {
    x.className = x.className.replace(" css-show", "");
  }
}


function loadDiv(klasa) {
  document.getElementById('empty_place_for_divs').innerHTML = document.getElementById(klasa).innerHTML;
  document.querySelectorAll(klasa).style.display = "block";
}

function reloadSite() {
  location.reload();
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

document.querySelectorAll("div").forEach(function(element) {
  element.addEventListener("click", addClassOnClick);
});


document.getElementById("object_one").click();

document.getElementById("object_two").click();

document.getElementById("object_three").click();

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
