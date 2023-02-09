
<?php



require('db.php');

session_start();

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    if (checkUserExists($_POST['login'], $_POST['password'])) {
        $_SESSION['profile_id'] = htmlspecialchars($_POST['login']);  
    } else {
        $error = 'Nieprawidłowe dane logowania';
        echo $error;
    }
}

header("Location: http://localhost/Gym_Site/index.php");   
