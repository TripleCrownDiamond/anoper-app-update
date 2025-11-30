<?php
session_start();
require_once("../../../configs/databaseconnect.php");

function generateMemberCardNumber($DB)
{
    $prefix = "ANO";
    do {
        $uniqueNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $memberCardNumber = $prefix . $uniqueNumber;

        $stmt = $DB->query("SELECT idMembers FROM members WHERE numeroCarteMembre = ?", array($memberCardNumber));
        $stmt->fetch();
        $rowCount = $stmt->rowCount();

    } while ($rowCount > 0);

    return $memberCardNumber;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dateAdhesion = $_POST["dateAdhesion"];
    $departement = $_POST["departement"];
    $commune = $_POST["commune"];
    $arrondissement = $_POST["arrondissement"];
    $udoper = $_POST["udoper"];
    $village = $_POST["village"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $dateNaissance = $_POST["dateNaissance"];
    $lieuNaissance = $_POST["lieuNaissance"];
    $sexe = $_POST["sexe"];
    $tel = $_POST["tel"];
    $typePieceIdentite = $_POST["typePieceIdentite"];
    $numeroPieceIdentite = !empty($_POST["numeroPieceIdentite"]) ? $_POST["numeroPieceIdentite"] : NULL;
    $dateExpirationPieceIdentite = $_POST["dateExpirationPieceIdentite"];
    $ovins = $_POST["ovins"];
    $bovins = $_POST["bovins"];
    $caprins = $_POST["caprins"];
    $memberCardNumber = generateMemberCardNumber($DB);
    $userId = $_SESSION['user_id'];

    $uploadDir = "../files/";
    $photoMembreDir = $uploadDir . "photo_membre/";
    $photoPieceIdentiteDir = $uploadDir . "photo_piece_identite/";
    $signatureScanDir = $uploadDir . "signature_scan/";

    if (!file_exists($photoMembreDir)) {
        mkdir($photoMembreDir, 0777, true);
    }
    if (!file_exists($photoPieceIdentiteDir)) {
        mkdir($photoPieceIdentiteDir, 0777, true);
    }
    if (!file_exists($signatureScanDir)) {
        mkdir($signatureScanDir, 0777, true);
    }

    $photoMembreFileName = "photo_membre_" . uniqid() . "." . pathinfo($_FILES["photoMembre"]["name"], PATHINFO_EXTENSION);
    $photoPieceIdentiteFileName = "photo_piece_identite_" . uniqid() . "." . pathinfo($_FILES["photoPieceIdentite"]["name"], PATHINFO_EXTENSION);
    $signatureScanFileName = "signature_scan_" . uniqid() . "." . pathinfo($_FILES["signatureScan"]["name"], PATHINFO_EXTENSION);

    $photoMembrePath = $photoMembreDir . $photoMembreFileName;
    $photoPieceIdentitePath = $photoPieceIdentiteDir . $photoPieceIdentiteFileName;
    $signatureScanPath = $signatureScanDir . $signatureScanFileName;

    move_uploaded_file($_FILES["photoMembre"]["tmp_name"], $photoMembrePath);
    move_uploaded_file($_FILES["photoPieceIdentite"]["tmp_name"], $photoPieceIdentitePath);
    move_uploaded_file($_FILES["signatureScan"]["tmp_name"], $signatureScanPath);

    $stmt = $DB->query("INSERT INTO members (dateAdhesion, idDepartement, idCommune, idArrondissement, idUdoper, village, nom, prenom, dateNaissance, lieuNaissance, sexe, tel, idTypePieceIdentite, numeroPiece, photoPieceIdentite, dateExpirationPieceIdentite, ovins, bovins, caprins, photoMembre, signatureScan, qrCodePath, numeroCarteMembre, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($dateAdhesion, $departement, $commune, $arrondissement, $udoper, $village, $nom, $prenom, $dateNaissance, $lieuNaissance, $sexe, $tel, $typePieceIdentite, $numeroPieceIdentite, $photoPieceIdentitePath, $dateExpirationPieceIdentite, $ovins, $bovins, $caprins, $photoMembrePath, $signatureScanPath, 'NA', $memberCardNumber, $userId));

    if ($stmt) {
        echo json_encode(array("success" => true, "message" => "Les données ont été enregistrées avec succès dans la base de données."));
    } else {
        echo json_encode(array("success" => false, "message" => "Erreur lors de l'enregistrement dans la base de données. Veuillez réessayer."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Le serveur est injoignable. Veuillez réessayer plus tard."));
}
?>
