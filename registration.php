<?php
if(isset($_POST['submitRegistration'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $servername = "127.0.0.1";
    $usernameDB = "bartek";
    $passwordDB = "gymsitedb321";
    $dbname = "gymsite_users";
    
    // Tworzenie połączenia
    $conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);
    if (!$conn) {
        die("Połączenie nieudane: " . mysqli_connect_error());
    }

    // Hashowanie hasła
    //$password = password_hash($password, PASSWORD_DEFAULT);

    // Wstawianie danych do bazy danych
    $sql = "INSERT INTO accounts (username, email, password)
    VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "Użytkownik zarejestrowany pomyślnie";
    } else {
        echo "Błąd podczas rejestracji: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    $username2 = $_POST['username'];
    $email2 = $_POST['email'];
    $password2 = $_POST['password'];

    $servername2 = "127.0.0.1";
    $usernameDB2 = "bartek";
    $passwordDB2 = "gymsitedb321";
    $dbname2 = "gymsitedatabase_final3";
    
    // Tworzenie połączenia
    $conn2 = mysqli_connect($servername2, $usernameDB2, $passwordDB2, $dbname2);
    if (!$conn2) {
        die("Połączenie nieudane: " . mysqli_connect_error());
    }

    // Hashowanie hasła
    //$password = password_hash($password, PASSWORD_DEFAULT);

    // Wstawianie danych do bazy danych
    $sql = "INSERT INTO users (user_name)
    VALUES ('$username')";

    if (mysqli_query($conn2, $sql)) {
        echo "Użytkownik dodany pomyślnie";
    } else {
        echo "Błąd podczas rejestracji: " . mysqli_error($conn2);
    }

    mysqli_close($conn2);

}
header("Location: http://localhost/Gym_Site/index.php");
?>