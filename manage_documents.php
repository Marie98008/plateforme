<?php
// Inclure la configuration de la base de données
include 'config.php';

// Gérer l'upload de documents
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    // Récupérer les informations du formulaire
    $title = $_POST['title'];
    
    // Vérifier si un fichier a été téléchargé
    if ($_FILES['file']['error'] == 0) {
        // Récupérer les informations du fichier
        $file_name = $_FILES['file']['name'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        
        // Définir le répertoire de destination pour les fichiers uploadés
        $upload_dir = "documents/"; // Le répertoire où les fichiers seront stockés
        $file_path = $upload_dir . basename($file_name);
        
        // Vérifier si le fichier est déplacé correctement
        if (move_uploaded_file($file_tmp_name, $file_path)) {
            // Préparer la requête SQL pour insérer le document dans la base de données
            $sql = "INSERT INTO documents (title, file_name, file_path, file_type, file_size, upload) 
                    VALUES ('$title', '$file_name', '$file_path', '$file_type', '$file_size', '/$file_path')";
            
            // Exécuter la requête SQL
            if ($conn->query($sql) === TRUE) {
                echo "Le document a été ajouté avec succès.";
            } else {
                echo "Erreur: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Erreur lors du déplacement du fichier.";
        }
    } else {
        echo "Aucun fichier n'a été téléchargé.";
    }
}

// Gérer la suppression d'un document
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Récupérer le chemin du fichier à supprimer
    $sql = "SELECT file_path FROM documents WHERE id = $delete_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = $row['file_path'];
        
        // Supprimer le fichier du répertoire
        if (unlink($file_path)) {
            // Supprimer l'entrée dans la base de données
            $sql = "DELETE FROM documents WHERE id = $delete_id";
            if ($conn->query($sql) === TRUE) {
                echo "Le document a été supprimé avec succès.";
            } else {
                echo "Erreur lors de la suppression du document dans la base de données.";
            }
        } else {
            echo "Erreur lors de la suppression du fichier.";
        }
    }
}

// Récupérer les documents existants
$result = $conn->query("SELECT * FROM documents");
?>

<!-- Formulaire d'upload de documents -->
<h2>Ajouter un document</h2>
<form action="manage_documents.php" method="POST" enctype="multipart/form-data">
    <label for="title">Titre du document:</label>
    <input type="text" name="title" id="title" required><br><br>
    
    <label for="file">Sélectionner un fichier:</label>
    <input type="file" name="file" id="file" required><br><br>
    
    <input type="submit" value="Téléverser">
</form>

<!-- Affichage de la liste des documents -->
<h2>Liste des documents</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Type</th>
        <th>Taille</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row["id"] ?></td>
        <td><a href="<?= $row["file_path"] ?>" target="_blank"><?= $row["file_name"] ?></a></td>
        <td><?= $row["file_type"] ?></td>
        <td><?= round($row["file_size"] / 1024, 2) ?> Ko</td>
        <td><?= $row["uploaded_at"] ?></td>
        <td>
            <a href="manage_documents.php?delete_id=<?= $row["id"] ?>" 
               onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?')">Supprimer</a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>

