<?php
session_start();
require('db.php');
function selectTrainingsByProfileId($profile_id) {
  $conn = connectToDb();
  $user_id = $_SESSION['user_id'];
  $query = "SELECT Trainings.training_id, Trainings.training_name
  FROM Trainings
  INNER JOIN UserProfiles ON Trainings.profile_id = UserProfiles.profile_id
  INNER JOIN Users ON Userprofiles.user_id = Users.user_id
  WHERE UserProfiles.profile_id = ? AND Users.user_id = ? ";
  
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "ii", $profile_id, $user_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  while ($record = mysqli_fetch_assoc($result)) {
    $training_id = $record["training_id"];
    $training_name = $record["training_name"];
    echo "<a onclick='showTrainingWithExercisesDetails(" . $training_id . ")' href='#' class='css-bar-item css-button'>" . $training_name . "</a><br>";
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

}

$profile_id = $_POST["profile_id"];
selectTrainingsByProfileId($profile_id);
?>
