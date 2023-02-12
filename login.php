
<?php
require('db.php');

session_start();

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $user_id = checkUserExists($_POST['login'], $_POST['password']);
    if ($user_id) {
        $_SESSION['user_id'] = $user_id;  
        $_SESSION['profile_id'] = htmlspecialchars($_POST['login']);  
        $profiles = returnUserProfiles($user_id);
        $_SESSION['profiles_list'] = $profiles;

        if (is_array($profiles)) {
            $_SESSION['profiles'] = count($profiles);

            echo "Pustak";
        } else {
            $_SESSION['profiles'] = 0;
            echo "Pustal2";
        }
        if ($profiles) {
            for($i = 0; $i < count($profiles); $i++){
                $_SESSION["profile_id_" . $i] = $profiles[$i];
            }
        }
    } else {
        $error = 'Nieprawidłowe dane logowania';
        echo $error;
    }
}

