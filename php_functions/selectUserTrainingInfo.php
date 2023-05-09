<?php
function select_user_training_info($profile_id) {
  $conn = connectToDb();
  $query = "SELECT userprofiles.profile_id, userprofiles.profile_name, trainings.training_id, trainings.training_name
  FROM userprofiles
  JOIN trainings ON userprofiles.profile_id = trainings.profile_id
  WHERE userprofiles.profile_id = $profile_id";

  $query2="SELECT userprofiles.profile_id, userprofiles.profile_name FROM userprofiles WHERE userprofiles.profile_id = $profile_id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows(mysqli_query($conn, $query)) == 0) {
    $result = mysqli_query($conn, $query2);
    $record = mysqli_fetch_assoc($result);
    $profile_id = $record["profile_id"];
    $profile_name = $record["profile_name"];
    echo "<script>document.addEventListener('DOMContentLoaded', function() {createUserElement('$profile_id', '$profile_name');});</script>";
  } else {
    $training_names = array();
    while($record = mysqli_fetch_assoc($result)) {
      $profile_id = $record["profile_id"];
      $profile_name = $record["profile_name"];
      $training_ids[] = $record["training_id"];
      $training_names[] = $record["training_name"];
    }
    echo "<script>document.addEventListener('DOMContentLoaded', function() {createUserElement('$profile_id', '$profile_name', " . json_encode($training_names) . ", " . json_encode($training_ids) . ");});</script>";
  }
  $conn->close();
} 
?>