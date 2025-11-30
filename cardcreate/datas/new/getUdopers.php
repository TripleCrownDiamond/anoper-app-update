<?php
// Inclure le fichier de connexion à la base de données
include('../../../configs/databaseconnect.php');

// Requête pour récupérer toutes les UDOPER
$sqlUdopers = "SELECT * FROM udopers";
$resultUdopers = $DB->query($sqlUdopers);
$resultUdopers = $resultUdopers->fetchAll();

if (count($resultUdopers) > 0) {
    // Générer les options pour les UDOPER
    foreach ($resultUdopers as $udoper) {
        echo '<option value="' . $udoper['idUdopers'] . '">' . $udoper['name'] . '</option>';
    }
} else {
    echo '<option value="">Aucune UDOPER trouvée</option>';
}
?>
