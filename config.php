<?php
$host = "localhost";
$user = "gestion_user";  // Remplace par ton utilisateur MySQL
$password = "passer123";  // Remplace par ton mot de passe
$dbname = "plateforme";  // Nom de la base de données

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>
