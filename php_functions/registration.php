<?php
require('db.php');
if(isset($_POST['submitRegistration'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = connectToDbUsers();

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

    // Tworzenie połączenia
    $conn2 = connectToDb();

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