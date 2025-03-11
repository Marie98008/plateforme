<?php
// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$servername = "localhost";
$username = "gestion_user";  // Remplacez par votre utilisateur MySQL
$password = "passer123";      // Remplacez par votre mot de passe MySQL
$dbname = "plateforme";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données envoyées depuis le formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Requête pour insérer un nouveau client dans la table
    $sql = "INSERT INTO clients (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
        echo "<h3>Client ajouté avec succès !</h3>";
        echo "<p><a href='add_client.php'>Ajouter un autre client</a></p>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Client</title>
</head>
<body>

    <h2>Ajouter un Client</h2>

    <!-- Formulaire d'ajout d'un client -->
    <form action="add_client.php" method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Téléphone :</label>
        <input type="text" id="phone" name="phone"><br><br>

        <label for="address">Adresse :</label>
        <textarea id="address" name="address"></textarea><br><br>

        <input type="submit" value="Ajouter le client">
    </form>

</body>
</html>

