<?php
session_start();
require_once './functions.php'; // Fichier contenant vos fonctions utilitaires
require_once '../configs/databaseconnect.php'; // Fichier de connexion à la base de données

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Accès non autorisé.']);
    exit;
}

// Vérifiez si l'ID du membre est fourni
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID du membre non spécifié.']);
    exit;
}

$memberId = (int) $_GET['id'];

try {
    // Connexion à la base de données
    $DB = new connexionDB(); // Utilisez votre classe de connexion

    // Vérifiez si le membre existe
    $stmt = $DB->query("SELECT * FROM members WHERE idMembers = :id LIMIT 1", [':id' => $memberId]);
    $member = $stmt->fetch();

    if (!$member) {
        echo json_encode(['status' => 'error', 'message' => 'Membre introuvable.']);
        exit;
    }

    // Mettez à jour le champ `archived` à 1
    $update = $DB->query("UPDATE members SET archived = 1 WHERE idMembers = :id", [':id' => $memberId]);

    if ($update) {
        echo json_encode(['status' => 'success', 'message' => 'Membre archivé avec succès.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Impossible d\'archiver le membre.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'archivage : ' . $e->getMessage()]);
}
?>
