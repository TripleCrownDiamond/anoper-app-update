<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (!isset($_SESSION["user_id"])) {
    // Rediriger vers la page "index.php" si l'utilisateur n'est pas connecté
    header("Location: ../login/");
    exit();
}

// Détruire toutes les données de session
session_destroy();

// Rediriger vers la page "index.php" après la déconnexion
header("Location: index.php");
exit();
?>
