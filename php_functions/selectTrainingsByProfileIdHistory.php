<?php
session_start();
require('db.php');

function selectTrainingsByProfileId($profile_id) {
    $conn = connectToDb();
    $user_id = $_SESSION['user_id'];
    $query = "SELECT trainings.training_id, trainings.training_name
    FROM trainings
    INNER JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
    INNER JOIN users ON userprofiles.user_id = users.user_id
    WHERE userprofiles.profile_id = ? AND users.user_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $profile_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($record = $result->fetch_assoc()) {
        $training_id = $record["training_id"];
        $training_name = $record["training_name"];
        echo "<a onclick='loadTrainingHistoryTableDiv(" . $profile_id ."," . $training_id . ")' href='#' class='css-bar-item css-button'>" . $training_name . "</a><br>";
    }

    $stmt->close();
    $conn->close();
}

$profile_id = $_POST["profile_id"];
selectTrainingsByProfileId($profile_id);
?>
