<?php
session_start();
require('db.php');

function selectExercisesByTrainingId($training_id) {
    $conn = connectToDb();
    $user_id = $_SESSION['user_id'];
    $query = "SELECT exercises.exercise_name, exercises.exercise_id
    FROM exercises
    JOIN trainingwithexercises ON trainingwithexercises.exercise_1 = exercises.exercise_id
     OR trainingwithexercises.exercise_2 = exercises.exercise_id
     OR trainingwithexercises.exercise_3 = exercises.exercise_id
     OR trainingwithexercises.exercise_4 = exercises.exercise_id
     OR trainingwithexercises.exercise_5 = exercises.exercise_id
     OR trainingwithexercises.exercise_6 = exercises.exercise_id
     OR trainingwithexercises.exercise_7 = exercises.exercise_id
     OR trainingwithexercises.exercise_8 = exercises.exercise_id
     OR trainingwithexercises.exercise_9 = exercises.exercise_id
    JOIN trainings ON trainingwithexercises.training_id = trainings.training_id
    JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
    JOIN users ON userprofiles.user_id = users.user_id
    WHERE trainingwithexercises.training_id = ? AND users.user_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $training_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($record = $result->fetch_assoc()) {
        $exercise_id = $record["exercise_id"];
        $exercise_name = $record["exercise_name"];
        echo "<a onclick='showExerciseDetailsChart(" . $exercise_id . ", " . $training_id . ")' href='#' class='css-bar-item css-button'>" . $exercise_name . "</a><br>";
    }
    $stmt->close();
    $conn->close();
}

$training_id = $_POST["training_id"];
selectExercisesByTrainingId($training_id);
?>
