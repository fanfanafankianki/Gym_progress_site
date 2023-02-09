
<?php

$servername = "127.0.0.1";
$username = "bartek";
$password = "gymsitedb321";
$dbname = "gymsite_users";

// Tworzenie połączenia
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
}

function checkUserExists($username, $password) {
    global $conn;

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}