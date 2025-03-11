<?php
// Activer l'affichage des erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$servername = "localhost";
$username = "gestion_user";
$password = "passer123";
$dbname = "plateforme";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si un ID de client est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les données actuelles du client
    $sql = "SELECT * FROM clients WHERE id = $id";
    $result = $conn->query($sql);
    $client = $result->fetch_assoc();
}

// Vérifier si le formulaire de modification est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Mettre à jour les données du client
    $sql = "UPDATE clients SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Client modifié avec succès.";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

$conn->close();
?>

<!-- Formulaire de modification du client -->
<form method="POST" action="">
    <label for="name">Nom :</label><br>
    <input type="text" id="name" name="name" value="<?php echo $client['name']; ?>" required><br><br>
    
    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email" value="<?php echo $client['email']; ?>" required><br><br>
    
    <label for="phone">Téléphone :</label><br>
    <input type="text" id="phone" name="phone" value="<?php echo $client['phone']; ?>" required><br><br>
    
    <label for="address">Adresse :</label><br>
    <textarea id="address" name="address" required><?php echo $client['address']; ?></textarea><br><br>
    
    <input type="submit" value="Modifier le client">
</form>
