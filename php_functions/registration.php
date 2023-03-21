<?php
require('db.php');
session_start();
if(isset($_POST['submitRegistration'])) {
    $_SESSION['error_registration']="";
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
            $error_registration = "Błąd podczas rejestracji: " . mysqli_error($conn2);
            $_SESSION['error_registration'] = $error_registration;  
            echo $error_registration;
        }

        mysqli_close($conn2);

    } else {
        echo "Błąd podczas rejestracji: " . mysqli_error($conn);
        $error_registration = "Błąd podczas rejestracji: Nazwa użytkownika nie może być dłuższa niż 20 znaków. Email musi być unikalny. Hasło nie może być dłuższe niz 20 znaków.";
        $_SESSION['error_registration'] = $error_registration;  
        echo $error_registration;
    }

    mysqli_close($conn);
}
header("Location: http://localhost/Gym_Site/welcome.php");    
?>