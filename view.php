<?php
include_once 'config.php';

$id = $_GET['id'];

$query = "SELECT * FROM students WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de l'étudiant</title>
</head>
<body>
    <h1>Détail de l'étudiant</h1>
    <p>Nom: <?php echo $row['name']; ?></p>
    <p>Age: <?php echo $row['age']; ?></p>
    <p>Email: <?php echo $row['email']; ?></p>
    <p>Adresse: <?php echo $row['address']; ?></p>
</body>
</html>
