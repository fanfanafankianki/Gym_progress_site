
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

    $query = "SELECT id, username, password FROM accounts WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];
        echo $id;
        return $id;
    } else {
        return false;
    }    
}

function returnUserProfiles($user_id) {

    $servername = "127.0.0.1";
    $username = "bartek";
    $password = "gymsitedb321";
    $dbname = "gymsitedatabase_final3";

    // Tworzenie połączenia
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
    }

    $query = "SELECT profile_id
    FROM UserProfiles
    WHERE user_id = '$user_id';";
    $result = mysqli_query($conn, $query);
    $profiles = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $profiles[] = $row["profile_id"];
        }
        return $profiles;
    } else {
        return false;
    }
    
}
    


