<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            // Paramètres SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Utilisez le serveur SMTP de Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'votre_email@gmail.com';  // Remplacez par votre adresse email
            $mail->Password = 'votre_mot_de_passe';  // Remplacez par votre mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Paramètres de l'email
            $mail->setFrom($email, $name);
            $mail->addAddress('destinataire@example.com');  // Remplacez par l'email du destinataire
            $mail->isHTML(false);
            $mail->Subject = "Nouveau message de $name";
            $mail->Body    = "Nom: $name\nEmail: $email\nMessage:\n$message";

            // Envoyer l'email
            $mail->send();
            echo "L'email a bien été envoyé!";
        } catch (Exception $e) {
            echo "Erreur : L'email n'a pas pu être envoyé. Erreur PHPMailer: {$mail->ErrorInfo}";
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}
?>
