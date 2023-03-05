<?php
echo "weszlem";
session_start();
unset($_SESSION['user']);
session_destroy();
header("Location: http://localhost/Gym_Site/index.php");
?>