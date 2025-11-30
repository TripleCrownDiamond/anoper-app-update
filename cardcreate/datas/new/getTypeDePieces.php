<?php
// Inclure le fichier de connexion à la base de données
include('../../../configs/databaseconnect.php');

// Requête pour récupérer tous les types de pièces d'identité
$sqlTypesPieces = "SELECT * FROM type_piece_identite";
$resultTypesPieces = $DB->query($sqlTypesPieces);
$resultTypesPieces = $resultTypesPieces->fetchAll();

if (count($resultTypesPieces) > 0) {
    // Générer les options pour les types de pièces d'identité
    foreach ($resultTypesPieces as $typePiece) {
        echo '<option value="' . $typePiece['id'] . '">' . $typePiece['type'] . '</option>';
    }
} else {
    echo '<option value="">Aucun type de pièce d\'identité trouvé</option>';
}
?>
