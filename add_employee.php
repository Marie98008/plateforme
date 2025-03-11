<?php
// Activer l'affichage des erreurs pour débogage
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
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    // Vérification que le salaire est un nombre
    if (empty($salary) || !is_numeric($salary)) {
        die("Le salaire est obligatoire et doit être un nombre.");
    }

    // Requête pour insérer un nouvel employé
    $sql = "INSERT INTO employees (name, position, salary) VALUES ('$name', '$position', '$salary')";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
        echo "<h3>Employé ajouté avec succès !</h3>";
        echo "<p><a href='add_employee.php'>Ajouter un autre employé</a></p>";
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
    <title>Ajouter un Employé</title>
</head>
<body>

    <h2>Ajouter un Employé</h2>

    <!-- Formulaire d'ajout d'employé -->
    <form action="add_employee.php" method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="position">Poste :</label>
        <input type="text" id="position" name="position" required><br><br>

        <label for="salary">Salaire :</label>
        <input type="number" id="salary" name="salary" step="0.01" required><br><br>

        <input type="submit" value="Ajouter l'employé">
    </form>

</body>
</html>


