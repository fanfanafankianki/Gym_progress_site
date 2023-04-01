<?php
function redirectToWelcomePage() {
    $url = "http://localhost/welcome.php";
    header("Location: $url");
    exit;
}


function redirectToLoggedPage() {
    $url = "http://localhost/logged.php";
    header("Location: $url");
    exit;
}
?>
