<?php
function connectToDbUsers() {
    $servername = "127.0.0.1";
    $username = "bartek";
    $password = "gymsitedb321";
    $dbname = "gymsite_users";

    // Tworzenie połączenia
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
    }
    return $conn;
}

function checkUserExists($username, $password) {

    $conn = connectToDbUsers();

    // Hashowanie nazwy użytkownika
    $hashed_username = hash('sha256', $username);

    // Zabezpieczanie danych wprowadzanych przez użytkownika
    $username_check = mysqli_real_escape_string($conn, $hashed_username);
    $password_check = mysqli_real_escape_string($conn, $password);

    // Zmiana zapytania do bazy danych, aby sprawdzać tylko nazwę użytkownika
    $query = "SELECT id, username, password FROM accounts WHERE username = '$username_check'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Weryfikacja hasła za pomocą funkcji password_verify()
        if (password_verify($password_check, $row['password'])) {
            $id = $row["id"];
            echo $id;
            return $id;
        } else {
            return false;
        }
    } else {
        return false;
    }    
}


function connectToDb() {
    $servername = "127.0.0.1";
    $username = "bartek";
    $password = "gymsitedb321";
    $dbname = "gymsitedatabase_final3";

    // Tworzenie połączenia
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Sprawdzanie połączenia
    if (!$conn) {
    die("Połączenie nieudane: " . mysqli_connect_error());
    }
    return $conn;
}

function returnUserProfiles($user_id) {

    $conn = connectToDb();

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
?>