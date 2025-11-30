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
        $row = $stmt->fetch();
        $rowCount = $stmt->rowCount();

    } while ($rowCount > 0);

    return $memberCardNumber;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Pour débogage, afficher toutes les erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    try {
        // Récupération des données POST
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

        // Directoires de téléchargement
        $uploadDir = "../files/";
        $photoMembreDir = $uploadDir . "photo_membre/";
        $photoPieceIdentiteDir = $uploadDir . "photo_piece_identite/";
        $signatureScanDir = $uploadDir . "signature_scan/";

        // Créer les directoires s'ils n'existent pas
        if (!file_exists($photoMembreDir)) {
            mkdir($photoMembreDir, 0777, true);
        }
        if (!file_exists($photoPieceIdentiteDir)) {
            mkdir($photoPieceIdentiteDir, 0777, true);
        }
        if (!file_exists($signatureScanDir)) {
            mkdir($signatureScanDir, 0777, true);
        }

        // Génération des noms de fichiers uniques
        $photoMembreFileName = "photo_membre_" . uniqid() . "." . pathinfo($_FILES["photoMembre"]["name"], PATHINFO_EXTENSION);
        $photoPieceIdentiteFileName = "photo_piece_identite_" . uniqid() . "." . pathinfo($_FILES["photoPieceIdentite"]["name"], PATHINFO_EXTENSION);
        $signatureScanFileName = "signature_scan_" . uniqid() . "." . pathinfo($_FILES["signatureScan"]["name"], PATHINFO_EXTENSION);

        // Chemins complets des fichiers
        $photoMembrePath = $photoMembreDir . $photoMembreFileName;
        $photoPieceIdentitePath = $photoPieceIdentiteDir . $photoPieceIdentiteFileName;
        $signatureScanPath = $signatureScanDir . $signatureScanFileName;

        // Déplacement des fichiers uploadés
        if (!move_uploaded_file($_FILES["photoMembre"]["tmp_name"], $photoMembrePath)) {
            throw new Exception('Erreur lors du téléchargement de la photo du membre.');
        }
        if (!move_uploaded_file($_FILES["photoPieceIdentite"]["tmp_name"], $photoPieceIdentitePath)) {
            throw new Exception('Erreur lors du téléchargement de la photo de la pièce d\'identité.');
        }
        if (!move_uploaded_file($_FILES["signatureScan"]["tmp_name"], $signatureScanPath)) {
            throw new Exception('Erreur lors du téléchargement de la signature scannée.');
        }

        $compress = function($path) {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            if ($ext === 'jpg' || $ext === 'jpeg') {
                if (!function_exists('imagecreatefromjpeg')) return;
                $src = @imagecreatefromjpeg($path);
                if (!$src) return;
                $w = imagesx($src); $h = imagesy($src);
                $mw = 1200; $mh = 1200; $q = 80;
                $scale = min($mw / $w, $mh / $h);
                if ($scale < 1) {
                    $nw = (int)floor($w * $scale); $nh = (int)floor($h * $scale);
                    $dst = imagecreatetruecolor($nw, $nh);
                    imagecopyresampled($dst, $src, 0,0,0,0, $nw,$nh, $w,$h);
                    imagejpeg($dst, $path, $q);
                    imagedestroy($dst);
                } else {
                    imagejpeg($src, $path, $q);
                }
                imagedestroy($src);
            } elseif ($ext === 'png') {
                if (!function_exists('imagecreatefrompng')) return;
                $src = @imagecreatefrompng($path);
                if (!$src) return;
                imagesavealpha($src, true);
                $w = imagesx($src); $h = imagesy($src);
                $mw = 1200; $mh = 1200;
                $scale = min($mw / $w, $mh / $h);
                if ($scale < 1) {
                    $nw = (int)floor($w * $scale); $nh = (int)floor($h * $scale);
                    $dst = imagecreatetruecolor($nw, $nh);
                    imagealphablending($dst, false); imagesavealpha($dst, true);
                    imagecopyresampled($dst, $src, 0,0,0,0, $nw,$nh, $w,$h);
                    imagepng($dst, $path, 9);
                    imagedestroy($dst);
                } else {
                    imagepng($src, $path, 9);
                }
                imagedestroy($src);
            }
        };
        $compress($photoMembrePath);
        $compress($photoPieceIdentitePath);
        $compress($signatureScanPath);

        // Requête d'insertion pour un membre
        $query = "INSERT INTO members (
            dateAdhesion, idDepartement, idCommune, idArrondissement, idUdoper, village, 
            nom, prenom, dateNaissance, lieuNaissance, sexe, tel, idTypePieceIdentite, 
            numeroPiece, photoPieceIdentite, dateExpirationPieceIdentite, ovins, bovins, 
            caprins, photoMembre, signatureScan, qrCodePath, numeroCarteMembre, user_id
        ) VALUES (
            :dateAdhesion, :idDepartement, :idCommune, :idArrondissement, :idUdoper, :village, 
            :nom, :prenom, :dateNaissance, :lieuNaissance, :sexe, :tel, :idTypePieceIdentite, 
            :numeroPiece, :photoPieceIdentite, :dateExpirationPieceIdentite, :ovins, :bovins, 
            :caprins, :photoMembre, :signatureScan, :qrCodePath, :numeroCarteMembre, :user_id
        )";

        $data = array(
            "dateAdhesion" => $dateAdhesion,
            "idDepartement" => $departement,
            "idCommune" => $commune,
            "idArrondissement" => $arrondissement,
            "idUdoper" => $udoper,
            "village" => $village,
            "nom" => $nom,
            "prenom" => $prenom,
            "dateNaissance" => $dateNaissance,
            "lieuNaissance" => $lieuNaissance,
            "sexe" => $sexe,
            "tel" => $tel,
            "idTypePieceIdentite" => $typePieceIdentite,
            "numeroPiece" => $numeroPieceIdentite,
            "photoPieceIdentite" => $photoPieceIdentitePath,
            "dateExpirationPieceIdentite" => $dateExpirationPieceIdentite,
            "ovins" => $ovins,
            "bovins" => $bovins,
            "caprins" => $caprins,
            "photoMembre" => $photoMembrePath,
            "signatureScan" => $signatureScanPath,
            "qrCodePath" => 'NA', // Remplacement de 'NA'
            "numeroCarteMembre" => $memberCardNumber,
            "user_id" => $userId
        );

        $result = $DB->insert($query, $data);

        // Pour déboguer, affichez le contenu des variables
        error_log("SQL: $query");
        error_log("Data: " . print_r($data, true));
       
        if ($result) {
            echo json_encode(array("success" => true, "message" => "Les données ont été enregistrées avec succès dans la base de données."));
        } else {
            throw new Exception('Erreur lors de l\'enregistrement dans la base de données.');
        }
    } catch (PDOException $e) {
        error_log("PDOException: " . $e->getMessage());
        echo json_encode(array("success" => false, "message" => 'Erreur PDO : ' . $e->getMessage()));
    } catch (Exception $e) {
        error_log("Exception: " . $e->getMessage());
        echo json_encode(array("success" => false, "message" => $e->getMessage()));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Le serveur est injoignable. Veuillez réessayer plus tard."));
}
?>
