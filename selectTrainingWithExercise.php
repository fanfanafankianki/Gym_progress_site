<?php
function connectToDb() {
  $servername = "127.0.0.1";
  $username = "bartek";
  $password = "gymsitedb321";
  $dbname = "gymsitedatabase_final";

  // Tworzenie połączenia
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Sprawdzanie połączenia
  if (!$conn) {
    exit("Połączenie nieudane: " . mysqli_connect_error());
  }
  return $conn;
}

$training_id = $_POST['training_id'];
$conn = connectToDb();
$query = "SELECT TrainingWithExercises.*, Trainings.training_name, Exercises1.exercise_name AS exercise_name1, Exercises2.exercise_name AS exercise_name2, Exercises3.exercise_name AS exercise_name3, Exercises4.exercise_name AS exercise_name4, Exercises5.exercise_name AS exercise_name5, Exercises6.exercise_name AS exercise_name6, Exercises7.exercise_name AS exercise_name7, Exercises8.exercise_name AS exercise_name8, Exercises9.exercise_name AS exercise_name9
FROM TrainingWithExercises
JOIN Trainings ON TrainingWithExercises.training_id = Trainings.training_id
JOIN Exercises AS Exercises1 ON TrainingWithExercises.exercise_1 = Exercises1.exercise_id
JOIN Exercises AS Exercises2 ON TrainingWithExercises.exercise_2 = Exercises2.exercise_id
JOIN Exercises AS Exercises3 ON TrainingWithExercises.exercise_3 = Exercises3.exercise_id
LEFT JOIN Exercises AS Exercises4 ON TrainingWithExercises.exercise_4 = Exercises4.exercise_id
LEFT JOIN Exercises AS Exercises5 ON TrainingWithExercises.exercise_5 = Exercises5.exercise_id
LEFT JOIN Exercises AS Exercises6 ON TrainingWithExercises.exercise_6 = Exercises6.exercise_id
LEFT JOIN Exercises AS Exercises7 ON TrainingWithExercises.exercise_7 = Exercises7.exercise_id
LEFT JOIN Exercises AS Exercises8 ON TrainingWithExercises.exercise_8 = Exercises8.exercise_id
LEFT JOIN Exercises AS Exercises9 ON TrainingWithExercises.exercise_9 = Exercises9.exercise_id
WHERE Trainings.training_id = $training_id;
";

$result = mysqli_query($conn, $query);
$record = mysqli_fetch_assoc($result);
$training_with_exercises_id = $record["training_with_exercises_id"];
$exercise_1 = $record["exercise_1"];
$exercise_2 = $record["exercise_2"];
$exercise_3 = $record["exercise_3"];
$training_name = $record["training_name"];
$exercise_name1 = $record["exercise_name1"];
$exercise_name2 = $record["exercise_name2"];
$exercise_name3 = $record["exercise_name3"];
echo "training_name: " . $training_name . "<br>";
echo "Training With Exercises ID: " . $training_with_exercises_id . "<br>";
echo "Training training_id: " . $training_id . "<br>";
echo "exercise_1 1: " . $exercise_1 . " Repetitions 1: " . $exercise_name1 . "<br>";
echo "exercise_1 2: " . $exercise_2 . " Repetitions 2: " . $exercise_name2 . "<br>";
echo "exercise_1 3: " . $exercise_3 . " Repetitions 3: " . $exercise_name3 . "<br>";

echo "</table>";

$conn->close();