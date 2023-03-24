<?php
session_start();
require('db.php');
$exercise_id = $_GET["exercise_id"];
$training_id = $_GET["training_id"];
$conn = connectToDb();
$user_id = $_SESSION['user_id'];

$query = "SELECT Exercises.exercise_id, Exercises.exercise_name, TrainingHistory.training_date, TrainingHistory.training_history_id, TrainingDetails.weight, TrainingDetails.reps
FROM TrainingDetails
JOIN Exercises ON TrainingDetails.exercise_id = Exercises.exercise_id
JOIN TrainingHistory ON TrainingDetails.training_history_id = TrainingHistory.training_history_id
JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id
JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id
JOIN Users ON userprofiles.user_id = users.user_id
WHERE Exercises.exercise_id = ? AND TrainingWithExercises.training_id = ? AND users.user_id = ?";

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
