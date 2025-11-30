<?php
// Fonction pour récupérer tous les users
$DB = new connexionDB();

$sql = $DB->query("SELECT * FROM users WHERE admin <> 1");
$sql = $sql->fetchAll();

function formatDateFrench($dateStr)
{
    // Convertir la date en objet DateTime
    $dateObj = new DateTime($dateStr);

    // Formater la date au format français avec l'heure (jj/mm/aaaa à HH:mm:ss)
    return $dateObj->format('d/m/Y');
}

function formatDateFrenchWithTime($dateStr)
{
    // Convertir la date en objet DateTime
    $dateObj = new DateTime($dateStr);

    // Formater la date au format français avec l'heure (jj/mm/aaaa à HH:mm:ss)
    return $dateObj->format('d/m/Y à H:i:s');
}

function removeLeadingDots($filePath)
{
    // Utilisation de preg_replace pour supprimer les deux points au début de la chaîne
    $fixedPath = preg_replace('/^\.\.\//', '', $filePath);
    return $fixedPath;
}

?>
<table id="example" class="table table-striped display compact nowrap hover cell-border" style="width:100%">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Date d'inscription</th>
            <th>Dernière connexion</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sql as $user) : ?>
            <tr>
                <td><?= $user["nom"]; ?></td>
                <td><?= $user["prenom"]; ?></td>
                <td><?= $user["email"]; ?></td>
                <td><?= $user["telephone"]; ?></td>
                <td><?= formatDateFrench($user["date_inscription"]); ?></td>
                <td><?= formatDateFrenchWithTime($user["derniere_connexion"]); ?></td>
                <td>
                    <?php if($user["active"] == 1): ?>
                        <span class="badge badge-pill badge-success">Actif</span>
                    <?php else: ?>
                        <span class="badge badge-pill badge-danger">Inactif</span>
                    <?php endif; ?>
                </td>
                <td>
                    <button class="btn btn-sm btn-warning btn-circle" onclick="suspendUser(<?= $user["id"]; ?>)">
                        <i class="fas fa-ban"></i>
                    </button>
                    <button class="btn btn-sm btn-success btn-circle" onclick="restoreUser(<?= $user["id"]; ?>)">
                        <i class="fas fa-redo"></i>
                    </button>
                    <button class="btn btn-sm btn-danger btn-circle" onclick="deleteUser(<?= $user["id"]; ?>)">
                        <i class="fas fa-trash"></i>
                    </button>
                   
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>