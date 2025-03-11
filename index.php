<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
include 'config.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme - Accueil</title>
    <!-- Lien vers Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fa;
        }

        .hero {
            background: linear-gradient(135deg, #6f42c1, #007bff);
            color: white;
            padding: 40px 0;
            text-align: center;
            border-radius: 10px;
            margin-top: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .btn-custom {
            border-radius: 30px;
            padding: 12px 30px;
            font-size: 1.1rem;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            text-align: center;
        }

        .card-body h5 {
            color: #007bff;
            font-size: 1.3rem;
            font-weight: 600;
        }

        footer {
            background-color: #2f2f2f;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 50px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <!-- Section Héro -->
    <section class="hero">
        <h1>Bienvenue sur la plateforme SmartTech</h1>
        <p class="lead">La gestion facile et rapide de vos employés, clients et documents à portée de main !</p>
    </section>

    <!-- Section principale avec les liens -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Gérer les employés</h5>
                        <a href="employees.php" class="btn btn-primary btn-custom">Accéder</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Gérer les clients</h5>
                        <a href="manage_clients.php" class="btn btn-secondary btn-custom">Accéder</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Gérer les documents</h5>
                        <a href="manage_documents.php" class="btn btn-info btn-custom">Accéder</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 SmartTech - Tous droits réservés</p>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
