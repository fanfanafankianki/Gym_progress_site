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
    header("Location: http://localhost/Gym_Site/index.php");
}

?>