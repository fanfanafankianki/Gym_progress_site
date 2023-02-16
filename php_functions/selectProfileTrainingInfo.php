<?php
function select_profile_training_info($profile_id) {
  $conn = connectToDb();
  $user_id = $_SESSION['user_id'];
  $query = "SELECT UserProfiles.profile_id, UserProfiles.profile_name, Trainings.training_id, Trainings.training_name
  FROM UserProfiles
  JOIN Trainings ON UserProfiles.profile_id = Trainings.profile_id
  JOIN Users ON UserProfiles.user_id = Users.user_id
  WHERE UserProfiles.profile_id = $profile_id AND Users.user_id = $user_id";

  $query2="SELECT UserProfiles.profile_id, UserProfiles.profile_name FROM UserProfiles WHERE UserProfiles.profile_id = $profile_id";
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