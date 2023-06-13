<?php
require('db.php');
function getTrainingsByUserId($profile_id) {
  $conn = connectToDb();
  $query = "SELECT trainings.training_id, trainings.training_name
  FROM trainings
  INNER JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id
  WHERE userprofiles.profile_id = $profile_id";
  $result = mysqli_query($conn, $query);

  while ($record = mysqli_fetch_assoc($result)) {
    $training_id = $record["training_id"];
    $training_name = $record["training_name"];
    echo "<a onclick='showTrainingWithExercisesDetails(" . $training_id . ")' href='#' class='css-bar-item css-button'>" . $training_name . "</a><br>";
  }
  mysqli_close($conn);

}

$profile_id = $_POST["profile_id"];
gettrainingsByUserId($profile_id);
?>