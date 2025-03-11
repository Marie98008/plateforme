<?php
$to = "admin@plateforme.sn";
$subject = "Test Email via PHP";
$message = "Ceci est un test d'envoi d'e-mail via PHP mail().";
$headers = "From: support@plateforme.sn";

if (mail($to, $subject, $message, $headers)) {
    echo "E-mail envoyé avec succès.";
} else {
    echo "Échec de l'envoi de l'e-mail.";
}
?>
