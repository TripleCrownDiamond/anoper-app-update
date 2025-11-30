<?php
// Inclure le fichier de connexion à la base de données
require_once "../configs/databaseconnect.php";

// Vérifier si la requête est une requête POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $telephone = $_POST["telephone"];

    // Tableau pour stocker les erreurs éventuelles
    $errors = array();

    // Vérifier si l'email est unique (s'il est fourni)
    if (!empty($email)) {
        $DB = new connexionDB();
        $query = "SELECT COUNT(*) as count FROM users WHERE email = :email";
        $result = $DB->query($query, array("email" => $email));
        $data = $result->fetch(PDO::FETCH_ASSOC);

        if ($data["count"] > 0) {
            $errors["email"] = "L'adresse email existe déjà, veuillez en choisir une autre.";
        }
    } else {
        $errors["email"] = "L'adresse email est obligatoire.";
    }

    // Vérifier si le mot de passe et la confirmation du mot de passe correspondent
    if ($password !== $confirm_password) {
        $errors["confirm_password"] = "Les mots de passe ne correspondent pas.";
    }

    // Vérifier s'il y a des erreurs
    if (count($errors) === 0) {
        // Si tout est bon, enregistrer l'utilisateur dans la base de données
        $query = "INSERT INTO users (nom, prenom, email, password, telephone, admin, active) VALUES (:nom, :prenom, :email, :password, :telephone, :admin, :active)";
        $data = array(
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
            "password" => md5($password), // Hash du mot de passe
            "telephone" => $telephone,
            "admin" => false, // Par défaut à false
            "active" => true // Par défaut à true
        );

        $result = $DB->insert($query, $data);

        if ($result) {
            // Envoi de la réponse JSON pour indiquer le succès
            echo json_encode(array("success" => true));
        } else {
            // Envoi de la réponse JSON en cas d'erreur d'enregistrement
            echo json_encode(array("success" => false, "message" => "Une erreur s'est produite lors de l'enregistrement de l'utilisateur."));
        }
    } else {
        // Envoi de la réponse JSON avec les erreurs
    $response = array(
        "success" => false,
        "errors" => array(
            "nom" => isset($errors["nom"]) ? $errors["nom"] : null,
            "prenom" => isset($errors["prenom"]) ? $errors["prenom"] : null,
            "email" => isset($errors["email"]) ? $errors["email"] : null,
            "telephone" => isset($errors["telephone"]) ? $errors["telephone"] : null,
            "password" => isset($errors["password"]) ? $errors["password"] : null,
            "confirm_password" => isset($errors["confirm_password"]) ? $errors["confirm_password"] : null
        ),
        "message" => "Erreur d'inscription. Veuillez corriger les erreurs ci-dessous."
    );

    echo json_encode($response);
    }
} else {
    // Envoi de la réponse JSON en cas de requête invalide
    echo json_encode(array("success" => false, "message" => "Requête invalide."));
}
?>
