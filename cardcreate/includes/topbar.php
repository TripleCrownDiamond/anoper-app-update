<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                // Vérifier si l'utilisateur est connecté et s'il est admin
                if (isset($_SESSION["user_id"])) {
                    $DB = new connexionDB();
                    $query = "SELECT admin, nom, prenom FROM users WHERE id = :user_id";
                    $result = $DB->query($query, array("user_id" => $_SESSION["user_id"]));
                    $user = $result->fetch();

                    if ($user["admin"] == 1) {
                        // L'utilisateur est un administrateur, afficher "Compte Admin"
                        echo '<span class="mr-2 d-none d-lg-inline text-gray-600 small">Compte Admin</span>';
                    } else {
                        // L'utilisateur n'est pas un administrateur, afficher le nom de l'utilisateur
                        $nomUtilisateur = $user["prenom"] . ' ' . $user["nom"];
                        echo '<span class="mr-2 d-none d-lg-inline text-gray-600 small">' . truncateName($nomUtilisateur, 15) . '</span>';
                    }
                }
                ?>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <div class="dropdown-divider"></div>
                <!-- Sweet Alert pour demander confirmation de la déconnexion -->
                <a class="dropdown-item" href="#" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Déconnexion
                </a>
            </div>
        </li>

    </ul>

</nav>




<?php
// Fonction pour tronquer le nom de l'utilisateur s'il est trop long
function truncateName($name, $length) {
    if (strlen($name) > $length) {
        return substr($name, 0, $length - 3) . '...';
    }
    return $name;
}
?>

<script>
function confirmLogout() {
    // Utiliser Sweet Alert pour demander confirmation
    Swal.fire({
        title: 'Déconnexion',
        text: 'Êtes-vous sûr de vouloir vous déconnecter?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui',
        cancelButtonText: 'Non'
    }).then((result) => {
        if (result.isConfirmed) {
            // Rediriger vers le fichier de déconnexion
            window.location.href = '../logout/';
        }
    });
}
</script>
