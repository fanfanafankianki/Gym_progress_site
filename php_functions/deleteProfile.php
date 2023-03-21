<?php
session_start();
require('db.php');

function deleteProfile($profile_id) {
    $conn = connectToDb();
    $user_id = $_SESSION['user_id'];

    // Get a list of unique training ids associated with the profile
    $stmt = $conn->prepare("SELECT training_id FROM trainings WHERE profile_id = ?");
    $stmt->bind_param("i", $profile_id);
    $stmt->execute();
    $trainings_result = $stmt->get_result();
    $trainings = array();
    while ($row = $trainings_result->fetch_assoc()) {
        $trainings[] = $row['training_id'];
    }

    // Get a list of unique exercise ids associated with the profile
    $exercise_ids = array();
    foreach ($trainings as $training_id) {
        $stmt = $conn->prepare("SELECT exercise_1, exercise_2, exercise_3, exercise_4, exercise_5, exercise_6, exercise_7, exercise_8, exercise_9 FROM trainingwithexercises WHERE training_id = ?");
        $stmt->bind_param("i", $training_id);
        $stmt->execute();
        $exercises_result = $stmt->get_result();
        while ($row = $exercises_result->fetch_assoc()) {
            for ($i = 1; $i <= 9; $i++) {
                $exercise_id = $row['exercise_' . $i];
                if (!is_null($exercise_id) && !in_array($exercise_id, $exercise_ids)) {
                    $exercise_ids[] = $exercise_id;
                }
            }
        }
    }

    // Delete records from the trainingdetails table
    $stmt = $conn->prepare("DELETE td FROM trainingdetails td
                            JOIN traininghistory th ON td.training_history_id = th.training_history_id
                            JOIN trainingwithexercises twe ON th.training_with_exercises_id = twe.training_with_exercises_id
                            WHERE twe.training_id IN (SELECT training_id FROM trainings WHERE profile_id = ?)");
    $stmt->bind_param("i", $profile_id);
    $stmt->execute();

    // Delete records from the traininghistory table
    $stmt = $conn->prepare("DELETE th FROM traininghistory th
                            JOIN trainingwithexercises twe ON th.training_with_exercises_id = twe.training_with_exercises_id
                            WHERE twe.training_id IN (SELECT training_id FROM trainings WHERE profile_id = ?)");
    $stmt->bind_param("i", $profile_id);
    $stmt->execute();

    // Delete records from the trainingwithexercises table
    $stmt = $conn->prepare("DELETE FROM trainingwithexercises WHERE training_id IN (SELECT training_id FROM trainings WHERE profile_id = ?)");
    $stmt->bind_param("i", $profile_id);
    $stmt->execute();

    // Delete records from the trainings table
    $stmt = $conn->prepare("DELETE FROM trainings WHERE profile_id = ?");
    $stmt->bind_param("i", $profile_id);
    $stmt->execute();

    // Delete records from the exercises table
    $exercise_ids_str = implode(',', $exercise_ids);
    if (!empty($exercise_ids_str)) {
        $stmt = $conn->prepare("DELETE FROM exercises WHERE exercise_id IN (" . $exercise_ids_str . ")");
        $stmt->execute();
    }

    // Delete the profile record from the userprofiles table
    $stmt = $conn->prepare("DELETE FROM userprofiles WHERE profile_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $profile_id, $user_id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $_SESSION['profiles'] -= 1;
        $profiles = returnUserProfiles($user_id);
        if ($profiles) {
            for($i = 0; $i < count($profiles); $i++){
                $_SESSION["profile_id_" . $i] = $profiles[$i];
            }
        }    
        echo "Profile and related data have been successfully deleted.";
    } else {
        echo "Error deleting profile: " . $conn->error;
        echo mysqli_error($conn);
        echo $conn;
    }

    $stmt->close();
    $conn->close();
}

$profile_id = $_POST["profile_id"];
deleteProfile($profile_id);
?>  
