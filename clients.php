<?php
include('config.php');

// Vérification de la suppression du client
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $sql = "DELETE FROM clients WHERE id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Client supprimé avec succès !</p>";
    } else {
        echo "<p>Erreur lors de la suppression : " . $conn->error . "</p>";
    }
}

// Récupérer les clients
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h1 class="mt-5">Liste des clients</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                    echo "<td>
                            <a href='clients.php?delete_id=" . $row['id'] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce client ?\");' class='btn btn-danger'>Supprimer</a>
                            <a href='edit_client.php?id=" . $row['id'] . "' class='btn btn-warning ml-2'>Modifier</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Aucun client trouvé.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="add_client.php" class="btn btn-success mt-3">Ajouter un client</a>
</body>
</html>

