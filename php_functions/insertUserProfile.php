<?php
function insertUserProfile($profile_name_to_add, $user_id) {
  $conn = connectToDb();

  // Zapytanie SQL
  $sql = "INSERT INTO userprofiles(profile_name, user_id) VALUES (?, ?)";

  // Prepare the statement
  $stmt = mysqli_prepare($conn, $sql);

  if ($stmt) {
    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "si", $profile_name_to_add, $user_id);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
      $counter = 0;
      for($i = 0; $i < $_SESSION['profiles']; $i++){ 
          $counter++;
      }
      $profile_id = mysqli_stmt_insert_id($stmt);
      $_SESSION["profile_id_" . $counter] = $profile_id;
      $_SESSION['profiles']++;
      $counter++;
    } else {
      echo "Błąd podczas dodawania rekordu: " . mysqli_stmt_error($stmt);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

  } else {
    echo "Błąd podczas przygotowania zapytania: " . mysqli_error($conn);
  }

  // Zamykanie połączenia
  mysqli_close($conn);
  echo "<script>reloadSite()</script>";
}

if (isset($_POST['add_profile'])) {
  $profile_name = $_POST['text'];
  insertUserProfile($profile_name, $_SESSION['user_id']);

}
?>
