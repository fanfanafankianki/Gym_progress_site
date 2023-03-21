<?php
function insertUserProfile($profile_name_to_add, $user_id) {
  $conn = connectToDb();

  // Zapytanie SQL
  $sql = "INSERT INTO userProfiles(profile_name, user_id) VALUES ('$profile_name_to_add', '$user_id')";

  if (mysqli_query($conn, $sql)) {
    $counter = 0;
    for($i = 0; $i < $_SESSION['profiles']; $i++){ 
        $counter++;
    }
    $profile_id = mysqli_insert_id($conn);
    $_SESSION["profile_id_" . $counter] = $profile_id;
    $_SESSION['profiles']++;
    $counter++;
  } else {
    echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
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