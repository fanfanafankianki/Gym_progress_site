<?php
require('db.php');

function getExercisesByTrainingId($training_history_id) {
  $conn = connectToDb();
  $query = "
	SELECT
	exercises.exercise_name,
	trainingdetails.exercise_id,
	trainingdetails.weight,
	trainingdetails.reps
	FROM
	trainingwithexercises
	JOIN traininghistory ON trainingwithexercises.training_with_exercises_id = traininghistory.training_with_exercises_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
	trainingdetails.exercise_id = trainingwithexercises.exercise_1
	AND traininghistory.training_history_id = $training_history_id
	UNION
	SELECT
	exercises.exercise_name,
	trainingdetails.exercise_id,
	trainingdetails.weight,
	trainingdetails.reps
	FROM
	trainingwithexercises
	JOIN traininghistory ON trainingwithexercises.training_with_exercises_id = traininghistory.training_history_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
	trainingdetails.exercise_id = trainingwithexercises.exercise_2
	AND traininghistory.training_history_id = $training_history_id
	UNION
	SELECT
	exercises.exercise_name,
	trainingdetails.exercise_id,
	trainingdetails.weight,
	trainingdetails.reps
	FROM
	trainingwithexercises
	JOIN traininghistory ON trainingwithexercises.training_with_exercises_id = traininghistory.training_history_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
	trainingdetails.exercise_id = trainingwithexercises.exercise_3
	AND traininghistory.training_history_id = $training_history_id
	UNION
	SELECT
	exercises.exercise_name,
	trainingdetails.exercise_id,
	trainingdetails.weight,
	trainingdetails.reps
	FROM
	trainingwithexercises
	JOIN traininghistory ON trainingwithexercises.training_with_exercises_id = traininghistory.training_history_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
	trainingdetails.exercise_id = trainingwithexercises.exercise_4
	AND traininghistory.training_history_id = $training_history_id
	UNION
	SELECT
	exercises.exercise_name,
	trainingdetails.exercise_id,
	trainingdetails.weight,
	trainingdetails.reps
	FROM
	trainingwithexercises
	JOIN traininghistory ON trainingwithexercises.training_with_exercises_id = traininghistory.training_history_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
	trainingdetails.exercise_id = trainingwithexercises.exercise_5
	AND traininghistory.training_history_id = $training_history_id
	UNION
	SELECT
	exercises.exercise_name,
	trainingdetails.exercise_id,
	trainingdetails.weight,
	trainingdetails.reps
	FROM
	trainingwithexercises
	JOIN traininghistory ON trainingwithexercises.training_with_exercises_id = traininghistory.training_history_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
	trainingdetails.exercise_id = trainingwithexercises.exercise_6
	AND traininghistory.training_history_id = $training_history_id
	UNION
	SELECT
	exercises.exercise_name,
	trainingdetails.exercise_id,
	trainingdetails.weight,
	trainingdetails.reps
	FROM
	trainingwithexercises
	JOIN traininghistory ON trainingwithexercises.training_with_exercises_id = traininghistory.training_history_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
	trainingdetails.exercise_id = trainingwithexercises.exercise_7
	AND traininghistory.training_history_id = $training_history_id
	UNION
	SELECT
	exercises.exercise_name,
	trainingdetails.exercise_id,
	trainingdetails.weight,
	trainingdetails.reps
	FROM
	trainingwithexercises
	JOIN traininghistory ON trainingwithexercises.training_with_exercises_id = traininghistory.training_history_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
	trainingdetails.exercise_id = trainingwithexercises.exercise_8
	AND traininghistory.training_history_id = $training_history_id
	UNION
	SELECT
	exercises.exercise_name,
	trainingdetails.exercise_id,
	trainingdetails.weight,
	trainingdetails.reps
	FROM
	trainingwithexercises
	JOIN traininghistory ON trainingwithexercises.training_with_exercises_id = traininghistory.training_history_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
	trainingdetails.exercise_id = trainingwithexercises.exercise_9
	AND traininghistory.training_history_id = $training_history_id;
	";
	$result = mysqli_query($conn, $query);
	$records = [];
	while ($record = mysqli_fetch_assoc($result)) {
		$exercise_details = [
			'exercise_name' => $record['exercise_name'],
			'exercise_id' => $record['exercise_id'],
			'weight' => $record['weight'],
			'reps' => $record['reps']
		];
		$records[] = $exercise_details;
	}
	echo json_encode($records);
	mysqli_close($conn);
}

$training_history_id = $_POST["training_history_id"];
getexercisesByTrainingId(1);
?>

