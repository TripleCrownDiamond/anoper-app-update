<?php

// Fonction pour récupérer le nombre total de membres enregistrés
function getTotalMembers()
{
    $DB = new connexionDB();

    // Effectuer une requête SQL pour compter le nombre total de membres enregistrés
    $sql = "SELECT COUNT(*) AS totalMembers FROM members";
    $stmt = $DB->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['totalMembers'];
}

// Fonction pour récupérer le nombre total d'utilisateurs dans la base de données
function getTotalUsers()
{
    $DB = new connexionDB();

    // Effectuer une requête SQL pour compter le nombre total d'utilisateurs
    $sql = "SELECT COUNT(*) AS totalUsers FROM users";
    $stmt = $DB->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['totalUsers'];
}

// Fonction pour récupérer le nombre d'utilisateurs actifs
function getActiveUsers()
{
    $DB = new connexionDB();

    // Effectuer une requête SQL pour compter le nombre d'utilisateurs actifs (active = 1)
    $sql = "SELECT COUNT(*) AS activeUsers FROM users WHERE active = 1";
    $stmt = $DB->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['activeUsers'];
}

// Fonction pour récupérer le nombre de membres enregistrés par un utilisateur (non-admin) au cours des dernières 72 heures

function getMembersByUser($userId)
{
    $DB = new connexionDB();

    // Effectuer une requête SQL pour compter le nombre de membres enregistrés par l'utilisateur (non-admin) au cours des dernières 72 heures
    $sql = "SELECT COUNT(*) AS membersByUser FROM members WHERE user_id = :userId";
    $stmt = $DB->query($sql, array('userId' => $userId));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['membersByUser'];
}

function getmembersLast72Hours($userId)
{
    $DB = new connexionDB();

    // Effectuer une requête SQL pour compter le nombre de membres enregistrés par l'utilisateur (non-admin) au cours des dernières 72 heures
    $sql = "SELECT COUNT(*) AS membersLast72Hours FROM members WHERE user_id = :userId AND date_time >= DATE_SUB(NOW(), INTERVAL 72 HOUR)";
    $stmt = $DB->query($sql, array('userId' => $userId));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['membersLast72Hours'];
}

$userId = $_SESSION['user_id'];

function isUserAdmin($userId)
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

// Récupérer le nombre total de membres enregistrés
$totalMembers = getTotalMembers();
$totalUsers = getTotalUsers();
$activeUsers = getActiveUsers();
$membersByUser = getMembersByUser($userId);
$membersLast72Hours = getmembersLast72Hours($userId);
$isAdmin = isUserAdmin($userId);

?>

<div class="row">
    <!-- Carte : Nombre total de membres -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <?php echo ($isAdmin) ? 'Total Membres' : 'Membres Enregistrés'; ?>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalMembers">
                            <?php echo ($isAdmin) ? $totalMembers : $membersByUser; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cartes : Nombre total d'utilisateurs et d'utilisateurs actifs (Visible uniquement pour les administrateurs) -->
    <?php if ($isAdmin) : ?>
        <!-- Carte : Nombre total d'utilisateurs -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Utilisateurs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalUsers">
                                <?php echo $totalUsers; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte : Utilisateurs actifs -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Utilisateurs Actifs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="activeUsers">
                                <?php echo $activeUsers; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Carte : Membres enregistrés au cours des dernières 72 heures (Visible uniquement pour les utilisateurs non-administrateurs) -->
    <?php if (!$isAdmin) : ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Membres Enregistrés (72h)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="membersLast72Hours">
                                <?php echo $membersLast72Hours; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
