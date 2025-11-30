<?php
// Connexion à la base de données et inclusion des fonctions nécessaires
require_once '../../../configs/databaseconnect.php';

// Vérifier si des données ont été envoyées en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialiser la réponse
    $response = array('success' => false, 'message' => 'Erreur inconnue.');

    // Récupérer l'ID du membre
    $memberId = $_POST['memberId'];

    // Si des données d'adhésion sont présentes
    if (isset($_POST['dateAdhesion'])) {
        $dateAdhesion = $_POST['dateAdhesion'];

        // Mettre à jour la date d'adhésion
        $DB = new connexionDB();
        $sql = "UPDATE members SET dateAdhesion = :dateAdhesion WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('dateAdhesion' => $dateAdhesion, 'memberId' => $memberId));

        if ($stmt) {
            $response = array('success' => true, 'message' => 'La date d\'adhésion a été mises à jour avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour des informations.');
        }
    }

    // Si des données de département, commune et arrondissement sont présentes
    if (isset($_POST['departement']) && isset($_POST['commune']) && isset($_POST['arrondissement'])) {
        $departement = $_POST['departement'];
        $commune = $_POST['commune'];
        $arrondissement = $_POST['arrondissement'];

        // Mettre à jour le département, la commune et l'arrondissement
        $DB = new connexionDB();
        $sql = "UPDATE members SET idDepartement = :departement, idCommune = :commune, idArrondissement = :arrondissement WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('departement' => $departement, 'commune' => $commune, 'arrondissement' => $arrondissement, 'memberId' => $memberId));

        if ($stmt) {
            $response = array('success' => true, 'message' => 'Département / Commune / Arrondissement modifiés avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour du département / commune / arrondissement.');
        }
    }

    if(isset($_POST['udoper'])) {
        // Récupérer l'UDOPER du formulaire
        $udoper = $_POST['udoper'];
    
        // Récupérer l'ID du membre (vous devrez probablement le faire via une session ou un autre mécanisme)
        // J'assume ici que l'ID du membre est transmis via le formulaire, mais cela pourrait nécessiter une adaptation selon votre mise en œuvre.
        $memberId = $_POST['memberId']; 
    
        // Mettre à jour l'UDOPER dans la base de données
        $DB = new connexionDB();
        $sql = "UPDATE members SET idUdoper = :udoper WHERE idMembers = :memberId"; 
        $stmt = $DB->query($sql, array('udoper' => $udoper, 'memberId' => $memberId));
    
        // Vérifier si la mise à jour a réussi
        if ($stmt) {
            $response = array('success' => true, 'message' => 'UDOPER modifié avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour de l\'UDOPER.');
        }
    }

    if(isset($_POST['village'])) {
        $village = $_POST['village'];
        $memberId = $_POST['memberId'];

        $DB = new connexionDB();

        $sql = "UPDATE members SET village = :village WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('village' => $village, 'memberId' => $memberId));

        if ($stmt) {
            $response = array('success' => true, 'message' => 'Le village a été mis à jour avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour du village.');
        }
    }

    if(isset($_POST['nom'])) {
        $nom = $_POST['nom'];
        $memberId = $_POST['memberId'];

        $DB = new connexionDB();

        $sql = "UPDATE members SET nom = :nom WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('nom' => $nom, 'memberId' => $memberId));

        if ($stmt) {
            $response = array('success' => true, 'message' => 'Le nom du membre a été mis à jour avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour du nom du membre.');
        }
    }

    if(isset($_POST['prenom'])) {
        $prenom = $_POST['prenom'];
        $memberId = $_POST['memberId'];

        $DB = new connexionDB();

        $sql = "UPDATE members SET prenom = :prenom WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('prenom' => $prenom, 'memberId' => $memberId));

        if ($stmt) {
            $response = array('success' => true, 'message' => 'Le prénom du membre a été mis à jour avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour du prénom du membre.');
        }
    }

    if(isset($_POST['dateNaissance'])) {
        $dateNaissance = $_POST['dateNaissance'];
        $memberId = $_POST['memberId'];

        $DB = new connexionDB();

        $sql = "UPDATE members SET dateNaissance = :dateNaissance WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('dateNaissance' => $dateNaissance, 'memberId' => $memberId));

        if ($stmt) {
            $response = array('success' => true, 'message' => 'La date de naissance a été mise à jour avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour de la date de naissance.');
        }

        
    }

    if(isset($_POST['lieuNaissance'])) {
        $lieuNaissance = $_POST['lieuNaissance'];
        $memberId = $_POST['memberId'];
    
        $DB = new connexionDB();
    
        $sql = "UPDATE members SET lieuNaissance = :lieuNaissance WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('lieuNaissance' => $lieuNaissance, 'memberId' => $memberId));
    
        if ($stmt) {
            $response = array('success' => true, 'message' => 'Le lieu de naissance a été mis à jour avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour du lieu de naissance.');
        }
    
    }
    
    if(isset($_POST['sexe'])) {
        $sexe = $_POST['sexe'];
        $memberId = $_POST['memberId'];
    
        $DB = new connexionDB();
    
        $sql = "UPDATE members SET sexe = :sexe WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('sexe' => $sexe, 'memberId' => $memberId));
    
        if ($stmt) {
            $response = array('success' => true, 'message' => 'Le sexe a été mis à jour avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour du sexe.');
        }
    }

    if(isset($_POST['tel'])) {
        $tel = $_POST['tel'];
        $memberId = $_POST['memberId'];
    
        $DB = new connexionDB();
    
        $sql = "UPDATE members SET tel = :tel WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('tel' => $tel, 'memberId' => $memberId));
    
        if ($stmt) {
            $response = array('success' => true, 'message' => 'Le numéro de téléphone a été mis à jour avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour du numéro de téléphone.');
        }
    }

    if(isset($_POST['idTypePieceIdentite'])) {
        $idTypePieceIdentite = $_POST['idTypePieceIdentite'];
        $memberId = $_POST['memberId'];
    
        $DB = new connexionDB();
    
        $sql = "UPDATE members SET idTypePieceIdentite = :idTypePieceIdentite WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('idTypePieceIdentite' => $idTypePieceIdentite, 'memberId' => $memberId));
    
        if ($stmt) {
            $response = array('success' => true, 'message' => 'Le type de pièce a été mis à jour avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour du type de pièce.');
        }
    }

    if(isset($_POST['numeroPiece'])) {
        $numeroPiece = $_POST['numeroPiece'];
        $memberId = $_POST['memberId'];
    
        $DB = new connexionDB();
    
        $sql = "UPDATE members SET numeroPiece = :numeroPiece WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('numeroPiece' => $numeroPiece, 'memberId' => $memberId));
    
        if ($stmt) {
            $response = array('success' => true, 'message' => 'Le numéro de pièce a été mis à jour avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour du numéro de pièce.');
        }
    }

if(isset($_FILES['photoPieceIdentite'])) {
        // Connexion à la base de données
        $DB = new connexionDB();
    
        $response = array();
    
        // Vérification de la présence du fichier
        if(empty($_FILES['photoPieceIdentite']['name'])) {
            $response = ['success' => false, 'message' => 'Aucun fichier reçu.'];
            echo json_encode($response);
            exit;
        }
    
        // Vérification de la présence de memberId
        if(empty($_POST['memberId'])) {
            $response = ['success' => false, 'message' => 'ID du membre manquant.'];
            echo json_encode($response);
            exit;
        }
    
        $photo = $_FILES['photoPieceIdentite'];
        $memberId = $_POST['memberId'];
    
        $photoFileSystemPath = "../files/photo_piece_identite/";
        $photoDatabasePath = "../files/photo_piece_identite/";
    
        // Suppression de l'ancienne photo
        $oldPhotoSql = "SELECT photoPieceIdentite FROM members WHERE idMembers = :memberId";
        $oldPhotoStmt = $DB->query($oldPhotoSql, array('memberId' => $memberId));
    
        if ($oldPhoto = $oldPhotoStmt->fetch()) {
            $oldPhotoName = basename($oldPhoto['photoPieceIdentite']);
            if(file_exists($photoFileSystemPath . $oldPhotoName)) {
                unlink($photoFileSystemPath . $oldPhotoName);
            }
        }
    
        // Déplacement du nouveau fichier photo
        $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
        $hashValue = md5(time() . uniqid());
        $newFilename = "photo_piece_identite_" . $hashValue . "." . $extension;
        $destination = $photoFileSystemPath . $newFilename;
    
        if (!move_uploaded_file($photo['tmp_name'], $destination)) {
            $response = ['success' => false, 'message' => 'Erreur lors de l\'upload de la photo.'];
            echo json_encode($response);
            exit;
        }
        $ext = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
        $mw = 1200; $mh = 1200; $q = 80;
        if ($ext === 'jpg' || $ext === 'jpeg') {
            if (function_exists('imagecreatefromjpeg')) {
                $src = @imagecreatefromjpeg($destination);
                if ($src) { $w = imagesx($src); $h = imagesy($src); $s = min($mw/$w,$mh/$h);
                    if ($s < 1) { $nw=(int)floor($w*$s); $nh=(int)floor($h*$s); $dst=imagecreatetruecolor($nw,$nh); imagecopyresampled($dst,$src,0,0,0,0,$nw,$nh,$w,$h); imagejpeg($dst,$destination,$q); imagedestroy($dst);} else { imagejpeg($src,$destination,$q);} imagedestroy($src);
                }
            }
        } elseif ($ext === 'png') {
            if (function_exists('imagecreatefrompng')) {
                $src = @imagecreatefrompng($destination);
                if ($src) { imagesavealpha($src,true); $w=imagesx($src); $h=imagesy($src); $s=min($mw/$w,$mh/$h);
                    if ($s < 1) { $nw=(int)floor($w*$s); $nh=(int)floor($h*$s); $dst=imagecreatetruecolor($nw,$nh); imagealphablending($dst,false); imagesavealpha($dst,true); imagecopyresampled($dst,$src,0,0,0,0,$nw,$nh,$w,$h); imagepng($dst,$destination,9); imagedestroy($dst);} else { imagepng($src,$destination,9);} imagedestroy($src);
                }
            }
        }
        $script = realpath(__DIR__ . '/../../../scripts/compress_uploads.py');
        if ($script && is_file($script)) {
            $cmd = 'python ' . escapeshellarg($script) . ' --file ' . escapeshellarg(realpath($destination)) . ' --quality 80 --max-width 1200 --max-height 1200 --ext jpg,jpeg,png --lossless-png --strip-metadata';
            @exec($cmd);
        }
    
        // Mise à jour de la base de données avec le nouveau chemin de la photo
        $sql = "UPDATE members SET photoPieceIdentite = :photoPath WHERE idMembers = :memberId";
        $parameters = array(
            'photoPath' => $photoDatabasePath . $newFilename,
            'memberId' => $memberId
        );
        $stmt = $DB->query($sql, $parameters);
    
        if ($stmt) {
            $response = array('success' => true, 'message' => 'La photo a été mise à jour avec succès.');
        } else {
            $response = array('success' => false, 'message' => 'Erreur lors de la mise à jour de la photo dans la base de données.');
        }
    }
     

    if (isset($_POST['dateExpirationPieceIdentite'])) {
        $dateExpirationPieceIdentite = $_POST['dateExpirationPieceIdentite'];
        $memberId = $_POST['memberId'];
    
        $DB = new connexionDB();
    
        $sql = "UPDATE members SET dateExpirationPieceIdentite = :dateExpirationPieceIdentite WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('dateExpirationPieceIdentite' => $dateExpirationPieceIdentite, 'memberId' => $memberId));
    
        if ($stmt) {
            $response = array('success' => true, 'message' => "La date d'expiration a été mise à jour avec succès.");
        } else {
            $response = array('success' => false, 'message' => "Erreur lors de la mise à jour de la date d'expiration.");
        }
    }    

    if (isset($_POST['ovins'])) {
        $ovins = $_POST['ovins'];
        $memberId = $_POST['memberId'];
    
        $DB = new connexionDB();
    
        $sql = "UPDATE members SET ovins = :ovins WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('ovins' => $ovins, 'memberId' => $memberId));
    
        if ($stmt) {
            $response = array('success' => true, 'message' => "Le nombre d'ovins a été mis à jour avec succès.");
        } else {
            $response = array('success' => false, 'message' => "Erreur lors de la mise à jour du nombre d'ovins.");
        }
        
    }

    // Pour Caprins
    if (isset($_POST['caprins'])) {
        $caprins = $_POST['caprins'];
        $memberId = $_POST['memberId'];

        $DB = new connexionDB();

        $sql = "UPDATE members SET caprins = :caprins WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('caprins' => $caprins, 'memberId' => $memberId));

        if ($stmt) {
            $response = array('success' => true, 'message' => "Le nombre de caprins a été mis à jour avec succès.");
        } else {
            $response = array('success' => false, 'message' => "Erreur lors de la mise à jour du nombre de caprins.");
        }
    }

    // Pour Bovins
    if (isset($_POST['bovins'])) {
        $bovins = $_POST['bovins'];
        $memberId = $_POST['memberId'];

        $DB = new connexionDB();

        $sql = "UPDATE members SET bovins = :bovins WHERE idMembers = :memberId";
        $stmt = $DB->query($sql, array('bovins' => $bovins, 'memberId' => $memberId));

        if ($stmt) {
            $response = array('success' => true, 'message' => "Le nombre de bovins a été mis à jour avec succès.");
        } else {
            $response = array('success' => false, 'message' => "Erreur lors de la mise à jour du nombre de bovins.");
        }
        
    }

    if (isset($_FILES['photoMembre'])) {
        // Connexion à la base de données
        $DB = new connexionDB();
    
        $response = array();
    
        // Vérification de la présence du fichier
        if (empty($_FILES['photoMembre']['name'])) {
            $response = ['success' => false, 'message' => 'Aucun fichier reçu.'];
            echo json_encode($response);
            exit;
        }
    
        if (!isset($_POST['memberId'])) {
            $response = ['success' => false, 'message' => 'memberId manquant.'];
            echo json_encode($response);
            exit;
        }
    
        $memberId = $_POST['memberId'];
        $photo = $_FILES['photoMembre'];
    
        $photoDatabasePath = "../files/photo_membre/";
        $photoFileSystemPath = "../files/photo_membre/";
    
        // Suppression de l'ancienne photo
        $oldPhotoSql = "SELECT photoMembre FROM members WHERE idMembers = :memberId";
        $oldPhotoStmt = $DB->query($oldPhotoSql, array('memberId' => $memberId));
    
        if ($oldPhoto = $oldPhotoStmt->fetch()) {
            $oldPhotoName = basename($oldPhoto['photoMembre']);
            if (file_exists($photoFileSystemPath . $oldPhotoName)) {
                if (!unlink($photoFileSystemPath . $oldPhotoName)) {
                    $response = ['success' => false, 'message' => 'Erreur lors de la suppression de l\'ancienne photo.'];
                    echo json_encode($response);
                    exit;
                }
            }
        }
    
        // Upload de la nouvelle photo
        $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
        $hashValue = md5(time() . uniqid());
        $newFilename = "photo_membre_" . $hashValue . "." . $extension;
        $destination = $photoFileSystemPath . $newFilename;
    
        if (!move_uploaded_file($photo['tmp_name'], $destination)) {
            $response = ['success' => false, 'message' => 'Erreur lors de l\'upload de la photo.'];
            echo json_encode($response);
            exit;
        }
        $ext = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
        $mw = 1200; $mh = 1200; $q = 80;
        if ($ext === 'jpg' || $ext === 'jpeg') {
            if (function_exists('imagecreatefromjpeg')) {
                $src = @imagecreatefromjpeg($destination);
                if ($src) { $w = imagesx($src); $h = imagesy($src); $s = min($mw/$w,$mh/$h);
                    if ($s < 1) { $nw=(int)floor($w*$s); $nh=(int)floor($h*$s); $dst=imagecreatetruecolor($nw,$nh); imagecopyresampled($dst,$src,0,0,0,0,$nw,$nh,$w,$h); imagejpeg($dst,$destination,$q); imagedestroy($dst);} else { imagejpeg($src,$destination,$q);} imagedestroy($src);
                }
            }
        } elseif ($ext === 'png') {
            if (function_exists('imagecreatefrompng')) {
                $src = @imagecreatefrompng($destination);
                if ($src) { imagesavealpha($src,true); $w=imagesx($src); $h=imagesy($src); $s=min($mw/$w,$mh/$h);
                    if ($s < 1) { $nw=(int)floor($w*$s); $nh=(int)floor($h*$s); $dst=imagecreatetruecolor($nw,$nh); imagealphablending($dst,false); imagesavealpha($dst,true); imagecopyresampled($dst,$src,0,0,0,0,$nw,$nh,$w,$h); imagepng($dst,$destination,9); imagedestroy($dst);} else { imagepng($src,$destination,9);} imagedestroy($src);
                }
            }
        }
    
        // Mise à jour de la base de données avec le nouveau chemin de la photo
        $sql = "UPDATE members SET photoMembre = :photoPath WHERE idMembers = :memberId";
        $parameters = array(
            'photoPath' => $photoDatabasePath . $newFilename,
            'memberId' => $memberId
        );
        $stmt = $DB->query($sql, $parameters);
    
        if ($stmt) {
            $response = ['success' => true, 'message' => 'La photo a été mise à jour avec succès.'];
        } else {
            $response = ['success' => false, 'message' => 'Erreur lors de la mise à jour de la photo dans la base de données.'];
        }
    
       
    }
    
    if (isset($_FILES['signatureScan'])) {
        // Connexion à la base de données
        $DB = new connexionDB();
    
        $response = array();
    
        // Vérification de la présence du fichier
        if (empty($_FILES['signatureScan']['name'])) {
            $response = ['success' => false, 'message' => 'Aucun fichier reçu.'];
            echo json_encode($response);
            exit;
        }
    
        if (!isset($_POST['memberId'])) {
            $response = ['success' => false, 'message' => 'memberId manquant.'];
            echo json_encode($response);
            exit;
        }
    
        $memberId = $_POST['memberId'];
        $signature = $_FILES['signatureScan'];
    
        $signatureDatabasePath = "../files/signature_scan/";
        $signatureFileSystemPath = "../files/signature_scan/";
    
        // Suppression de l'ancienne signature
        $oldSignatureSql = "SELECT signatureScan FROM members WHERE idMembers = :memberId";
        $oldSignatureStmt = $DB->query($oldSignatureSql, array('memberId' => $memberId));
    
        if ($oldSignature = $oldSignatureStmt->fetch()) {
            $oldSignatureName = basename($oldSignature['signatureScan']);
            if (file_exists($signatureFileSystemPath . $oldSignatureName)) {
                if (!unlink($signatureFileSystemPath . $oldSignatureName)) {
                    $response = ['success' => false, 'message' => 'Erreur lors de la suppression de l\'ancienne signature.'];
                    echo json_encode($response);
                    exit;
                }
            }
        }
    
        // Upload de la nouvelle signature
        $extension = pathinfo($signature['name'], PATHINFO_EXTENSION);
        $hashValue = md5(time() . uniqid());
        $newFilename = "signature_scan_" . $hashValue . "." . $extension;
        $destination = $signatureFileSystemPath . $newFilename;
    
        if (!move_uploaded_file($signature['tmp_name'], $destination)) {
            $response = ['success' => false, 'message' => 'Erreur lors de l\'upload de la signature.'];
            echo json_encode($response);
            exit;
        }
        $ext = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
        $mw = 1200; $mh = 1200; $q = 80;
        if ($ext === 'jpg' || $ext === 'jpeg') {
            if (function_exists('imagecreatefromjpeg')) {
                $src = @imagecreatefromjpeg($destination);
                if ($src) { $w = imagesx($src); $h = imagesy($src); $s = min($mw/$w,$mh/$h);
                    if ($s < 1) { $nw=(int)floor($w*$s); $nh=(int)floor($h*$s); $dst=imagecreatetruecolor($nw,$nh); imagecopyresampled($dst,$src,0,0,0,0,$nw,$nh,$w,$h); imagejpeg($dst,$destination,$q); imagedestroy($dst);} else { imagejpeg($src,$destination,$q);} imagedestroy($src);
                }
            }
        } elseif ($ext === 'png') {
            if (function_exists('imagecreatefrompng')) {
                $src = @imagecreatefrompng($destination);
                if ($src) { imagesavealpha($src,true); $w=imagesx($src); $h=imagesy($src); $s=min($mw/$w,$mh/$h);
                    if ($s < 1) { $nw=(int)floor($w*$s); $nh=(int)floor($h*$s); $dst=imagecreatetruecolor($nw,$nh); imagealphablending($dst,false); imagesavealpha($dst,true); imagecopyresampled($dst,$src,0,0,0,0,$nw,$nh,$w,$h); imagepng($dst,$destination,9); imagedestroy($dst);} else { imagepng($src,$destination,9);} imagedestroy($src);
                }
            }
        }
        $script = realpath(__DIR__ . '/../../../scripts/compress_uploads.py');
        if ($script && is_file($script)) {
            $cmd = 'python ' . escapeshellarg($script) . ' --file ' . escapeshellarg(realpath($destination)) . ' --quality 80 --max-width 1200 --max-height 1200 --ext jpg,jpeg,png --lossless-png --strip-metadata';
            @exec($cmd);
        }
    
        // Mise à jour de la base de données avec le nouveau chemin de la signature
        $sql = "UPDATE members SET signatureScan = :signaturePath WHERE idMembers = :memberId";
        $parameters = array(
            'signaturePath' => $signatureDatabasePath . $newFilename,
            'memberId' => $memberId
        );
        $stmt = $DB->query($sql, $parameters);
    
        if ($stmt) {
            $response = ['success' => true, 'message' => 'La signature a été mise à jour avec succès.'];
        } else {
            $response = ['success' => false, 'message' => 'Erreur lors de la mise à jour de la signature dans la base de données.'];
        }
    }
    

    // Retourner la réponse au format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
