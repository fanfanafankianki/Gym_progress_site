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
  $dbname = "gymsitedatabase_final";

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
function addUser($profile_name_to_add) {
  $conn = connectToDb();

  // Zapytanie SQL
  $sql = "INSERT INTO userProfiles(profile_name) VALUES ('$profile_name_to_add')";

  if (mysqli_query($conn, $sql)) {
    $profile_id = mysqli_insert_id($conn);
    $_SESSION['profile_id1'] = $profile_id;
    echo "<script>document.addEventListener('DOMContentLoaded', function() {createUserElement('$profile_name_to_add');});</script>";
  } else {
    echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
  }

  // Zamykanie połączenia
  mysqli_close($conn);
  echo "<script>reloadSite()</script>";
}

if (isset($_POST['submit1'])) {
  $profile_name = $_POST['text'];
  addUser($profile_name);
}
?>
<body class="css-content" style="max-width:1200px">


<?php
  function select_user_training_info($profile_id) {
    $conn = connectToDb();
    $query = "SELECT UserProfiles.profile_id, UserProfiles.profile_name, Trainings.training_id, Trainings.training_name
    FROM UserProfiles
    JOIN Trainings ON UserProfiles.profile_id = Trainings.profile_id
    WHERE UserProfiles.profile_id = $profile_id";
    $result = mysqli_query($conn, $query);
    $training_names = array();
    while($record = mysqli_fetch_assoc($result)) {
    $profile_id = $record["profile_id"];
    $profile_name = $record["profile_name"];
    $training_ids[] = $record["training_id"];
    $training_names[] = $record["training_name"];
    }
    echo "<script>document.addEventListener('DOMContentLoaded', function() {createUserElement('$profile_id', '$profile_name', " . json_encode($training_names) . ", " . json_encode($training_ids) . ");});</script>";
    $conn->close();
    } 
  select_user_training_info(2);
  select_user_training_info(3);
?>
<?php
function getTrainingHistoryByUserId($profile_id) {
  $conn = connectToDb();
  $query = "SELECT TrainingHistory.*, UserProfiles.profile_id FROM TrainingHistory INNER JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id INNER JOIN Trainings ON TrainingWithExercises.training_id = Trainings.training_id INNER JOIN UserProfiles ON Trainings.profile_id = UserProfiles.profile_id WHERE UserProfiles.profile_id = $profile_id";
  $result = mysqli_query($conn, $query);

  while ($record = mysqli_fetch_assoc($result)) {
    $training_history_id = $record["training_history_id"];
    $training_with_exercises_id = $record["training_with_exercises_id"];
    $training_date = $record["training_date"];
    $weight_1 = $record["weight_1"];
    $reps_1 = $record["reps_1"];
    $weight_2 = $record["weight_2"];
    $reps_2 = $record["reps_2"];
    $weight_3 = $record["weight_3"];
    $reps_3 = $record["reps_3"];
    $profile_id = $record["profile_id"];
    echo "Training History ID: " . $training_history_id . "<br>";
    echo "Training With Exercises ID: " . $training_with_exercises_id . "<br>";
    echo "Training Date: " . $training_date . "<br>";
    echo "Weight 1: " . $weight_1 . " Repetitions 1: " . $reps_1 . "<br>";
    echo "Weight 2: " . $weight_2 . " Repetitions 2: " . $reps_2 . "<br>";
    echo "Weight 3: " . $weight_3 . " Repetitions 3: " . $reps_3 . "<br>";
    echo "profile_id: " . $profile_id . "<br>";
  }
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
<nav class="sidebar css-bar-block css-white css-collapse css-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="css-container css-display-container css-padding-16">
    <i onclick="sidebar()" class="fa fa-remove css-hide-large css-button css-display-topright"></i>
    <h3 onclick="reloadSite()" class="css-wide css-button"><b>Gym Site</b>
    </h3>
  </div>
  <div id=target class="css-padding-64 css-large css-text-grey" style="font-weight:bold">
    <a onclick="loadDiv('klasa_on2')" href="javascript:void(0)" class="css-button css-block2 css-white css-left-align" id="object_one">
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
      <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
      <?php } ?>
      <?php if (empty($_SESSION['profile_id'])) : ?>
      <form action="http://localhost/Gym_Site/login.php" method="post" class="css-margin-right">
        <input type="text" name="login" class="css-margin-right"/> 
        <br/> 
        <input type="password" name="password" class="css-margin-right"/>
        <br/>
        <button type="submit" class="css-margin-right">Zaloguj się</button>
      </form>
      <?php else : ?>
          <p>Hi, <?=$_SESSION['profile_id']?></p>
          <a href="http://localhost/Gym_Site/logout.php">logout</a>
      <?php endif; ?>
      <i class="fa fa-search"></i>
    </p>
  </header>
  <p>Hi, <?=$_SESSION['profile_id']?></p>


  <div class="css-container css-text-grey" id="number_of_items">
    <p>6 items</p>
  </div>

  <!-- Product grid -->
  <div class="parent">
    <div id="empty_place_for_divs">
      Welcome to Gym Site! Here you can configure your training routine, track your trainings and your progress! 
    </div>
  </div> 


  <div id="klasa6" class="klasa6>
    <div id="recordContainer">

        <a onclick="getRecord()" href="#" class="css-bar-item css-button">Click</a>
    </div>
  </div>  
  <div id="klasa7" class="klasa7">
    <div id="tendiv" class="div1">
      <?php
        function getTrainingsByUserId($profile_id) {
          $conn = connectToDb();
          $query = "SELECT Trainings.training_id, Trainings.training_name
          FROM Trainings
          INNER JOIN UserProfiles ON Trainings.profile_id = UserProfiles.profile_id
          WHERE UserProfiles.profile_id = $profile_id";
          $result = mysqli_query($conn, $query);
          while ($record = mysqli_fetch_assoc($result)) {+
            $training_id = $record["training_id"];
            $training_name = $record["training_name"];
            echo "<a onclick='showTrainingDetails(" . $training_id . ")' href='#' class='css-bar-item css-button'>" . $training_name . "</a><br>";
          }
        }
        getTrainingsByUserId($profile_id);
      ?>
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

function createUserElement(profile_id, profile_name, trainingList = [], trainingIds = []) {
  let a = document.createElement("a");
  a.innerHTML = profile_name;
  a.setAttribute("href", "javascript:void(0)");
  a.setAttribute("onclick", `myAccFunc('${profile_name}_items')`);
  a.setAttribute("class", "css-button css-block2 css-white css-left-align css-show");
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
  a2.setAttribute("onclick", "loadTrainingHistoryDiv()");
  a2.setAttribute("href", "#");
  a2.setAttribute("class", "css-bar-item css-button");
  div.appendChild(a2);

  let a3 = document.createElement("a");
  a3.innerHTML = "Wykresy";
  a3.setAttribute("onclick", "loadChartDiv()");
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

function showTrainingDetails(training_id) {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "getTrainingDetails.php?training_id=" + training_id, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      document.getElementById("tendiv").innerHTML = xhr.responseText + '<div style="display: block;"><canvas id="myChart2"></canvas></div>';
      createChart();
    }
  };
  xhr.send();
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

function loadChartDiv() {
  var newDiv1 = document.createElement("div");
  newDiv1.id = "klasa7";
  newDiv1.className = "klasa7";
  newDiv1.style.display = "block";

  var newDiv2 = document.createElement("div");
  newDiv2.id = "tendiv";
  newDiv2.className = "div1";

  newDiv2.innerHTML = "<?php getTrainingsByUserId($_SESSION['profile_id']); ?>";

  newDiv1.appendChild(newDiv2);
  addDisplayBlockToChilds(newDiv1);
  document.querySelector("#empty_place_for_divs").innerHTML = newDiv1.outerHTML;
}

function loadTrainingHistoryDiv() {

  var newDiv1 = document.createElement("div");
  newDiv1.id = "klasa6";
  newDiv1.className = "klasa6";

  var newDiv2 = document.createElement("div");
  newDiv2.id = "recordContainer";

  newDiv2.innerHTML = "<?php getTrainingHistoryByUserId($_SESSION['profile_id']); ?>";

  newDiv1.appendChild(newDiv2);
  addDisplayBlockToChilds(newDiv1);
  document.querySelector("#empty_place_for_divs").innerHTML = newDiv1.outerHTML;
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

function showTrainingDetails(training_id) {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "getTrainingDetails.php?training_id=" + training_id, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      document.getElementById("tendiv").innerHTML = xhr.responseText + '<div style="display: block;"><canvas id="myChart2"></canvas></div>';
      createChart();
    }
  };
  xhr.send();
}

function createChart() {
  const ctx = document.getElementById('myChart2');
  const dates = ['2022-01-01', '2022-01-02', '2022-01-03', '2022-01-04', '2022-01-05', '2022-01-06'];
  const weight = [50, 55, 60, 65, 70, 75];
  const repetitions = [10, 12, 15, 18, 20, 22];

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: dates,
      datasets: [{
        label: 'Waga',
        data: weight,
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
        intersect: false,
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


function reloadSite() {
  location.reload();
}

document.getElementById("object_one").click();

document.getElementById("object_two").click();

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
