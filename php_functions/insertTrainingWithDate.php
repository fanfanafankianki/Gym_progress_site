<?php
require('db.php');
require('redirection.php');
session_start();

if (isset($_POST['SendTrainingWithExercises'])) {
  $conn = connectToDb();
  $user_id = $_SESSION['user_id'];
  $training_with_exercises_id = $_POST['Training_With_Exercises_ID'];
  
  // Prepared statement
  $stmt = $conn->prepare("SELECT trainingwithexercises.training_with_exercises_id, Users.user_name 
  FROM trainingwithexercises 
    JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
    JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id    
    JOIN Users ON userprofiles.user_id = users.user_id  
  WHERE trainingwithexercises.training_with_exercises_id = ? AND Users.user_id = ?");
  $stmt->bind_param("ii", $training_with_exercises_id, $user_id);
  $stmt->execute();
  $check_result = $stmt->get_result();
  
  if ($check_result->num_rows > 0) {
      $stmt1 = $conn->prepare("INSERT INTO TrainingHistory (training_with_exercises_id, training_date) VALUES (?, NOW())");
      $stmt1->bind_param("i", $training_with_exercises_id);
      if ($stmt1->execute()) {
          $training_history_id = $stmt1->insert_id;
          for ($i = 0; $i < (((count($_POST))-2)/3) ; $i++) {
              $weight = $_POST['Weight_' . $i];
              $reps = $_POST['Reps_' . $i];
              $exercise_id = $_POST['Exercise_ID_' . $i];
              $stmt2 = $conn->prepare("INSERT INTO TrainingDetails (training_history_id, exercise_id, weight, reps) VALUES (?, ?, ?, ?)");
              $stmt2->bind_param("iiii", $training_history_id, $exercise_id, $weight, $reps);
              
              if (!$stmt2->execute()) {
                  echo "Błąd podczas dodawania danych do tabel: " . mysqli_error($conn);
                  break;
              }
              echo "Dodano rekord $i ";
          }
      } else {
          echo "Błąd podczas dodawania danych do tabel: " . mysqli_error($conn);
      }
  }

  $stmt->close();
  $conn->close();
  redirectToLoggedPage();
}
?>
