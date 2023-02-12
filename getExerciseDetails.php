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
    die("Połączenie nieudane: " . mysqli_connect_error());
  }
  return $conn;
}
	$exercise_id = $_GET["exercise_id"];
	$training_id = $_GET["training_id"];  
	$conn = connectToDb();
	$query = "SELECT Exercises.exercise_id, Exercises.exercise_name, TrainingHistory.training_date, TrainingHistory.training_history_id, TrainingDetails.weight, TrainingDetails.reps
	FROM TrainingDetails
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	JOIN TrainingHistory ON TrainingDetails.training_history_id = TrainingHistory.training_history_id
	JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id
	WHERE Exercises.exercise_id = $exercise_id AND TrainingWithExercises.training_id = $training_id;
	";
	$result = mysqli_query($conn, $query);

	$dates = array();
	$weights = array();
	$reps = array();

	while ($row = mysqli_fetch_assoc($result)) {
	  array_push($dates, $row['training_date']);
	  array_push($reps, $row['reps']);
	  array_push($weights, $row['weight']);
	}

	echo json_encode(array("dates" => $dates, "weights" => $weights, "reps" => $reps));


?>