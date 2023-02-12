<?php
require('db.php');
function getExercisesByTrainingId($training_id) {
  $conn = connectToDb();
  $query = "SELECT Exercises.exercise_name, Exercises.exercise_id
	FROM Exercises
	JOIN TrainingWithExercises ON TrainingWithExercises.exercise_1 = Exercises.exercise_id
	 OR TrainingWithExercises.exercise_2 = Exercises.exercise_id
	 OR TrainingWithExercises.exercise_3 = Exercises.exercise_id
	 OR TrainingWithExercises.exercise_4 = Exercises.exercise_id
	 OR TrainingWithExercises.exercise_5 = Exercises.exercise_id
	 OR TrainingWithExercises.exercise_6 = Exercises.exercise_id
	 OR TrainingWithExercises.exercise_7 = Exercises.exercise_id
	 OR TrainingWithExercises.exercise_8 = Exercises.exercise_id
	 OR TrainingWithExercises.exercise_9 = Exercises.exercise_id
	WHERE TrainingWithExercises.training_id = $training_id
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
getExercisesByTrainingId($training_id);
?>

