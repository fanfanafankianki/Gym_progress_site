<?php
require('db.php');
$exercise_id = $_GET["exercise_id"];
$training_id = $_GET["training_id"];  
$conn = connectToDb();
$query = "SELECT exercises.exercise_id, exercises.exercise_name, traininghistory.training_date, traininghistory.training_history_id, trainingdetails.weight, trainingdetails.reps
FROM trainingdetails
JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
JOIN traininghistory ON trainingdetails.training_history_id = traininghistory.training_history_id
JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id
WHERE exercises.exercise_id = $exercise_id AND trainingwithexercises.training_id = $training_id;
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