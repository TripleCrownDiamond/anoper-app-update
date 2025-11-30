<?php
$userId = $_SESSION['user_id'];
function isUserAdmin2($userId)
{
    $DB = new connexionDB();

    // Effectuer une requête SQL pour récupérer le rôle de l'utilisateur
    $sql = "SELECT admin FROM users WHERE id = :userId";
    $stmt = $DB->query($sql, array('userId' => $userId));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur est un administrateur (admin)
    // Ici, on suppose que le champ "role" contient la valeur "admin" pour les administrateurs
    return $result['admin'];
}

$isadmin = isUserAdmin2($userId);

?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-home"></i>
    </div>
    <div class="h3 sidebar-brand-text mx-3">ANOPER</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="./">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Tableau de bord</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
        aria-expanded="true" aria-controls="collapseOne">
        <i class="fas fa-fw fa-users"></i>
        <span>Membres</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Membres</h6>
            <a class="collapse-item" data-toggle="modal" data-target="#modalNouveauMembre">Nouveau</a>
            <a class="collapse-item" href="./list">Gérer</a>
            <?php if($isadmin) { ?>
            <a class="collapse-item" href="./archives">Archives</a>
            <?php } ?>
           
        </div>
    </div>
</li>

<?php if($isadmin) { ?>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-users"></i>
        <span>Utilisateurs</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Utilisateurs</h6>
            <a class="collapse-item" href="./users.php">Gérer</a>
        </div>
    </div>
</li>
<?php } ?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>


</ul>