<?php
function redirectToWelcomePage() {
    header("Location: /welcome.php");
    exit;
}


function redirectToLoggedPage() {
    header("Location: /logged.php");
    exit;
}
?>
