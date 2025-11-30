<?php
// Assurez-vous d'inclure la classe de connexion à la base de données ici
require_once("../../../configs/databaseconnect.php");

// Fonction pour générer un numéro de carte membre unique

    $prefix = "ANO"; // Préfixe du numéro de carte membre

    // Générer un nombre aléatoire unique de 6 chiffres (entre 000000 et 999999)
    do {
        $uniqueNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $memberCardNumber = $prefix . $uniqueNumber;

        // Vérifier si le numéro de carte membre est déjà utilisé dans la base de données
        $stmt = $DB->query("SELECT idMembers FROM members WHERE numeroCarteMembre = ?", array($memberCardNumber));
        $stmt->fetch();
        $rowCount = $stmt->rowCount();

    } while ($rowCount > 0); // Répéter la génération jusqu'à obtenir un numéro unique

    echo ($memberCardNumber);