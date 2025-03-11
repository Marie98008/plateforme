<?php
// Destinataire
$to = "utilisateur@example.com";  // L'adresse e-mail du destinataire

// Sujet de l'e-mail
$subject = "Confirmation d'inscription";

// Message de l'e-mail
$message = "Bienvenue sur notre plateforme ! Votre inscription a bien été confirmée.";

// En-têtes de l'e-mail
$headers = "From: webmaster@plateforme.sn\r\n";  // L'adresse de l'expéditeur (assure-toi que cette adresse existe sur ton serveur)

$headers .= "Reply-To: webmaster@plateforme.sn\r\n";  // L'adresse où les réponses doivent être envoyées
$headers .= "MIME-Version: 1.0\r\n";  // Version MIME
$headers .= "Content-type: text/html; charset=UTF-8\r\n";  // Si tu veux envoyer un e-mail HTML

// Envoi de l'e-mail
if (mail($to, $subject, $message, $headers)) {
    echo "E-mail envoyé avec succès.";
} else {
    echo "Une erreur s'est produite lors de l'envoi de l'e-mail.";
}
?>
