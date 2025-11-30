<?php
// Ajouter l'en-tête HTTP pour désactiver la mise en cache
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// ... le reste du code pour récupérer et afficher les options des arrondissements ...

// Inclure le fichier de connexion à la base de données
include('../../../configs/databaseconnect.php');

// Vérifier si l'identifiant de la commune est passé en paramètre
if (isset($_GET['communeId'])) {
    $communeId = $_GET['communeId'];

    // Requête pour récupérer les arrondissements correspondant à l'identifiant de la commune
    $sqlArrondissements = "SELECT * FROM arrondissements WHERE FkCommunes = $communeId";
    $resultArrondissements = $DB->query($sqlArrondissements);
    $resultArrondissements = $resultArrondissements->fetchAll();

    if (count($resultArrondissements) > 0) {
        // Générer les options pour les arrondissements
        foreach ($resultArrondissements as $arrondissement) {
            echo '<option value="' . $arrondissement['idArrondissements'] . '">' . $arrondissement['name'] . '</option>';
        }        
    } else {
        echo '<option value="">Aucun arrondissement trouvé</option>';
    }
}
?>
