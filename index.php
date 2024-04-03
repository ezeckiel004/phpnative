<?php
// Inclure le fichier de connexion à la base de données
include_once 'config.php';

// Récupérer la liste des étudiants depuis la base de données
$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
        }
        .action-links a {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des étudiants</h1>
        <table>
            <tr>
                <th>Nom</th>
                <th>Age</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td class="action-links">
                    <a href="view.php?id=<?php echo $row['id']; ?>">Voir</a>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Modifier</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">Supprimer</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <a href="add.php">Ajouter un étudiant</a>
    </div>
</body>
</html>
