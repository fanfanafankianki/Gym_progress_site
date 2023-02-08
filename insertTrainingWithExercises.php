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
    exit("Połączenie nieudane: " . mysqli_connect_error());
  }
  return $conn;
}
if (isset($_POST['submit2'])) {
  $training_name = $_POST['text1'];
  $exercise_1 = $_POST['text2'];
  $exercise_2 = $_POST['text3'];
  $exercise_3 = $_POST['text4'];
  $exercise_4 = $_POST['text5'];
  $exercise_5 = $_POST['text6'];
  $exercise_6 = $_POST['text7'];
  $exercise_7 = $_POST['text8'];
  $exercise_8 = $_POST['text9'];
  $exercise_9 = $_POST['text10'];
  $profile_id = $_POST['profile_id'];


  $conn = connectToDb();

  // Zapytanie SQL

  $sql1 = "INSERT INTO trainings (training_name, profile_id)
  VALUES ('$training_name', '$profile_id');";

  if (mysqli_query($conn, $sql1)) {
    echo "Rekord został dodany";
    $training_added_id = mysqli_insert_id($conn);
    echo "Ostatnio dodane ID to: " . $training_added_id;
    echo "<script>document.addEventListener('DOMContentLoaded', function() {createTrainingElement('$training_name');});</script>";
  } else {
    echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
  }

  $exercise_id = array();

  $exercise_array = array($exercise_1, $exercise_2, $exercise_3, $exercise_4, $exercise_5, $exercise_6, $exercise_7, $exercise_8, $exercise_9);
  
  foreach ($exercise_array as $exercise_name) {
  $sql2 = "INSERT INTO exercises (exercise_name) VALUES ('$exercise_name')";
    if (mysqli_query($conn, $sql2)) {
      $exercise_id[] = mysqli_insert_id($conn);
    } else {
      echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
    }
  }
  
  
  $sql3 = "INSERT INTO TrainingWithExercises (training_id, exercise_1, exercise_2, exercise_3, exercise_4, exercise_5, exercise_6, exercise_7, exercise_8, exercise_9)
  VALUES ($training_added_id, 
    {$exercise_id[0]}, 
    {$exercise_id[1]}, 
    {$exercise_id[2]},
    {$exercise_id[3]}, 
    {$exercise_id[4]}, 
    {$exercise_id[5]},
    {$exercise_id[6]}, 
    {$exercise_id[7]},
    {$exercise_id[8]}
  );";
  
  if (mysqli_query($conn, $sql3)) {
    echo "Rekord został dodany3";
  } else {
    echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
  }
  
  mysqli_close($conn);
  header("Location: http://localhost/Gym_Site/index.php");
  
}