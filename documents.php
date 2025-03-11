<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Documents</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ajoute un fichier CSS si nécessaire -->
</head>
<body>

    <h2>📂 Gestion des Documents</h2>

    <!-- Formulaire d'upload -->
    <form action="add_document.php" method="post" enctype="multipart/form-data">
        <input type="file" name="document" required>
        <button type="submit">Uploader</button>
    </form>

    <hr>

    <!-- Liste des documents -->
    <h3>📜 Liste des Documents</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Type</th>
            <th>Taille</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM documents");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td><a href='" . $row["chemin"] . "' target='_blank'>" . $row["nom"] . "</a></td>";
            echo "<td>" . $row["type"] . "</td>";
            echo "<td>" . round($row["taille"] / 1024, 2) . " KB</td>";
            echo "<td>" . $row["date_upload"] . "</td>";
            echo "<td><a href='delete_document.php?id=" . $row["id"] . "' onclick='return confirm(\"Supprimer ce document ?\");'>🗑️ Supprimer</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>
