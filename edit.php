<?php
include_once 'config.php';

// Vérifier si l'identifiant de l'étudiant est fourni dans la requête GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Identifiant d'étudiant non valide.";
    exit();
}

$id = $_GET['id'];

// Récupérer les données de l'étudiant à modifier
$query = "SELECT * FROM students WHERE id = $id";
$result = mysqli_query($conn, $query);

// Vérifier si l'étudiant existe
if (mysqli_num_rows($result) == 0) {
    echo "Étudiant non trouvé.";
    exit();
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et valider les données de l'étudiant
    $name = trim($_POST['name']);
    $age = intval($_POST['age']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    if (empty($name) || empty($age) || empty($email) || empty($address)) {
        echo "Tous les champs sont requis.";
        exit();
    }

    // Mettre à jour les données de l'étudiant dans la base de données
    $update_query = "UPDATE students SET name='$name', age=$age, email='$email', address='$address' WHERE id = $id";
    if (mysqli_query($conn, $update_query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'étudiant.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un étudiant</title>
</head>
<body>
    <h1>Modifier un étudiant</h1>
    <form method="post" action="">
        <label for="name">Nom:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>"><br><br>
        <label for="age">Âge:</label><br>
        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($row['age']); ?>"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"><br><br>
        <label for="address">Adresse:</label><br>
        <textarea id="address" name="address"><?php echo htmlspecialchars($row['address']); ?></textarea><br><br>
        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>
