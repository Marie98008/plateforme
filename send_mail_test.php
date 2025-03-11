<?php
$to = "destinataire@example.com";
$subject = "Test de l'envoi d'email";
$message = "Ceci est un test pour vérifier l'envoi d'e-mails avec PHP et iRedMail.";
$headers = "From: ton-email@plateforme.sn";

if (mail($to, $subject, $message, $headers)) {
    echo "L'e-mail a été envoyé avec succès!";
} else {
    echo "L'envoi de l'e-mail a échoué.";
}
?>
