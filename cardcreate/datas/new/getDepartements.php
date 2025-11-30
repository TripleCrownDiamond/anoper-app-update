<?php
// Inclure le fichier de connexion à la base de données
include('../../../configs/databaseconnect.php');

// Requête pour récupérer tous les départements
$sqlDepartements = "SELECT * FROM departements";
$resultDepartements = $DB->query($sqlDepartements);
$resultDepartements = $resultDepartements->fetchAll();

if (count($resultDepartements) > 0) {
    // Générer les options pour les départements
    foreach ($resultDepartements as $departement) {
        echo '<option value="' . $departement['idDepartements'] . '">' . $departement['name'] . '</option>';
    }
} else {
    echo '<option value="">Aucun département trouvé</option>';
}
?>

