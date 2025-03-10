<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
 include 'config.php'; ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>plateforme - Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h1 class="mt-5">Bienvenue sur la plateforme SmartTech</h1>
    <a href="employees.php" class="btn btn-primary mt-3">Gérer les employés</a>
    <a href="manage_clients.php" class="btn btn-secondary mt-3">Gérer les clients</a>
    <a href="manage_documents.php" class="btn btn-info mt-3">Gérer les documents</a>
</body>
</html>
