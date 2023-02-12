<?php
function connectToDb() {
  $servername = "127.0.0.1";
  $username = "bartek";
  $password = "gymsitedb321";
  $dbname = "gymsitedatabase_final3";

  // Tworzenie połączenia
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Sprawdzanie połączenia
  if (!$conn) {
    die("Połączenie nieudane: " . mysqli_connect_error());
  }
  return $conn;
}

function getTrainingsByUserId($profile_id) {
  $conn = connectToDb();
  $query = "SELECT Trainings.training_id, Trainings.training_name
  FROM Trainings
  INNER JOIN UserProfiles ON Trainings.profile_id = UserProfiles.profile_id
  WHERE UserProfiles.profile_id = $profile_id";
  $result = mysqli_query($conn, $query);
  $trainingData = "";  
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

