<?php
// Fonction pour récupérer tous les membres avec les valeurs des clés étrangères
require_once('./archived_functions.php');


$userId = $_SESSION['user_id'];

// Vérifier si l'utilisateur est admin
$isAdmin = isAdmin($userId);


// Récupérer les membres correspondants à l'utilisateur
$members = [];
if ($isAdmin) {
    // Si l'utilisateur est admin, récupérer tous les membres
    $members = getAllMembers();
} else {
    // Si l'utilisateur n'est pas admin, récupérer les membres enregistrés par l'utilisateur dans les 72 dernières heures
    $members = getMembersByUser72($userId);
}


// Fonction pour récupérer les membres sous forme de tableau associatif avec les clés correspondant aux en-têtes de colonnes
function getMembersForDataTable()
{
    $members = getAllMembers(); // Vous pouvez remplacer cette fonction par toute autre méthode de récupération de données

    $data = array();
    foreach ($members as $member) {
        $rowData = array(
            "Date d'adhésion" => formatDateFrench($member["dateAdhesion"]),
            "Département" => $member["nom_departement"],
            "Commune" => $member["nom_commune"],
            "Arrondissement" => $member["nom_arrondissement"],
            "UDOPER" => $member["nom_udoper"],
            "Village" => $member["village"],
            "Nom" => $member["nom"],
            "Prénom" => $member["prenom"],
            "Date de naissance" => formatDateFrench($member["dateNaissance"]),
            "Lieu de naissance" => $member["lieuNaissance"],
            "Sexe" => $member["sexe"],
            "Téléphone" => $member["tel"],
            "Type de pièce d'identité" => $member["nom_type_piece"],
            "Numéro de pièce" => $member["numeroPiece"],
            "Photo de la pièce d'identité" => "<a href='./datas/" . removeLeadingDots($member["photoPieceIdentite"]) . "' target='_blank'>Photo Pièce Identité</a>",
            "Date d'expiration de la pièce d'identité" => formatDateFrench($member["dateExpirationPieceIdentite"]),
            "Nombre d'ovins" => $member["ovins"],
            "Nombre de bovins" => $member["bovins"],
            "Nombre de caprins" => $member["caprins"],
            "Photo du membre" => "<a href='./datas/" . removeLeadingDots($member["photoMembre"]) . "' target='_blank'>Photo Membre</a>",
            "Scan de la signature" => "<a href='./datas/" . removeLeadingDots($member["signatureScan"]) . "' target='_blank'>Signature</a>",
            "QR Code" => "<a href='./datas/" . removeLeadingDots($member["qrCodePath"]) . "' target='_blank'>QR Code</a>",
            "Numéro de carte membre" => $member["numeroCarteMembre"],
            "Date et heure" => "Enregistré le " . formatDateFrenchWithTime($member["date_time"]),
            "Actions" => "<button class='btn btn-sm btn-danger btn-circle' onclick='deleteMember(" . $member["idMembers"] . ")'><i class='fas fa-trash'></i></button><button class='btn btn-sm btn-success btn-circle' onclick='editMember(" . $member["idMembers"] . ")'><i class='fas fa-edit'></i></button>",
        );

        $data[] = $rowData;
    }

    return $data;
}


?>


<table id="example" class="table table-striped display compact nowrap hover cell-border" style="width:100%">
    <thead>
        <tr>
            <th>Date d'adhésion</th>
            <th>Département</th>
            <th>Commune</th>
            <th>Arrondissement</th>
            <th>UDOPER</th>
            <th>Village</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Lieu de naissance</th>
            <th>Sexe</th>
            <th>Téléphone</th>
            <th>Type de pièce d'identité</th>
            <th>Numéro de pièce</th>
            <th>Photo de la pièce d'identité</th>
            <th>Date d'expiration de la pièce d'identité</th>
            <th>Nombre d'ovins</th>
            <th>Nombre de bovins</th>
            <th>Nombre de caprins</th>
            <th>Photo du membre</th>
            <th>Scan de la signature</th>
            <th>QR Code</th>
            <th>Numéro de carte membre</th>
            <th>Date et heure</th>
            <th>Enregistré par</th>
            <th>Actions</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($members as $member) : ?>
            <tr>
                <td><?= formatDateFrench($member["dateAdhesion"]); ?></td>
                <td><?= $member["nom_departement"]; ?></td>
                <td><?= $member["nom_commune"]; ?></td>
                <td><?= $member["nom_arrondissement"]; ?></td>
                <td><?= $member["nom_udoper"]; ?></td>
                <td><?= $member["village"]; ?></td>
                <td><?= $member["nom"]; ?></td>
                <td><?= $member["prenom"]; ?></td>
                <td><?= formatDateFrench($member["dateNaissance"]); ?></td>
                <td><?= $member["lieuNaissance"]; ?></td>
                <td><?= $member["sexe"]; ?></td>
                <td><?= $member["tel"]; ?></td>
                <td><?= $member["nom_type_piece"]; ?></td>
                <td><?= $member["numeroPiece"]; ?></td>
                <td>
                    <small><a href="./datas/<?= removeLeadingDots($member["photoPieceIdentite"]); ?>" target="_blank">Photo Pièce Identité</a></small>
                </td>
                <td><?= formatDateFrench($member["dateExpirationPieceIdentite"]); ?></td>
                <td><?= $member["ovins"]; ?></td>
                <td><?= $member["bovins"]; ?></td>
                <td><?= $member["caprins"]; ?></td>
                <td>
                    <small><a href="./datas/<?= removeLeadingDots($member["photoMembre"]); ?>" target="_blank">Photo Membre</a></small>
                </td>
                <td>
                    <small><a href="./datas/<?= removeLeadingDots($member["signatureScan"]); ?>" target="_blank">Signature</a></small>
                </td>
                <td>
                    <small><a href="./datas/<?= removeLeadingDots($member["qrCodePath"]); ?>" target="_blank">QR Code</a></small>
                </td>
                <td><?= $member["numeroCarteMembre"]; ?></td>
                <td>Enregistré le <?= formatDateFrenchWithTime($member["date_time"]); ?></td>
                <td> <?= $member['z_nom'] . " " . $member['z_prenom']; ?></td>

                <td>
                    <small>
                        <button class="btn btn-sm btn-danger btn-circle" onclick="deleteMember(<?= $member["idMembers"]; ?>)">
                            <i class="fas fa-trash"></i>
                        </button>
                        <a class="btn btn-sm btn-success btn-circle" href="edit?id=<?= $member["idMembers"]; ?>" >
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-sm btn-danger btn-circle" onclick="archiveMember(<?= $member['idMembers']; ?>)">
    <i class="fas fa-archive"></i>
</a>

                        <?php if($isAdmin) { ?>
                        <a class="btn btn-sm btn-primary btn-circle" href="./card_generated/index.php?cardid=<?= $member["numeroCarteMembre"]; ?>" target="_blank">
                            <i class="fas fa-id-card"></i>
                        </a>
                        <?php } ?>
                    </small>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Date d'adhésion</th>
            <th>Département</th>
            <th>Commune</th>
            <th>Arrondissement</th>
            <th>UDOPER</th>
            <th>Village</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Lieu de naissance</th>
            <th>Sexe</th>
            <th>Téléphone</th>
            <th>Type de pièce d'identité</th>
            <th>Numéro de pièce</th>
            <th>Photo de la pièce d'identité</th>
            <th>Date d'expiration de la pièce d'identité</th>
            <th>Nombre d'ovins</th>
            <th>Nombre de bovins</th>
            <th>Nombre de caprins</th>
            <th>Photo du membre</th>
            <th>Scan de la signature</th>
            <th>QR Code</th>
            <th>Numéro de carte membre</th>
            <th>Date et heure</th>
            <th>Enregistré par</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
<script>
    function archiveMember(memberId) {
        if (confirm('Êtes-vous sûr de vouloir désarchiver ce membre ?')) {
            fetch(`unarchive.php?id=${memberId}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    location.reload(); // Recharge la page pour mettre à jour le tableau
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Erreur :', error);
                alert('Une erreur est survenue. Veuillez réessayer.');
            });
        }
    }
</script>


