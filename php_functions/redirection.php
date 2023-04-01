<?php
function redirectToWelcomePage() {
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/welcome.php";
    header("Location: $url");
    exit;
}


function redirectToLoggedPage() {
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/logged.php";
    header("Location: $url");
    exit;
}
?>
