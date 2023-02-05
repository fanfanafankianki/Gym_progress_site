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
  VALUES (3, 
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
      <a onclick="loadDiv('klasa10')" href="#" class="css-bar-item css-button">Dodaj trening</a>
      <a onclick="loadDiv('klasa8')" href="#" class="css-bar-item css-button">Historia treningów</a>
      <a onclick="loadDiv('klasa8')" href="#" class="css-bar-item css-button">Wykresy</a>
    </div>
    <a onclick="myAccFunc('object_two_items')" href="javascript:void(0)" class="css-button css-block2 css-white css-left-align" id="object_two">
      Bartek
    </a>
    <div id="object_two_items" class="css-bar-block css-hide css-padding-large css-medium">
      <a onclick="loadDiv('klasa5')" href="#" class="css-bar-item css-button css-light-grey">Trening 1</a>
      <a onclick="loadDiv('klasa6')" href="#" class="css-bar-item css-button">Trening 2</a>
      <a onclick="loadDiv('klasa7')" href="#" class="css-bar-item css-button">Trening 3</a>
      <a onclick="loadDiv('klasa8')" href="#" class="css-bar-item css-button">Trening 4</a>
      <a onclick="loadDiv('klasa10')" href="#" class="css-bar-item css-button">Dodaj trening</a>
      <a onclick="loadDiv('klasa8')" href="#" class="css-bar-item css-button">Historia treningów</a>
      <a onclick="loadDiv('klasa8')" href="#" class="css-bar-item css-button">Wykresy</a>
    </div>
    <a onclick="loadDiv('klasa9')" href="javascript:void(0)" class="css-button css-block2 css-white css-left-align" id="object_one">
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
    <div class="div1">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 1" name="Name" required></p>  
      </div>
      <div class="div2"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 2" name="Name" required></p>
      </div>
      <div class="div3">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 3" name="Name" required></p>
      </div>
      <div class="div4"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 4" name="Name" required></p>
      </div>
      <div class="div5"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 5" name="Name" required></p>
      </div>
      <div class="div6"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 6" name="Name" required></p>
      </div>
  </div>
  <div id="klasa2" class="klasa2">
      <div class="div1">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 21" name="Name" required></p>  
      </div>
      <div class="div2"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 22" name="Name" required></p>
      </div>
      <div class="div3">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 23" name="Name" required></p>
      </div>
      <div class="div4"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 24" name="Name" required></p>
      </div>
      <div class="div5"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 25" name="Name" required></p>
      </div>
      <div class="div6"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 26" name="Name" required></p>
      </div>
  </div>
  <div id="klasa3" class="klasa3">
    <div class="div1">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 31" name="Name" required></p>  
    </div>
    <div class="div2"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 32" name="Name" required></p>
    </div>
    <div class="div3">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 33" name="Name" required></p>
    </div>
    <div class="div4"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 34" name="Name" required></p>
    </div>
    <div class="div5"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 35" name="Name" required></p>
    </div>
    <div class="div6"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 36" name="Name" required></p>
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
  <div id="klasa6" class="klasa6">
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
  <div id="klasa7" class="klasa7">
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
  <div id="klasa8" class="klasa8">
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
  <div id="klasa9" class="klasa9">
    <div class="div1">
      <form method="post">
        <input type="text" name="text" class="css-input css-border" placeholder="Imię nowej osoby">
        <input type="submit" name="submit1" class="css-button css-block css-black" value="Dodaj osobę">
      </form>
    </div>
  </div>
  <div id="klasa10" class="klasa10">
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
