<?php
include 'config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Récupérer le chemin du fichier avant de le supprimer
    $stmt = $conn->prepare("SELECT chemin FROM documents WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($chemin);
    $stmt->fetch();
    $stmt->close();

    if (file_exists($chemin)) {
        unlink($chemin); // Supprimer le fichier
    }

    // Supprimer l'entrée dans la base de données
    $stmt = $conn->prepare("DELETE FROM documents WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "Document supprimé avec succès !";
    header("Location: manage_documents.php");
}
?>
