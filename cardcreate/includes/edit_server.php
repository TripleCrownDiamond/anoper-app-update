<?php
// Connexion à la base de données et inclusion des fonctions nécessaires
require_once '../../configs/databaseconnect.php'; // Assurez-vous de mettre le bon chemin vers le fichier de connexion

// Vérifier si des données ont été envoyées en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $dateAdhesion = $_POST['dateAdhesion']; // Utilisez l'ID du champ unique ici

    // Récupérer l'ID du membre (peut-être à partir d'une session ou d'un paramètre d'URL)
    $memberId = $_POST['memberId']; // Changer "member_id" par la clé appropriée

    // Mettre à jour les données dans la base de données
    $DB = new connexionDB();
    $sql = "UPDATE members SET dateAdhesion = :dateAdhesion WHERE idMembers = :memberId";
    $stmt = $DB->query($sql, array('dateAdhesion' => $dateAdhesion, 'memberId' => $memberId));

    // Vérifier si la mise à jour a réussi
    if ($stmt) {
        $response = array('success' => true, 'message' => 'La date d\'adhésion a été mises à jour avec succès.');
    } else {
        $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour des informations.');
    }

    // Retourner la réponse au format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
