<?php
session_start();
require('db.php');

function selectTrainingHistoryByProfileId($profile_id, $training_id) {
    $conn = connectToDb();
    $user_id = $_SESSION['user_id'];
    $query = "SELECT TrainingHistory.*, UserProfiles.profile_id 
    FROM TrainingHistory 
    INNER JOIN TrainingWithExercises ON TrainingHistory.training_with_exercises_id = TrainingWithExercises.training_with_exercises_id 
    INNER JOIN Trainings ON TrainingWithExercises.training_id = Trainings.training_id 
    INNER JOIN UserProfiles ON Trainings.profile_id = UserProfiles.profile_id 
    JOIN Users ON userprofiles.user_id = users.user_id 
    WHERE UserProfiles.profile_id = ? AND users.user_id = ? AND Trainings.training_id = ?";

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
selectTrainingHistoryByProfileId($profile_id, $training_id);
?>
