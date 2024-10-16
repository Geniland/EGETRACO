<?php
// Activer les erreurs pour voir les problèmes potentiels
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validation simple pour s'assurer que les champs ne sont pas vides
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Adresse de destination de l'email
        $to = "genilandee@gamil.com";  // Remplacez par votre adresse email

        // Sujet de l'email
        $subject = "Nouveau message de $name";

        // Contenu de l'email
        $body = "Nom: $name\nEmail: $email\nMessage:\n$message";

        // En-têtes de l'email
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Envoyer l'email
        if (mail($to, $subject, $body, $headers)) {
            // Rediriger vers une page de succès si l'email est envoyé
            header('Location: contact.html');
            exit();
        } else {
            echo "Erreur : L'email n'a pas pu être envoyé.";
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
