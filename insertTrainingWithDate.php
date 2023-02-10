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
    exit("Połączenie nieudane: " . mysqli_connect_error());
  }
  return $conn;
}

if (isset($_POST['WstawDate'])) {
  $conn = connectToDb();
  $training_with_exercises_id = $_POST['Training_With_Exercises_ID'];
  // Zapytanie SQL
  $sql1 = "INSERT INTO TrainingHistory (training_with_exercises_id, training_date)
    VALUES ($training_with_exercises_id, NOW());";
  echo count($_POST);
  if (mysqli_query($conn, $sql1)) {
    $training_history_id = mysqli_insert_id($conn);
    for ($i = 0; $i < count($_POST) - 2; $i++) {
      $weight = $_POST['Weight_' . $i];
      $reps = $_POST['Reps_' . $i];
      $exercise_id = $_POST['Exercise_ID_' . $i];
	  $sql2 = "INSERT INTO TrainingDetails (training_history_id, exercise_id, weight, reps)
      VALUES ($training_history_id, $exercise_id, $weight, $reps)";
      
      if (!mysqli_query($conn, $sql2)) {
        echo "Błąd podczas dodawania danych do tabel: " . mysqli_error($conn);
        break;
      }
    }

    echo "Pomyślnie dodano dane do tabel.";
  } else {
    echo "Błąd podczas dodawania danych do tabel: " . mysqli_error($conn);
  }

  mysqli_close($conn);
  header("Location: http://localhost/Gym_Site/index.php"); 
}
