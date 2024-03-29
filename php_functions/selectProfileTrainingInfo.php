<?php
function select_profile_training_info($profile_id) {
  $conn = connectToDb();
  $user_id = $_SESSION['user_id'];
  $query = "SELECT userprofiles.profile_id, userprofiles.profile_name, trainings.training_id, trainings.training_name
  FROM userprofiles
  JOIN trainings ON userprofiles.profile_id = trainings.profile_id
  JOIN users ON userprofiles.user_id = users.user_id
  WHERE userprofiles.profile_id = ? AND users.user_id = ?";

  $query2="SELECT userprofiles.profile_id, userprofiles.profile_name FROM userprofiles WHERE userprofiles.profile_id = ?";
  
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "ii", $profile_id, $user_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) == 0) {
    mysqli_stmt_close($stmt);
    $stmt2 = mysqli_prepare($conn, $query2);
    mysqli_stmt_bind_param($stmt2, "i", $profile_id);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
    $record = mysqli_fetch_assoc($result2);
    $profile_id = $record["profile_id"];
    $profile_name = $record["profile_name"];
    echo "<script>document.addEventListener('DOMContentLoaded', function() {createUserElement('$profile_id', '$profile_name');});</script>";
    mysqli_stmt_close($stmt2);
  } else {
    $training_names = array();
    $training_ids = array();
    while($record = mysqli_fetch_assoc($result)) {
      $profile_id = $record["profile_id"];
      $profile_name = $record["profile_name"];
      $training_ids[] = $record["training_id"];
      $training_names[] = $record["training_name"];
    }
    echo "<script>document.addEventListener('DOMContentLoaded', function() {createUserElement('$profile_id', '$profile_name', " . json_encode($training_names) . ", " . json_encode($training_ids) . ");});</script>";
    mysqli_stmt_close($stmt);
  }
  $conn->close();
} 
?>
