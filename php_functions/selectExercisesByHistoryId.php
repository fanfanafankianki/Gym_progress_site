<?php
session_start();
require('db.php');

function selectexercisesByTrainingId($training_history_id) {
  $conn = connectToDb();
  $user_id = $_SESSION['user_id'];
  $query = "
	SELECT
		exercises.exercise_name,
		trainingdetails.exercise_id,
		trainingdetails.weight,
		trainingdetails.reps
	FROM
		traininghistory
	JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id
	JOIN trainings ON trainingwithexercises.training_id = trainings.training_id
	JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
	JOIN users ON userprofiles.user_id = users.user_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
		trainingdetails.exercise_id = trainingwithexercises.exercise_1
		AND traininghistory.training_history_id = ? AND users.user_id = ?
	UNION
	SELECT
		exercises.exercise_name,
		trainingdetails.exercise_id,
		trainingdetails.weight,
		trainingdetails.reps
	FROM
		traininghistory
	JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id
	JOIN trainings ON trainingwithexercises.training_id = trainings.training_id
	JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
	JOIN users ON userprofiles.user_id = users.user_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
		trainingdetails.exercise_id = trainingwithexercises.exercise_2
		AND traininghistory.training_history_id = ? AND users.user_id = ?
	UNION
	SELECT
    exercises.exercise_name,
    trainingdetails.exercise_id,
    trainingdetails.weight,
    trainingdetails.reps
	FROM
		traininghistory
	JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id
	JOIN trainings ON trainingwithexercises.training_id = trainings.training_id
	JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
	JOIN users ON userprofiles.user_id = users.user_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
		trainingdetails.exercise_id = trainingwithexercises.exercise_3
		AND traininghistory.training_history_id = ? AND users.user_id = ?
	UNION
	SELECT
		exercises.exercise_name,
		trainingdetails.exercise_id,
		trainingdetails.weight,
		trainingdetails.reps
	FROM
		traininghistory
	JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id
	JOIN trainings ON trainingwithexercises.training_id = trainings.training_id
	JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
	JOIN users ON userprofiles.user_id = users.user_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
		trainingdetails.exercise_id = trainingwithexercises.exercise_4
		AND traininghistory.training_history_id = ? AND users.user_id = ?
	UNION
	SELECT
		exercises.exercise_name,
		trainingdetails.exercise_id,
		trainingdetails.weight,
		trainingdetails.reps
	FROM
		traininghistory
	JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id
	JOIN trainings ON trainingwithexercises.training_id = trainings.training_id
	JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
	JOIN users ON userprofiles.user_id = users.user_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
		trainingdetails.exercise_id = trainingwithexercises.exercise_5
		AND traininghistory.training_history_id = ? AND users.user_id = ?
	UNION
	SELECT
		exercises.exercise_name,
		trainingdetails.exercise_id,
		trainingdetails.weight,
		trainingdetails.reps
	FROM
		traininghistory
	JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id
	JOIN trainings ON trainingwithexercises.training_id = trainings.training_id
	JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
	JOIN users ON userprofiles.user_id = users.user_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
		trainingdetails.exercise_id = trainingwithexercises.exercise_6
		AND traininghistory.training_history_id = ? AND users.user_id = ?
	UNION
	SELECT
		exercises.exercise_name,
		trainingdetails.exercise_id,
		trainingdetails.weight,
		trainingdetails.reps
	FROM
		traininghistory
	JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id
	JOIN trainings ON trainingwithexercises.training_id = trainings.training_id
	JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
	JOIN users ON userprofiles.user_id = users.user_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
		trainingdetails.exercise_id = trainingwithexercises.exercise_7
		AND traininghistory.training_history_id = ? AND users.user_id = ?
	UNION
	SELECT
		exercises.exercise_name,
		trainingdetails.exercise_id,
		trainingdetails.weight,
		trainingdetails.reps
	FROM
		traininghistory
	JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id
	JOIN trainings ON trainingwithexercises.training_id = trainings.training_id
	JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
	JOIN users ON userprofiles.user_id = users.user_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
		trainingdetails.exercise_id = trainingwithexercises.exercise_8
		AND traininghistory.training_history_id = ? AND users.user_id = ?
	UNION
	SELECT
		exercises.exercise_name,
		trainingdetails.exercise_id,
		trainingdetails.weight,
		trainingdetails.reps
	FROM
		traininghistory
	JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id
	JOIN trainings ON trainingwithexercises.training_id = trainings.training_id
	JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
	JOIN users ON userprofiles.user_id = users.user_id
	JOIN trainingdetails ON traininghistory.training_history_id = trainingdetails.training_history_id
	JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
	WHERE
		trainingdetails.exercise_id = trainingwithexercises.exercise_9
		AND traininghistory.training_history_id = ? AND users.user_id = ?
	";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die('Error in preparing the statement: ' . mysqli_error($conn));
    }

	mysqli_stmt_bind_param($stmt, 'iiiiiiiiiiiiiiiiii', $training_history_id, $user_id, $training_history_id, $user_id, $training_history_id, $user_id, $training_history_id, $user_id, $training_history_id, $user_id, $training_history_id, $user_id, $training_history_id, $user_id, $training_history_id, $user_id, $training_history_id, $user_id);

    if (mysqli_stmt_execute($stmt) === false) {
        die('Error executing the statement: ' . mysqli_stmt_error($stmt));
    }

    $result = mysqli_stmt_get_result($stmt);

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

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

$training_history_id = $_POST["training_history_id"];
selectexercisesByTrainingId($training_history_id);
?>

