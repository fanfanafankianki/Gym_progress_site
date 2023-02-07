<?php
function connectToDb() {
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
  return $conn;
}
?>
<?php
  $training_id = $_GET["training_id"];
  $conn = connectToDb();
  $query = "SELECT TrainingHistory.*, Trainings.training_name, TrainingWithExercises.exercise_1, TrainingWithExercises.exercise_2, TrainingWithExercises.exercise_3, TrainingWithExercises.exercise_4, TrainingWithExercises.exercise_5, TrainingWithExercises.exercise_6, TrainingWithExercises.exercise_7, TrainingWithExercises.exercise_8, TrainingWithExercises.exercise_9, Users.user_id FROM TrainingHistory 
  INNER JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id 
  INNER JOIN Trainings ON TrainingWithExercises.training_id = Trainings.training_id 
  INNER JOIN Users ON Trainings.user_id = Users.user_id 
  WHERE Users.user_id = 3 AND Trainings.training_id = $training_id";
  $result = mysqli_query($conn, $query);
  $trainingDetails = "";
  while ($record = mysqli_fetch_assoc($result)) {
    $training_history_id = $record["training_history_id"];
    $training_with_exercises_id = $record["training_with_exercises_id"];
    $training_date = $record["training_date"];
    $training_name = $record["training_name"];
    $exercise_1 = $record["exercise_1"];
    $exercise_2 = $record["exercise_2"];	
    $exercise_3 = $record["exercise_3"];	
    $exercise_4 = $record["exercise_4"];
    $exercise_5 = $record["exercise_5"];	
    $exercise_6 = $record["exercise_6"];	
    $exercise_7 = $record["exercise_7"];
    $exercise_8 = $record["exercise_8"];	
    $exercise_9 = $record["exercise_9"];		
    $weight_1 = $record["weight_1"];
    $weight_2 = $record["weight_2"];
    $weight_3 = $record["weight_3"];	
    $weight_4 = $record["weight_4"];
    $weight_5 = $record["weight_5"];
    $weight_6 = $record["weight_6"];
    $weight_7 = $record["weight_7"];
    $weight_8 = $record["weight_8"];
    $weight_9 = $record["weight_9"];
    $reps_1 = $record["reps_1"];
    $reps_2 = $record["reps_2"];
    $reps_3 = $record["reps_3"];
    $reps_4 = $record["reps_4"];
    $reps_5 = $record["reps_5"];
    $reps_6 = $record["reps_6"];
    $reps_7 = $record["reps_7"];
    $reps_8 = $record["reps_8"];
    $reps_9 = $record["reps_9"];
    $user_id = $record["user_id"];
    $trainingDetails .= "Training History ID: " . $training_history_id . "<br>";
    $trainingDetails .= "Training With Exercises ID: " . $training_with_exercises_id . "<br>";
    $trainingDetails .= "Training Date: " . $training_date . "<br>";
    $trainingDetails .= "Training Name: " . $training_name . "<br>";
    $trainingDetails .= "exercise1 Name: " . $exercise_1 . "<br>";	
    $trainingDetails .= "exercise2 Name: " . $exercise_2 . "<br>";	
    $trainingDetails .= "exercise3 Name: " . $exercise_3 . "<br>";	
    $trainingDetails .= "exercise4 Name: " . $exercise_4 . "<br>";	
    $trainingDetails .= "exercise5 Name: " . $exercise_5 . "<br>";	
    $trainingDetails .= "exercise6 Name: " . $exercise_6 . "<br>";	
    $trainingDetails .= "exercise7 Name: " . $exercise_7 . "<br>";	
    $trainingDetails .= "exercise8 Name: " . $exercise_8 . "<br>";	
    $trainingDetails .= "exercise9 Name: " . $exercise_9 . "<br>";	
    $trainingDetails .= "Weight 1: " . $weight_1 . " Repetitions 1: " . $reps_1 . "<br>";
    $trainingDetails .= "Weight 2: " . $weight_2 . " Repetitions 2: " . $reps_2 . "<br>";
    $trainingDetails .= "Weight 3: " . $weight_3 . " Repetitions 3: " . $reps_3 . "<br>";
    $trainingDetails .= "Weight 4: " . $weight_4 . " Repetitions 4: " . $reps_4 . "<br>";
    $trainingDetails .= "Weight 5: " . $weight_5 . " Repetitions 5: " . $reps_5 . "<br>";
    $trainingDetails .= "Weight 6: " . $weight_6 . " Repetitions 6: " . $reps_6 . "<br>";
    $trainingDetails .= "Weight 7: " . $weight_7 . " Repetitions 7: " . $reps_7 . "<br>";
    $trainingDetails .= "Weight 8: " . $weight_8 . " Repetitions 8: " . $reps_8 . "<br>";
    $trainingDetails .= "Weight 9: " . $weight_9 . " Repetitions 9: " . $reps_9 . "<br>";
    $trainingDetails .= "user_id 3: " . $user_id . " user_id 3: " . $user_id . "<br>";
  }
  echo $trainingDetails;

?>