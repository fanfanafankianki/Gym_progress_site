<?php
require('db.php');
function getTrainingsByUserId($profile_id) {
  $conn = connectToDb();
  $query = "SELECT Trainings.training_id, Trainings.training_name
  FROM Trainings
  INNER JOIN UserProfiles ON Trainings.profile_id = UserProfiles.profile_id
  WHERE UserProfiles.profile_id = $profile_id";
  $result = mysqli_query($conn, $query);

  while ($record = mysqli_fetch_assoc($result)) {
    $training_id = $record["training_id"];
    $training_name = $record["training_name"];
    echo "<a onclick='showTrainingWithExercisesDetails(" . $training_id . ")' href='#' class='css-bar-item css-button'>" . $training_name . "</a><br>";
  }
  mysqli_close($conn);

}

$profile_id = $_POST["profile_id"];
getTrainingsByUserId($profile_id);
?>