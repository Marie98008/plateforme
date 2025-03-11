<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Inclure le fichier de configuration (connexion à la base de données)
include('config.php');

// Vérification de l'action : Ajouter un client
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "add") {
    // Récupérer les valeurs du formulaire et les sécuriser
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);

    // Requête SQL pour insérer le client dans la base de données
    $sql = "INSERT INTO clients (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";

    // Exécution de la requête
    if ($conn->query($sql) === TRUE) {
        echo "<p>Client ajouté avec succès !</p>";
    } else {
        echo "<p>Erreur : " . $conn->error . "</p>";
    }
}

// Vérification de l'action : Suppression d'un client
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // Requête pour supprimer un client
    $sql = "DELETE FROM clients WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Client supprimé avec succès !</p>";
    } else {
        echo "<p>Erreur lors de la suppression : " . $conn->error . "</p>";
    }
}

// Requête pour récupérer tous les clients
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Clients</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h1 class="mt-5">Gestion des Clients</h1>

    <!-- Formulaire d'ajout de client -->
    <h2>Ajouter un client</h2>
    <form method="POST" action="manage_clients.php">
        <input type="hidden" name="action" value="add">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Téléphone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adresse</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

    <!-- Liste des clients -->
    <h2 class="mt-5">Liste des Clients</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>Nom</th><th>Email</th><th>Téléphone</th><th>Adresse</th><th>Actions</th></tr></thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
            echo "<td>
                    <a href='edit_client.php?id=" . $row['id'] . "' class='btn btn-warning'>Modifier</a>
                    <a href='manage_clients.php?delete_id=" . $row['id'] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce client ?\");' class='btn btn-danger'>Supprimer</a>
                  </td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>Aucun client trouvé.</p>";
    }
    ?>

</body>
</html>

