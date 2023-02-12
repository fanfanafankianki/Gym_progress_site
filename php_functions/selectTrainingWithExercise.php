<?php
require('db.php');

$training_id = $_POST['training_id'];
$conn = connectToDb();
$query = "SELECT TrainingWithExercises.*, Trainings.training_name, 
Exercises1.exercise_id AS exercise_id1, Exercises1.exercise_name AS exercise_name1, 
Exercises2.exercise_id AS exercise_id2, Exercises2.exercise_name AS exercise_name2, 
Exercises3.exercise_id AS exercise_id3, Exercises3.exercise_name AS exercise_name3, 
Exercises4.exercise_id AS exercise_id4, Exercises4.exercise_name AS exercise_name4, 
Exercises5.exercise_id AS exercise_id5, Exercises5.exercise_name AS exercise_name5, 
Exercises6.exercise_id AS exercise_id6, Exercises6.exercise_name AS exercise_name6, 
Exercises7.exercise_id AS exercise_id7, Exercises7.exercise_name AS exercise_name7, 
Exercises8.exercise_id AS exercise_id8, Exercises8.exercise_name AS exercise_name8, 
Exercises9.exercise_id AS exercise_id9, Exercises9.exercise_name AS exercise_name9
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
$records = [];
while ($record = mysqli_fetch_assoc($result)) {
    $training = [
	    'training_with_exercises_id' => $record['training_with_exercises_id'],
        'training_name' => $record['training_name'],
        'exercises' => [],
        'exercise_id' => []
    ];
    for ($i = 1; $i <= 9; $i++) {
        if ($record['exercise_name' . $i]) {
            $training['exercises'][] = $record['exercise_name' . $i];
        }
		if ($record['exercise_id' . $i]) {
            $training['exercise_id'][] = $record['exercise_id' . $i];
        }
    }
    $records[] = $training;
}

echo json_encode($records);

$conn->close();
?>