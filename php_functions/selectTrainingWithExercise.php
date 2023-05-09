<?php
session_start();
require('db.php');

$training_id = $_POST['training_id'];
$conn = connectToDb();
$user_id = $_SESSION['user_id'];
$query = "SELECT trainingwithexercises.*, trainings.training_name, 
exercises1.exercise_id AS exercise_id1, exercises1.exercise_name AS exercise_name1, 
exercises2.exercise_id AS exercise_id2, exercises2.exercise_name AS exercise_name2, 
exercises3.exercise_id AS exercise_id3, exercises3.exercise_name AS exercise_name3, 
exercises4.exercise_id AS exercise_id4, exercises4.exercise_name AS exercise_name4, 
exercises5.exercise_id AS exercise_id5, exercises5.exercise_name AS exercise_name5, 
exercises6.exercise_id AS exercise_id6, exercises6.exercise_name AS exercise_name6, 
exercises7.exercise_id AS exercise_id7, exercises7.exercise_name AS exercise_name7, 
exercises8.exercise_id AS exercise_id8, exercises8.exercise_name AS exercise_name8, 
exercises9.exercise_id AS exercise_id9, exercises9.exercise_name AS exercise_name9
FROM trainingwithexercises
JOIN trainings ON trainingwithexercises.training_id = trainings.training_id
JOIN userprofiles ON trainings.profile_id = userprofiles.profile_id    
JOIN users ON userprofiles.user_id = users.user_id  
JOIN exercises AS exercises1 ON trainingwithexercises.exercise_1 = exercises1.exercise_id
JOIN exercises AS exercises2 ON trainingwithexercises.exercise_2 = exercises2.exercise_id
JOIN exercises AS exercises3 ON trainingwithexercises.exercise_3 = exercises3.exercise_id
LEFT JOIN exercises AS exercises4 ON trainingwithexercises.exercise_4 = exercises4.exercise_id
LEFT JOIN exercises AS exercises5 ON trainingwithexercises.exercise_5 = exercises5.exercise_id
LEFT JOIN exercises AS exercises6 ON trainingwithexercises.exercise_6 = exercises6.exercise_id
LEFT JOIN exercises AS exercises7 ON trainingwithexercises.exercise_7 = exercises7.exercise_id
LEFT JOIN exercises AS exercises8 ON trainingwithexercises.exercise_8 = exercises8.exercise_id
LEFT JOIN exercises AS exercises9 ON trainingwithexercises.exercise_9 = exercises9.exercise_id
WHERE trainings.training_id = ? AND users.user_id = ?
";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ii", $training_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
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

mysqli_stmt_close($stmt);
$conn->close();
?>
