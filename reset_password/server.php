<?php
// Démarrer la session (nécessaire pour l'utilisation de la variable $_SESSION)
session_start();

// Inclure les fichiers de PHPMailer
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Vérifier si l'email a été envoyé via la méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer l'email envoyé depuis le formulaire
    $email = $_POST["email"];

    // Vérifier si l'email existe dans la base de données
    require '../configs/databaseconnect.php';

    // Requête SQL pour vérifier si l'email existe dans la table des utilisateurs
    $query = "SELECT * FROM users WHERE email = :email";

    // Exécuter la requête avec les données liées
    $result = $DB->query($query, array(':email' => $email));

    // Vérifier si la requête a réussi
    if ($result) {
        // Vérifier s'il y a un enregistrement avec cet email
        if ($result->rowCount() > 0) {
            // L'email existe dans la base de données, générer un nouveau mot de passe
            $newPassword = generateRandomPassword();

            // Hasher le nouveau mot de passe
            $hashedPassword = md5($newPassword);

            // Requête SQL pour mettre à jour le mot de passe dans la base de données
            $updateQuery = "UPDATE users SET password = :password WHERE email = :email";

            // Exécuter la requête de mise à jour avec les données liées
            $updateResult = $DB->query($updateQuery, array(':password' => $hashedPassword, ':email' => $email));

            if ($updateResult) {
                // Envoi de l'email avec le nouveau mot de passe
                $mail = new PHPMailer;
                // Paramètres SMTP pour Gmail
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'bobeatrice80@gmail.com'; // Remplacez par votre adresse Gmail
                $mail->Password = 'iojltrplunxjbwnn'; // Remplacez par le mot de passe de votre adresse Gmail
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                // Paramètres de l'email
                $mail->setFrom('noreply@anoper.bj', 'ANOPER');
                $mail->addAddress($email); // L'adresse de l'utilisateur à qui envoyer le nouveau mot de passe

                $mail->Subject = 'Récupération de mot de passe';
                $mail->CharSet = 'UTF-8'; // Encodage UTF-8 pour le contenu de l'e-mail
                $mail->isHTML(true); // Format HTML pour l'e-mail
                $mail->Body = 'Votre nouveau mot de passe est : ' . $newPassword . '<br>Veuillez le sauvegarder dans un lieu sûr pour ne pas l\'égarer.';

                if ($mail->send()) {
                    // Envoi réussi, afficher un message de succès
                    echo json_encode(array('success' => true));
                } else {
                    // Erreur lors de l'envoi de l'email
                    echo json_encode(array('error' => 'Une erreur s\'est produite lors de l\'envoi de l\'email.'));
                }
            } else {
                // Erreur lors de la mise à jour du mot de passe
                echo json_encode(array('error' => 'Une erreur s\'est produite lors de la mise à jour du mot de passe.'));
            }
        } else {
            // L'email n'existe pas dans la base de données
            echo json_encode(array('error' => 'L\'adresse e-mail saisie n\'existe pas dans notre base de données.'));
        }
    } else {
        // Erreur lors de l'exécution de la requête
        echo json_encode(array('error' => 'Une erreur s\'est produite lors du traitement de la demande.'));
    }
}

// Fonction pour générer un nouveau mot de passe aléatoire
function generateRandomPassword($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomPassword = '';

    for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomPassword;
}
?>
