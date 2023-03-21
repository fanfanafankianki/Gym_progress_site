<?php
require('db.php');
session_start();

if (isset($_POST['SendTrainingWithExercises'])) {
  $conn = connectToDb();
  $user_id = $_SESSION['user_id'];
  $training_with_exercises_id = $_POST['Training_With_Exercises_ID'];
  // Zapytanie SQL
  $sqlcheck="SELECT trainingwithexercises.training_with_exercises_id, Users.user_name 
  FROM trainingwithexercises 
    JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
    JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id    
    JOIN Users ON userprofiles.user_id = users.user_id  
  WHERE trainingwithexercises.training_with_exercises_id = $training_with_exercises_id AND Users.user_id = $user_id";
  $check_result = mysqli_query($conn, $sqlcheck);
  if (mysqli_num_rows($check_result) > 0) {
    $sql1 = "INSERT INTO TrainingHistory (training_with_exercises_id, training_date)
      VALUES ($training_with_exercises_id, NOW());";
    if (mysqli_query($conn, $sql1)) {
      $training_history_id = mysqli_insert_id($conn);
      for ($i = 0; $i < (((count($_POST))-2)/3) ; $i++) {
        $weight = $_POST['Weight_' . $i];
        $reps = $_POST['Reps_' . $i];
        $exercise_id = $_POST['Exercise_ID_' . $i];
      $sql2 = "INSERT INTO TrainingDetails (training_history_id, exercise_id, weight, reps)
        VALUES ($training_history_id, $exercise_id, $weight, $reps)";
        
        if (!mysqli_query($conn, $sql2)) {
          echo "Błąd podczas dodawania danych do tabel: " . mysqli_error($conn);
          break;
        }
        echo "Dodano rekord $i ";
      }
      } else {
        echo "Błąd podczas dodawania danych do tabel: " . mysqli_error($conn);
      }
    }

  mysqli_close($conn);
  header("Location: http://localhost/Gym_Site/logged.php");
}
?>