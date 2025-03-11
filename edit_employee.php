<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM employees WHERE id=$id");
    $employee = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];

    $sql = "UPDATE employees SET name='$name', email='$email', position='$position' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: employees.php");
    } else {
        echo "Erreur : " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Employé</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h2 class="mt-5">Modifier un Employé</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $employee['id'] ?>">
        <input type="text" name="name" class="form-control mt-2" value="<?= $employee['name'] ?>" required>
        <input type="email" name="email" class="form-control mt-2" value="<?= $employee['email'] ?>" required>
        <input type="text" name="position" class="form-control mt-2" value="<?= $employee['position'] ?>" required>
        <button type="submit" class="btn btn-success mt-3">Modifier</button>
    </form>
</body>
</html>
