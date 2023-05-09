<?php
session_start();
require('db.php');
$exercise_id = $_GET["exercise_id"];
$training_id = $_GET["training_id"];
$conn = connectToDb();
$user_id = $_SESSION['user_id'];

$query = "SELECT exercises.exercise_id, exercises.exercise_name, traininghistory.training_date, traininghistory.training_history_id, trainingdetails.weight, trainingdetails.reps
FROM trainingdetails
JOIN exercises ON trainingdetails.exercise_id = exercises.exercise_id
JOIN traininghistory ON trainingdetails.training_history_id = traininghistory.training_history_id
JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id
JOIN trainings ON trainingwithexercises.training_id = trainings.training_id
JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
JOIN users ON userprofiles.user_id = users.user_id
WHERE exercises.exercise_id = ? AND trainingwithexercises.training_id = ? AND users.user_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("iii", $exercise_id, $training_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

$dates = array();
$weights = array();
$repetitions = array();

while ($row = $result->fetch_assoc()) {
    array_push($dates, $row['training_date']);
    array_push($repetitions, $row['reps']);
    array_push($weights, $row['weight']);
}

echo json_encode(array("dates" => $dates, "weights" => $weights, "repetitions" => $repetitions));

$stmt->close();
$conn->close();
?>
