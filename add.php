<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un étudiant</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter un étudiant</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = []; // Tableau pour stocker les erreurs de validation

            // Récupérer les données du formulaire
            $name = trim($_POST['name']);
            $age = trim($_POST['age']);
            $email = trim($_POST['email']);
            $address = trim($_POST['address']);

            // Vérifier si les champs sont vides et ajouter des messages d'erreur correspondants
            if (empty($name)) {
                $errors['name'] = "Le champ Nom est requis.";
            }
            if (empty($age)) {
                $errors['age'] = "Le champ Âge est requis.";
            }
            if (empty($email)) {
                $errors['email'] = "Le champ Email est requis.";
            }
            if (empty($address)) {
                $errors['address'] = "Le champ Adresse est requis.";
            }

            // Vérifier si l'e-mail existe déjà
            include_once 'config.php';
            $check_query = "SELECT * FROM students WHERE email = '$email'";
            $check_result = mysqli_query($conn, $check_query);
            if (mysqli_num_rows($check_result) > 0) {
                $errors['email'] = "Cet e-mail existe déjà.";
            }

            // S'il y a des erreurs, les afficher
            if (!empty($errors)) {
                echo "<div class='error'>";
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo "</div>";
            } else {
                // Insérer les données dans la base de données
                $insert_query = "INSERT INTO students (name, age, email, address) VALUES ('$name', '$age', '$email', '$address')";
                if (mysqli_query($conn, $insert_query)) {
                    echo "<p>Étudiant ajouté avec succès.</p>";
                    // Réinitialiser les champs du formulaire
                    $name = $age = $email = $address = "";
                } else {
                    echo "<p>Une erreur s'est produite lors de l'ajout de l'étudiant.</p>";
                }
            }
        }
        ?>
        <form method="post" action="">
            <label for="name">Nom:</label><br>
            <input type="text" id="name" name="name" value="<?php if (isset($name)) echo htmlspecialchars($name); ?>"><br><br>
            <label for="age">Âge:</label><br>
            <input type="number" id="age" name="age" value="<?php if (isset($age)) echo htmlspecialchars($age); ?>"><br><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php if (isset($email)) echo htmlspecialchars($email); ?>"><br><br>
            <label for="address">Adresse:</label><br>
            <textarea id="address" name="address"><?php if (isset($address)) echo htmlspecialchars($address); ?></textarea><br><br>
            <input type="submit" value="Enregistrer">
        </form>

        <button onclick="window.location.href='index.php'">
            Retour
        </button>
    </div>
</body>
</html>
