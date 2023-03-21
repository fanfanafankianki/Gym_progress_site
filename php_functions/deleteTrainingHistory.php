<?php
session_start();
require('db.php');

function deleteTrainingHistory($training_history_id) {
  $conn = connectToDb();
  $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT * FROM userprofiles 
          INNER JOIN trainings ON userprofiles.profile_id = trainings.profile_id 
          INNER JOIN traininghistory ON trainings.training_id = traininghistory.training_with_exercises_id 
          WHERE userprofiles.user_id = ? AND traininghistory.training_history_id = ?");
  $stmt->bind_param("ii", $user_id, $training_history_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Usunięcie powiązanych rekordów z tabeli trainingdetails
    $stmt = $conn->prepare("DELETE FROM trainingdetails WHERE training_history_id = ?");
    $stmt->bind_param("i", $training_history_id);
    $stmt->execute();

    // Usunięcie rekordu z tabeli traininghistory
    $stmt = $conn->prepare("DELETE FROM traininghistory WHERE training_history_id = ?");
    $stmt->bind_param("i", $training_history_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      echo "Record deleted successfully";

    } else {
      echo "Error deleting record: " . $conn->error;
    }
  } else {
    echo "You don't have permission to delete this record";
  }
  
  $stmt->close();
  $conn->close();

}


$training_history_id = $_POST["training_history_id"];
deleteTrainingHistory($training_history_id);  
?>
