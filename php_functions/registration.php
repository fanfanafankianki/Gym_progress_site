<?php
require('db.php');
session_start();
if(isset($_POST['submitRegistration'])) {
    $_SESSION['error_registration']="";
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hashowanie hasła, loginu i emaila
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $hashed_username = hash('sha256', $username);
    $hashed_email = hash('sha256', $email);

    $conn = connectToDbUsers();

    // Wstawianie danych do bazy danych
    $sql = "INSERT INTO accounts (username, email, password)
    VALUES ('$hashed_username', '$hashed_email', '$hashed_password')";

    if (mysqli_query($conn, $sql)) {
        echo "Użytkownik zarejestrowany pomyślnie";
        
        // Tworzenie połączenia
        $conn2 = connectToDb();

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
