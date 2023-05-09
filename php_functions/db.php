<?php
function connectToDbUsers() {
    $servername = "a8deb6bd07ece40f4bf671a23b79a6db-1396431802.eu-west-1.elb.amazonaws.com:3306";
    $username = "bartek";
    $password = "dbpass2";
    $dbname = "pwrtrckr_users";

    // Tworzenie połączenia
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
    }

    return $conn;
}


function connectToDb() {
    $servername = "a8deb6bd07ece40f4bf671a23b79a6db-1396431802.eu-west-1.elb.amazonaws.com:3306";
    $username = "bartek";
    $password = "dbpass2";
    $dbname = "pwrtrckr_profiles";

    // Tworzenie połączenia
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Sprawdzanie połączenia
    if (!$conn) {
    die("Połączenie nieudane: " . mysqli_connect_error());
    }
    return $conn;
}

function checkUserExists($username, $password) {
    $conn = connectToDbUsers();

    // Hashowanie nazwy użytkownika
    $hashed_username = hash('sha256', $username);

    // Using prepared statements to protect against SQL injection
    $query = "SELECT id, username, password FROM accounts WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $hashed_username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $db_username, $db_password);

        if (mysqli_stmt_fetch($stmt)) {
            // Weryfikacja hasła za pomocą funkcji password_verify()
            if (password_verify($password, $db_password)) {
                mysqli_stmt_close($stmt);
                return $id;
            } else {
                mysqli_stmt_close($stmt);
                return false;
            }
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    } else {
        echo "Błąd przygotowania zapytania: " . mysqli_error($conn);
        return false;
    }

    mysqli_close($conn);
}

function returnUserProfiles($user_id) {
    $conn = connectToDb();

    if (!$conn) {
        die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
    }

    // Użycie instrukcji przygotowanych do zabezpieczenia zapytania SQL
    $query = "SELECT profile_id FROM UserProfiles WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $profiles = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $profiles[] = $row["profile_id"];
            }
            mysqli_stmt_close($stmt);
            return $profiles;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    } else {
        echo "Błąd przygotowania zapytania: " . mysqli_error($conn);
        return false;
    }

    mysqli_close($conn);
}
?>
