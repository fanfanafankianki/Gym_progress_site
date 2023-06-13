<?php
session_start();
require('redirection.php');
unset($_SESSION['user']);
session_destroy();
redirectToWelcomePage();
?>