<?php
// Inclure le fichier de connexion à la base de données
include('../../../configs/databaseconnect.php');

// Vérifier si l'identifiant du département est passé en paramètre
if (isset($_GET['departementId'])) {
    $departementId = $_GET['departementId'];

    // Requête pour récupérer les communes correspondant à l'identifiant du département
    $sqlCommunes = "SELECT * FROM communes WHERE FkDepartements = $departementId";
    $resultCommunes = $DB->query($sqlCommunes);
    $resultCommunes = $resultCommunes->fetchAll();

    if (count($resultCommunes) > 0) {
        // Générer les options pour les communes
        foreach ($resultCommunes as $commune) {
            echo '<option value="' . $commune['idCommunes'] . '">' . $commune['name'] . '</option>';
        }
    } else {
        echo '<option value="">Aucune commune trouvée</option>';
    }
}
?>
