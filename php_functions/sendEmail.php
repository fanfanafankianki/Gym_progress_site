<?php
require('redirection.php');
if(isset($_POST['submitEmail'])) {
    // odbierz dane z formularza
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $subject = $_POST['Subject'];
    $message = $_POST['Message'];

    // ustaw odbiorcę i temat wiadomości
    $to = "bartosz.grzegorczyk97@gmail.com";
    $subject = "Nowa wiadomość od $name: $subject";

    // utwórz treść wiadomości
    $body = "Od: $name\nE-mail: $email\nWiadomość:\n$message";

    //ustawienie naglowkow
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Return-Path: $email\r\n";

    //wysylanie maila z parametrem -f
    if (mail($to, $subject, $body, $headers, "-f$email")) {
        echo "Wiadomość została wysłana!";
    } else {
        echo "Wystąpił błąd podczas wysyłania wiadomości.";
    }


}
redirectToWelcomePage();
?>
