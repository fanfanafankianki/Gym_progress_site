<?php
require('db.php');
function getExercisesByTrainingId($training_id) {
  $conn = connectToDb();
  $query = "SELECT exercises.exercise_name, exercises.exercise_id
	FROM exercises
	JOIN trainingwithexercises ON trainingwithexercises.exercise_1 = exercises.exercise_id
	 OR trainingwithexercises.exercise_2 = exercises.exercise_id
	 OR trainingwithexercises.exercise_3 = exercises.exercise_id
	 OR trainingwithexercises.exercise_4 = exercises.exercise_id
	 OR trainingwithexercises.exercise_5 = exercises.exercise_id
	 OR trainingwithexercises.exercise_6 = exercises.exercise_id
	 OR trainingwithexercises.exercise_7 = exercises.exercise_id
	 OR trainingwithexercises.exercise_8 = exercises.exercise_id
	 OR trainingwithexercises.exercise_9 = exercises.exercise_id
	WHERE trainingwithexercises.training_id = $training_id
	";
  $result = mysqli_query($conn, $query);
  $trainingData = "";  
  while ($record = mysqli_fetch_assoc($result)) {
	$exercise_id = $record["exercise_id"];
	$exercise_name = $record["exercise_name"];
	echo "<a onclick='showExerciseDetailsChart(" . $exercise_id . ", " . $training_id . ")' href='#' class='css-bar-item css-button'>" . $exercise_name . "</a><br>";
  }
  mysqli_close($conn);

}

$training_id = $_POST["training_id"];
getexercisesByTrainingId($training_id);
?>

