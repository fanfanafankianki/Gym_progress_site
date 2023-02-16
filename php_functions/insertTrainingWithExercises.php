<?php
require('db.php');
session_start();
$user_id = $_SESSION['user_id'];

if (isset($_POST['insertTrainingWithExercises'])) {
  $training_name = (!empty($_POST['text1'])) ? $_POST['text1'] : null;
  $exercise_1 = (!empty($_POST['text2'])) ? $_POST['text2'] : null;
  $exercise_2 = (!empty($_POST['text3'])) ? $_POST['text3'] : null;
  $exercise_3 = (!empty($_POST['text4'])) ? $_POST['text4'] : null;
  $exercise_4 = (!empty($_POST['text5'])) ? $_POST['text5'] : null;
  $exercise_5 = (!empty($_POST['text6'])) ? $_POST['text6'] : null;
  $exercise_6 = (!empty($_POST['text7'])) ? $_POST['text7'] : null;
  $exercise_7 = (!empty($_POST['text8'])) ? $_POST['text8'] : null;
  $exercise_8 = (!empty($_POST['text9'])) ? $_POST['text9'] : null;
  $exercise_9 = (!empty($_POST['text10'])) ? $_POST['text10'] : null;
  $profile_id = (!empty($_POST['profile_id'])) ? $_POST['profile_id'] : null;
  


  $conn = connectToDb();

  // Zapytanie SQL
  $sqlcheck = "SELECT UserProfiles.profile_id, Users.user_name 
  FROM UserProfiles 
  JOIN Users ON Userprofiles.user_id = Users.user_id  
  WHERE UserProfiles.profile_id = $profile_id AND Users.user_id = $user_id;";
  $check_result = mysqli_query($conn, $sqlcheck);
  if (mysqli_num_rows($check_result) > 0) {
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

    $exercise_array = array();

    if (!is_null($exercise_1)) {
      $exercise_array[] = $exercise_1;
    }
    if (!is_null($exercise_2)) {
      $exercise_array[] = $exercise_2;
    }
    if (!is_null($exercise_3)) {
      $exercise_array[] = $exercise_3;
    }
    if (!is_null($exercise_4)) {
      $exercise_array[] = $exercise_4;
    }
    if (!is_null($exercise_5)) {
      $exercise_array[] = $exercise_5;
    }
    if (!is_null($exercise_6)) {
      $exercise_array[] = $exercise_6;
    }
    if (!is_null($exercise_7)) {
      $exercise_array[] = $exercise_7;
    }
    if (!is_null($exercise_8)) {
      $exercise_array[] = $exercise_8;
    }
    if (!is_null($exercise_9)) {
      $exercise_array[] = $exercise_9;
    }
    
    foreach ($exercise_array as $exercise_name) {
      $sql2 = "INSERT INTO exercises (exercise_name) VALUES ('$exercise_name')";
      if (mysqli_query($conn, $sql2)) {
        $exercise_id[] = mysqli_insert_id($conn);
      } else {
        echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
      }
    }    
  
  
    $num_of_exercises = count($exercise_array);

    $sql3 = "INSERT INTO TrainingWithExercises (training_id";
    
    for ($i = 1; $i <= $num_of_exercises; $i++) {
      $sql3 .= ", exercise_{$i}";
    }
    
    $sql3 .= ") VALUES ($training_added_id";
    
    for ($i = 0; $i < $num_of_exercises; $i++) {
      $sql3 .= ", {$exercise_id[$i]}";
    }
    
    $sql3 .= ");";
    
    if (mysqli_query($conn, $sql3)) {
      echo "Rekord został dodany3";
    } else {
      echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
    }
  }
  
  mysqli_close($conn);
  
}
?>