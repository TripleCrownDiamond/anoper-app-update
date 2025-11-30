<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <?php
    // Vérifier si l'utilisateur est un administrateur
    $DB = new connexionDB();
    $query = "SELECT admin, nom, prenom FROM users WHERE id = :user_id";
    $result = $DB->query($query, array("user_id" => $_SESSION["user_id"]));
    $user = $result->fetch();

    if ($user["admin"] == 1) {
        // L'utilisateur est un administrateur
        echo '<h2 class="h4 mb-0 text-gray-800">Liste des utilisateurs enregistrés</h2>';
    } else {
        // L'utilisateur n'est pas un administrateur
       
    }
    ?>
   
</div>