<?php
require('db.php');
require('redirection.php');
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

  $stmt = $conn->prepare("SELECT UserProfiles.profile_id, Users.user_name 
  FROM UserProfiles 
  JOIN Users ON Userprofiles.user_id = Users.user_id  
  WHERE UserProfiles.profile_id = ? AND Users.user_id = ?");
  $stmt->bind_param("ii", $profile_id, $user_id);
  $stmt->execute();
  $check_result = $stmt->get_result();

  if ($check_result->num_rows > 0) {
      $stmt1 = $conn->prepare("INSERT INTO trainings (training_name, profile_id) VALUES (?, ?)");
      $stmt1->bind_param("si", $training_name, $profile_id);

      if ($stmt1->execute()) {
          echo "Rekord został dodany";
          $training_added_id = $stmt1->insert_id;
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
        $stmt2 = $conn->prepare("INSERT INTO exercises (exercise_name) VALUES (?)");
        $stmt2->bind_param("s", $exercise_name);
        if ($stmt2->execute()) {
            $exercise_id[] = $stmt2->insert_id;
        } else {
            echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
        }
    }
    
    $num_of_exercises = count($exercise_array);

    $sql3 = "INSERT INTO TrainingWithExercises (training_id";
    
    for ($i = 1; $i <= $num_of_exercises; $i++) {
        $sql3 .= ", exercise_{$i}";
    }
    
    $sql3 .= ") VALUES (?,";
    
    for ($i = 1; $i < $num_of_exercises; $i++) {
        $sql3 .= "?,";
    }
    
    $sql3 .= "?);";
    
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param(str_repeat('i', $num_of_exercises + 1), $training_added_id, ...$exercise_id);
    
    if ($stmt3->execute()) {
        echo "Rekord został dodany";
    } else {
        echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
redirectToLoggedPage();
}


