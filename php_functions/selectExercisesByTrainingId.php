<?php
session_start();
require('db.php');

function selectExercisesByTrainingId($training_id) {
    $conn = connectToDb();
    $user_id = $_SESSION['user_id'];
    $query = "SELECT Exercises.exercise_name, Exercises.exercise_id
    FROM Exercises
    JOIN TrainingWithExercises ON TrainingWithExercises.exercise_1 = Exercises.exercise_id
     OR TrainingWithExercises.exercise_2 = Exercises.exercise_id
     OR TrainingWithExercises.exercise_3 = Exercises.exercise_id
     OR TrainingWithExercises.exercise_4 = Exercises.exercise_id
     OR TrainingWithExercises.exercise_5 = Exercises.exercise_id
     OR TrainingWithExercises.exercise_6 = Exercises.exercise_id
     OR TrainingWithExercises.exercise_7 = Exercises.exercise_id
     OR TrainingWithExercises.exercise_8 = Exercises.exercise_id
     OR TrainingWithExercises.exercise_9 = Exercises.exercise_id
    JOIN Trainings ON TrainingWithExercises.training_id = trainings.training_id
    JOIN userprofiles ON Trainings.profile_id = userprofiles.profile_id
    JOIN Users ON userprofiles.user_id = users.user_id
    WHERE TrainingWithExercises.training_id = ? AND users.user_id = ?";

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
