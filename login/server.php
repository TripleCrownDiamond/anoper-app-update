<?php
// Inclure le fichier de connexion à la base de données
require_once "../configs/databaseconnect.php";

// Démarrer la session
session_start();

// Valider les informations de connexion reçues via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire de connexion
    $email = $_POST["email"];
    $password = $_POST["password"];
    $remember = isset($_POST["remember"]) ? $_POST["remember"] : 0;

    // Effectuer la validation (vous pouvez ajouter d'autres vérifications si nécessaire)
    $errors = array();

    if (empty($email)) {
        $errors["email"] = "L'adresse e-mail est obligatoire.";
    } else {
        // Vérifier si l'adresse e-mail existe dans la base de données
        $DB = new connexionDB();
        $query = "SELECT * FROM users WHERE email = :email";
        $result = $DB->query($query, array("email" => $email));
        $user = $result->fetch();

        if (!$user) {
            $errors["email"] = "L'adresse e-mail n'est pas enregistrée.";
        } else {
            // Vérifier si le compte est actif
            if ($user["active"] != 1) {
                $errors["email"] = "Votre compte est suspendu. Veuillez contacter l'administrateur.";
            }
        }
    }

    if (empty($password)) {
        $errors["password"] = "Le mot de passe est obligatoire.";
    } else {
        // Encodage du mot de passe en MD5 pour le comparer avec celui stocké dans la base de données
        $encodedPassword = md5($password);

        // Vérifier si le mot de passe correspond à celui enregistré dans la base de données
        $DB = new connexionDB();
        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $result = $DB->query($query, array("email" => $email, "password" => $encodedPassword));
        $user = $result->fetch();

        if (!$user) {
            $errors["password"] = "Le mot de passe est incorrect.";
        }
    }

    // Vérifier s'il y a des erreurs
    if (count($errors) > 0) {
        // Retourner les erreurs sous forme de réponse JSON
        echo json_encode(array("success" => false, "errors" => $errors));
    } else {
        // Connexion réussie, mettre à jour la dernière connexion de l'utilisateur
        $now = date("Y-m-d H:i:s");
        $DB = new connexionDB();
        $query = "UPDATE users SET derniere_connexion = :derniere_connexion, remember_me = :remember WHERE email = :email";
        $DB->query($query, array("derniere_connexion" => $now, "remember" => $remember, "email" => $email));

        // Stocker les informations de l'utilisateur dans la session
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_email"] = $user["email"];

        // Retourner une réponse JSON de succès
        echo json_encode(array("success" => true));
    }
}
?>
