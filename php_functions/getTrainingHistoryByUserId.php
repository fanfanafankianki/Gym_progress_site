<?php
require('db.php');
function getTrainingHistoryByUserId($profile_id) {
  $conn = connectToDb();
  $query = "SELECT traininghistory.*, userprofiles.profile_id,  FROM traininghistory INNER JOIN trainingwithexercises ON traininghistory.training_with_exercises_id = trainingwithexercises.training_with_exercises_id INNER JOIN trainings ON trainingwithexercises.training_id = trainings.training_id INNER JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id WHERE userprofiles.profile_id = $profile_id and user= ten cos sie zalogował";
  $result = mysqli_query($conn, $query);
  $traininghistoryData = "";
  while ($record = mysqli_fetch_assoc($result)) {
    $training_history_id = $record["training_history_id"];
    $training_with_exercises_id = $record["training_with_exercises_id"];
    $training_date = $record["training_date"];
    $profile_id = $record["profile_id"];
	echo "<a onclick='showtraininghistoryDetails(" . $training_history_id . ")' href='#' class='css-bar-item css-button'>Trening: " . $training_date . "</a><br>";
  }
  mysqli_close($conn);
}

$profile_id = $_POST["profile_id"];
gettraininghistoryByUserId($profile_id);
?>

