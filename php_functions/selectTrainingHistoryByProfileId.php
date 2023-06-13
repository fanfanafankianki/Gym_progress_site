<?php
session_start();
require('db.php');

function selectTrainingHistoryByProfileId($profile_id, $training_id) {
    $conn = connectToDb();
    $user_id = $_SESSION['user_id'];
    $query = "SELECT traininghistory.*, userprofiles.profile_id 
    FROM traininghistory 
    INNER JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id 
    INNER JOIN trainings ON trainingwithexercises.training_id = trainings.training_id 
    INNER JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id 
    JOIN users ON userprofiles.user_id = users.user_id 
    WHERE userprofiles.profile_id = ? AND users.user_id = ? AND trainings.training_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $profile_id, $user_id, $training_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($record = $result->fetch_assoc()) {
        $training_history_id = $record["training_history_id"];
        $training_with_exercises_id = $record["training_with_exercises_id"];
        $training_date = $record["training_date"];
        $profile_id = $record["profile_id"];
        echo "<a onclick='showTrainingHistoryDetails(" . $training_history_id . ")' href='#' class='css-bar-item css-button'>Training with date: " . $training_date . "</a><br>";
    }

    $stmt->close();
    $conn->close();
}

$profile_id = $_POST["profile_id"];
$training_id = $_POST["training_id"];
selecttraininghistoryByProfileId($profile_id, $training_id);
?>
