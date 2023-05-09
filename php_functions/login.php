<?php
require('db.php');
require('redirection.php');

session_start();

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    echo "Coś tu nie trybi1: " . $user_id
    $user_id = checkUserExists($_POST['login'], $_POST['password']);
    if ($user_id) {
        echo "Coś tu nie trybi2: " . $user_id
        $_SESSION['user_id'] = $user_id;  
        echo "Coś tu nie trybi3: " . $_SESSION['user_id']
        $_SESSION['profile_id'] = htmlspecialchars($_POST['login']);  
        $profiles = returnUserProfiles($user_id);
        $_SESSION['profiles_list'] = $profiles;
        echo "Coś tu nie trybi4: " . $_SESSION['user_id']
        if (is_array($profiles)) {
            $_SESSION['profiles'] = count($profiles);
        } else {
            $_SESSION['profiles'] = 0;
        }
        if ($profiles) {
            for($i = 0; $i < count($profiles); $i++){
                $_SESSION["profile_id_" . $i] = $profiles[$i];
            }
        }
        header("Location: /logged.php");   
    } else {
        $error = 'Nieprawidłowe dane logowania';
        $_SESSION['error_login'] = $error;  
        header("Location: /welcome.php");   
    }
}

?>
