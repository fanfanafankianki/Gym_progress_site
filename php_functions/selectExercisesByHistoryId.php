<?php
session_start();
require('db.php');

function selectExercisesByTrainingId($training_history_id) {
  $conn = connectToDb();
  $user_id = $_SESSION['user_id'];
  $query = "
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingHistory
	JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id
	JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
	JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id    
	JOIN Users ON userprofiles.user_id = users.user_id  
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_1
	AND TrainingHistory.training_history_id = $training_history_id AND users.user_id = $user_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingHistory
	JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id
	JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
	JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id    
	JOIN Users ON userprofiles.user_id = users.user_id  
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_2
	AND TrainingHistory.training_history_id = $training_history_id AND users.user_id = $user_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingHistory
	JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id
	JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
	JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id    
	JOIN Users ON userprofiles.user_id = users.user_id  
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_3
	AND TrainingHistory.training_history_id = $training_history_id AND users.user_id = $user_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingHistory
	JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id
	JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
	JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id    
	JOIN Users ON userprofiles.user_id = users.user_id  
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_4
	AND TrainingHistory.training_history_id = $training_history_id AND users.user_id = $user_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingHistory
	JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id
	JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
	JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id    
	JOIN Users ON userprofiles.user_id = users.user_id  
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_5
	AND TrainingHistory.training_history_id = $training_history_id AND users.user_id = $user_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingHistory
	JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id
	JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
	JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id    
	JOIN Users ON userprofiles.user_id = users.user_id  
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_6
	AND TrainingHistory.training_history_id = $training_history_id AND users.user_id = $user_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingHistory
	JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id
	JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
	JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id    
	JOIN Users ON userprofiles.user_id = users.user_id  
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_7
	AND TrainingHistory.training_history_id = $training_history_id AND users.user_id = $user_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingHistory
	JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id
	JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
	JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id    
	JOIN Users ON userprofiles.user_id = users.user_id  
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_8
	AND TrainingHistory.training_history_id = $training_history_id AND users.user_id = $user_id
	UNION
	SELECT
	Exercises.exercise_name,
	TrainingDetails.exercise_id,
	TrainingDetails.weight,
	TrainingDetails.reps
	FROM
	TrainingHistory
	JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id
	JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
	JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id    
	JOIN Users ON userprofiles.user_id = users.user_id  
	JOIN TrainingDetails ON TrainingHistory.training_history_id = TrainingDetails.training_history_id
	JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
	WHERE
	TrainingDetails.exercise_id = TrainingWithExercises.exercise_9
	AND TrainingHistory.training_history_id = $training_history_id AND users.user_id = $user_id
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
selectExercisesByTrainingId($training_history_id);
?>

