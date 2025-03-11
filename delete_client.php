<?php
// Connexion à la base de données
$servername = "localhost";
$username = "gestion_user";
$password = "passer123";
$dbname = "plateforme";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si un ID de client est passé pour la suppression
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer le client
    $sql = "DELETE FROM clients WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Client supprimé avec succès.";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

$conn->close();
?>
