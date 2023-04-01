<?php
require('db.php');

function getExercisesByTrainingId($training_history_id) {
  $conn = connectToDb();
  $query = "
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingWithExercises
	JOIN TrainingHistory ON TrainingWithExercises.training_with_exercises_id = TrainingHistory.training_with_exercises_id
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_1
	AND TrainingHistory.training_history_id = $training_history_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingWithExercises
	JOIN TrainingHistory ON TrainingWithExercises.training_with_exercises_id = TrainingHistory.training_history_id
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_2
	AND TrainingHistory.training_history_id = $training_history_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingWithExercises
	JOIN TrainingHistory ON TrainingWithExercises.training_with_exercises_id = TrainingHistory.training_history_id
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_3
	AND TrainingHistory.training_history_id = $training_history_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingWithExercises
	JOIN TrainingHistory ON TrainingWithExercises.training_with_exercises_id = TrainingHistory.training_history_id
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_4
	AND TrainingHistory.training_history_id = $training_history_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingWithExercises
	JOIN TrainingHistory ON TrainingWithExercises.training_with_exercises_id = TrainingHistory.training_history_id
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_5
	AND TrainingHistory.training_history_id = $training_history_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingWithExercises
	JOIN TrainingHistory ON TrainingWithExercises.training_with_exercises_id = TrainingHistory.training_history_id
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_6
	AND TrainingHistory.training_history_id = $training_history_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingWithExercises
	JOIN TrainingHistory ON TrainingWithExercises.training_with_exercises_id = TrainingHistory.training_history_id
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_7
	AND TrainingHistory.training_history_id = $training_history_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingWithExercises
	JOIN TrainingHistory ON TrainingWithExercises.training_with_exercises_id = TrainingHistory.training_history_id
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_8
	AND TrainingHistory.training_history_id = $training_history_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingWithExercises
	JOIN TrainingHistory ON TrainingWithExercises.training_with_exercises_id = TrainingHistory.training_history_id
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_9
	AND TrainingHistory.training_history_id = $training_history_id;
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
getExercisesByTrainingId(1);
?>

