<?php
// Inclure le fichier de connexion à la base de données
include_once 'config.php';

// Vérifier si l'identifiant de l'étudiant est fourni dans la requête GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Identifiant d'étudiant non valide.";
    exit();
}

$id = $_GET['id'];

// Supprimer l'étudiant de la base de données
$query = "DELETE FROM students WHERE id = $id";
if (mysqli_query($conn, $query)) {
    echo "Étudiant supprimé avec succès.";
} else {
    echo "Erreur lors de la suppression de l'étudiant.";
}

// Redirection vers la page d'accueil
header("Location: index.php");
exit();
?>
