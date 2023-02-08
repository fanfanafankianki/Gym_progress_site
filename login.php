<?php

require_once('db.php');

session_start();
echo "321";
if (!empty($_POST['login']) && !empty($_POST['password']))
	echo "321";
{
    if ($_POST['login'] == USERNAME)
    {
        if ($_POST['password'] == PASSWORD)
        {
			echo "3213";
            $_SESSION['profile_id'] = htmlspecialchars($_POST['login']);  
		} else {
    $error = 'Nieprawidłowe dane logowania1';
	echo $error;
		}
    } else {
    $error = 'Nieprawidłowe dane logowania22';
	}
}

header("Location: http://localhost/Gym_Site/index.php");    
 