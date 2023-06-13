<?php
session_start();
require('db.php');

function deleteTraining($training_id) {
  $conn = connectToDb();
  $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT * FROM userprofiles 
          INNER JOIN trainings ON userprofiles.profile_id = trainings.profile_id
          WHERE userprofiles.user_id = ? AND trainings.training_id = ?");
  $stmt->bind_param("ii", $user_id, $training_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Delete related records from the trainingdetails table
    $stmt = $conn->prepare("DELETE td FROM trainingdetails td
                            JOIN traininghistory th ON td.training_history_id = th.training_history_id
                            JOIN trainingwithexercises twe ON th.training_with_exercises_id = twe.training_with_exercises_id
                            WHERE twe.training_id = ?");
    $stmt->bind_param("i", $training_id);
    $stmt->execute();

    // Delete records from the traininghistory table
    $stmt = $conn->prepare("DELETE th FROM traininghistory th
                            JOIN trainingwithexercises twe ON th.training_with_exercises_id = twe.training_with_exercises_id
                            WHERE twe.training_id = ?");
    $stmt->bind_param("i", $training_id);
    $stmt->execute();

    // Delete records from the trainingwithexercises table
    $stmt = $conn->prepare("DELETE FROM trainingwithexercises WHERE training_id = ?");
    $stmt->bind_param("i", $training_id);
    $stmt->execute();

    // Delete record from the trainings table
    $stmt = $conn->prepare("DELETE FROM trainings WHERE training_id = ?");
    $stmt->bind_param("i", $training_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      echo "Training and related data have been successfully deleted.";
    } else {
      echo "Error deleting training: " . $conn->error;
    }
  } else {
    echo "You don't have permission to delete this training";
  }
  
  $stmt->close();
  $conn->close();
}

$training_id = $_POST["training_id"];
deleteTraining($training_id);
?>
