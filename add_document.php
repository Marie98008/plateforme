<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["document"])) {
    $nom_fichier = $_FILES["document"]["name"];
    $type_fichier = $_FILES["document"]["type"];
    $taille_fichier = $_FILES["document"]["size"];
    $chemin_fichier = "uploads/" . basename($nom_fichier);

    if (move_uploaded_file($_FILES["document"]["tmp_name"], $chemin_fichier)) {
        $sql = "INSERT INTO documents (nom, type, taille, chemin) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $nom_fichier, $type_fichier, $taille_fichier, $chemin_fichier);
        $stmt->execute();
        echo "Fichier téléchargé avec succès !";
    } else {
        echo "Erreur lors de l'upload.";
    }
}
?>

<form action="add_document.php" method="post" enctype="multipart/form-data">
    <input type="file" name="document" required>
    <button type="submit">Uploader</button>
</form>
