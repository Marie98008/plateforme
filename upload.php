<?php
// Connexion à la base de données
$host = 'localhost';
$user = 'gestion_user';
$password = 'passer123'; // Remplace par ton mot de passe MySQL si nécessaire
$dbname = 'plateforme';

$conn = new mysqli($host, $user, $password, $dbname);

// Vérifier la connexion à la base de données
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérification si un fichier a été soumis
if (isset($_POST['submit'])) {
    // Vérifier si un fichier a bien été téléchargé
    if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
        // Obtenir les informations sur le fichier
        $fileTmpPath = $_FILES['document']['tmp_name'];
        $fileName = $_FILES['document']['name'];
        $fileSize = $_FILES['document']['size'];
        $fileType = $_FILES['document']['type'];
        
        // Définir le répertoire de destination pour le fichier
        $uploadDir = '/var/www/html/plateforme/documents/';
        
        // Créer un nom unique pour éviter les conflits
        $fileDest = $uploadDir . uniqid('', true) . '_' . $fileName;

        // Vérifier que le fichier est bien une extension autorisée
        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'application/msword'];
        if (!in_array($fileType, $allowedTypes)) {
            echo "Erreur : type de fichier non autorisé.";
            exit;
        }

        // Vérifier la taille du fichier (exemple : maximum 5 Mo)
        if ($fileSize > 5 * 1024 * 1024) {
            echo "Erreur : fichier trop volumineux.";
            exit;
        }

        // Déplacer le fichier vers le répertoire de destination
        if (move_uploaded_file($fileTmpPath, $fileDest)) {
            // Enregistrer les informations dans la base de données
            $stmt = $conn->prepare("INSERT INTO documents (file_name, file_path, file_size, file_type, upload) VALUES (?, ?, ?, ?, ?)");
            $uploadPath = $fileDest; // Le chemin du fichier téléchargé sur le serveur

            // Lier les paramètres
            $stmt->bind_param("ssiss", $fileName, $fileDest, $fileSize, $fileType, $uploadPath);

            if ($stmt->execute()) {
                echo "Le fichier a été téléchargé et ajouté à la base de données avec succès !";
            } else {
                echo "Erreur lors de l'ajout du fichier à la base de données.";
            }
            $stmt->close();
        } else {
            echo "Erreur lors de l'upload du fichier.";
        }
    } else {
        echo "Aucun fichier n'a été téléchargé ou une erreur est survenue.";
    }
}
$conn->close();
?>
