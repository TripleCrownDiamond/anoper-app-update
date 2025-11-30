<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <?php
    // Vérifier si l'utilisateur est un administrateur
    $DB = new connexionDB();
    $query = "SELECT admin, nom, prenom FROM users WHERE id = :user_id";
    $result = $DB->query($query, array("user_id" => $_SESSION["user_id"]));
    $user = $result->fetch();

    if ($user["admin"] == 1) {
        // L'utilisateur est un administrateur
        echo '<h2 class="h4 mb-0 text-gray-800">Bienvenue sur votre tableau de bord Admin</h2>';
    } else {
        // L'utilisateur n'est pas un administrateur
        echo '<h2 class="h4 mb-0 text-gray-800">Bienvenue sur votre tableau de bord, ' . $user["prenom"] . ' ' . $user["nom"] . '</h2>';
    }
    ?>
    <button href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalNouveauMembre"><i
            class="fas fa-user fa-sm text-white-50"></i> Nouveau Membre </button>
</div>
