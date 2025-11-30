<?php
// Assurez-vous d'avoir une connexion à votre base de données 
require_once("../../../configs/databaseconnect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["member_id"])) {
    $memberId = $_POST["member_id"];
    
    
    // Vous pouvez ajouter ici le code pour supprimer le membre de votre base de données
    // Assurez-vous de gérer les erreurs et les cas de succès correctement

    // Exemple de code de suppression :
    $sql = $DB->query("DELETE FROM members WHERE idMembers = $memberId");

    // Ici, nous allons simplement renvoyer une réponse JSON simulée
    // Vous devrez ajuster cela en fonction de votre logique de suppression réelle
    $response = [
        "success" => true,
        "message" => "Le membre a été supprimé avec succès. Veuillez recharger la page"
    ];

    // Réponse JSON
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}

// Si le code arrive ici, cela signifie que la requête n'est pas une requête POST valide
// ou que le paramètre "member_id" n'a pas été fourni
// Vous pouvez ajouter ici un code de gestion des erreurs supplémentaire si nécessaire

$response = [
    "success" => false,
    "message" => "Requête invalide. Le membre n'a pas été supprimé."
];

// Réponse JSON
header("Content-Type: application/json");
echo json_encode($response);
