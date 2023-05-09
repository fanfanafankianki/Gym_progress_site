<?php
function redirectToWelcomePage() {
    header("Location: /php_functions/welcome.php");
    exit;
}


function redirectToLoggedPage() {
    header("Location: /php_functions/logged.php");
    exit;
}
?>
