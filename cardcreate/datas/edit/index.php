<div class="col-md-12">
    <h6>Date d'adhésion</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <?php if (isset($member[0]['dateAdhesion'])) : ?>
                <li class="list-group-item">Date d'adhésion : <strong><?= formatDateFrench($member[0]['dateAdhesion']); ?></strong> </li>
            <?php else : ?>
                <li class="list-group-item">Date d'adhésion : <strong>N/A</strong></li>
            <?php endif; ?>
            <form id="editDateAdhesionForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="dateAdhesion">Modifier la date d'adhésion</label>
                    <div class="input-group">
                        <input type="date" name="dateAdhesion" id="dateAdhesion" class="form-control">
                        <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Département / Commune / Arrondissement</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Département : <strong><?= $member[0]['nom_departement']; ?></strong></li>
            <li class="list-group-item">Commune : <strong><?= $member[0]['nom_commune']; ?></strong></li>
            <li class="list-group-item mb-4">Arrondissement : <strong><?= $member[0]['nom_arrondissement']; ?></strong></li>
            <form id="editDepCommArr" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    <div class="mb-3">
                        <label for="departement" class="form-label">Modifier Département:</label>
                        <select id="departement" name="departement" class="form-control">
                            <option value="">Sélectionner un département</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="commune" class="form-label">Modifier Commune:</label>
                        <select id="commune" name="commune" class="form-control">
                            <option value="">Sélectionner un département d'abord</option>
                        </select>
                        <div class="invalid-feedback d-none">Veuillez sélectionner une commune.</div>
                    </div>

                    <div class="mb-3">
                        <label for="arrondissement" class="form-label">Modifier Arrondissement:</label>
                        <select id="arrondissement" name="arrondissement" class="form-control">
                            <option value="">Sélectionner un arrondissement</option>
                            <!-- Les options d'arrondissement seront chargées ici via AJAX en fonction de la commune choisie -->
                        </select>
                        <div class="invalid-feedback d-none">Veuillez sélectionner un arrondissement.</div>
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>UDOPER</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item mb-4">UDOPER : <strong><?= $member[0]['nom_udoper']; ?></strong></li>
            <form id="editUdoperForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    <div class="mb-3">
                        <label for="udoper" class="form-label">UDOPER:</label>
                        <select id="udoper" name="udoper" class="form-control">
                            <option value="">Sélectionner une UDOPER</option>
                        </select>
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Village</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item mb-4">Village : <strong><?= $member[0]['village']; ?></strong></li>
            <form id="editVillage" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    <div class="mb-3">
                        <label for="village" class="form-label">Village:</label>
                        <input type="text" name="village" id="village" class="form-control" >
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Nom</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item mb-4">Nom : <strong><?= $member[0]['nom']; ?></strong></li>
            <form id="editNom" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom:</label>
                        <input type="text" name="nom" id="nom" class="form-control" >
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Prénom</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item mb-4">Prénom : <strong><?= $member[0]['prenom']; ?></strong></li>
            <form id="editPrenom" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom:</label>
                        <input type="text" name="prenom" id="prenom" class="form-control" >
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Date de naissance</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <?php if (isset($member[0]['dateNaissance'])) : ?>
                <li class="list-group-item">Date de naissance : <strong><?= formatDateFrench($member[0]['dateNaissance']); ?></strong> </li>
            <?php else : ?>
                <li class="list-group-item">Date de naissance : <strong>N/A</strong></li>
            <?php endif; ?>
            <form id="editDateNaissanceForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="dateNaissance">Modifier la date de naissance</label>
                    <div class="input-group">
                        <input type="date" name="dateNaissance" id="dateNaissance" class="form-control">
                        <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Lieu de naissance</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <?php if (isset($member[0]['lieuNaissance'])) : ?>
                <li class="list-group-item">Lieu de naissance : <strong><?= $member[0]['lieuNaissance']; ?></strong> </li>
            <?php else : ?>
                <li class="list-group-item">Lieu de naissance : <strong>N/A</strong></li>
            <?php endif; ?>
            <form id="editLieuNaissanceForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="lieuNaissance">Modifier le lieu de naissance</label>
                    <div class="input-group">
                        <input type="text" name="lieuNaissance" id="lieuNaissance" class="form-control">
                        <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Sexe</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <?php if (isset($member[0]['sexe'])) : ?>
                <li class="list-group-item">Sexe : <strong><?= $member[0]['sexe']; ?></strong> </li>
            <?php else : ?>
                <li class="list-group-item">Sexe : <strong>N/A</strong></li>
            <?php endif; ?>
            <form id="editSexeForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="sexe">Modifier le sexe</label>
                    <div class="input-group">
                        <select name="sexe" id="sexe" class="form-control">
                            <option value="Homme" <?= ($member[0]['sexe'] == 'Homme') ? 'selected' : ''; ?>>Homme</option>
                            <option value="Femme" <?= ($member[0]['sexe'] == 'Femme') ? 'selected' : ''; ?>>Femme</option>
                        </select>
                        <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Numéro de téléphone</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <?php if (isset($member[0]['tel'])) : ?>
                <li class="list-group-item">Téléphone : <strong><?= $member[0]['tel']; ?></strong> </li>
            <?php else : ?>
                <li class="list-group-item">Téléphone : <strong>N/A</strong></li>
            <?php endif; ?>
            <form id="editTelForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="tel">Modifier le numéro de téléphone</label>
                    <div class="input-group">
                        <input type="text" name="tel" id="tel" class="form-control" value="<?= $member[0]['tel']; ?>">
                        <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Type de pièce d'identité</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <?php if (isset($member[0]['nom_type_piece'])) : ?>
                <li class="list-group-item">Type de pièce : <strong><?= $member[0]['nom_type_piece']; ?></strong> </li>
            <?php else : ?>
                <li class="list-group-item">Type de pièce : <strong>N/A</strong></li>
            <?php endif; ?>
            <form id="editIdTypePieceForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="idTypePieceIdentite">Modifier le type de pièce</label>
                    <select name="idTypePieceIdentite" id="idTypePieceIdentite" class="form-control">
                        <!-- Les options seront chargées ici par jQuery -->
                    </select>
                    <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Numéro de pièce</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <?php if (isset($member[0]['numeroPiece'])) : ?>
                <li class="list-group-item">Numéro de pièce : <strong><?= $member[0]['numeroPiece']; ?></strong> </li>
            <?php else : ?>
                <li class="list-group-item">Numéro de pièce : <strong>N/A</strong></li>
            <?php endif; ?>
            <form id="editNumeroPieceForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="numeroPiece">Modifier le numéro de pièce</label>
                    <input type="text" name="numeroPiece" id="numeroPiece" class="form-control" value="<?= isset($member[0]['numeroPiece']) ? $member[0]['numeroPiece'] : ''; ?>">
                    <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Photo de la pièce d'identité</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                Photo actuelle : 
                <img src="<?= str_replace('../files/', './datas/files/', $member[0]['photoPieceIdentite']); ?>" alt="Photo de la pièce d'identité" width="150">
            </li>
            <form id="editPhotoPieceForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center" enctype="multipart/form-data">
                <div class="container col-12">
                    <label class="mt-4" for="photoPieceIdentite">Modifier la photo</label>
                    <input type="file" name="photoPieceIdentite" id="photoPieceIdentite" class="form-control">
                    <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Date d'expiration de la pièce d'identité</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <?php if (isset($member[0]['dateExpirationPieceIdentite'])) : ?>
                <li class="list-group-item">Date d'expiration : <strong><?= formatDateFrench($member[0]['dateExpirationPieceIdentite']); ?></strong> </li>
            <?php else : ?>
                <li class="list-group-item">Date d'expiration : <strong>N/A</strong></li>
            <?php endif; ?>
            <form id="editDateExpirationForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="dateExpirationPieceIdentite">Modifier la date d'expiration</label>
                    <div class="input-group">
                        <input type="date" name="dateExpirationPieceIdentite" id="dateExpirationPieceIdentite" class="form-control">
                        <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Ovins</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Nombre d'ovins : <strong><?= $member[0]['ovins']; ?></strong></li>
            <form id="editOvinsForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="ovins">Modifier le nombre d'ovins</label>
                    <div class="input-group">
                        <input type="number" name="ovins" id="ovins" class="form-control" value="<?= $member[0]['ovins']; ?>">
                        <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<!-- Pour Caprins -->
<div class="col-md-12">
    <h6>Caprins</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Nombre de caprins : <strong><?= $member[0]['caprins']; ?></strong></li>
            <form id="editCaprinsForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="caprins">Modifier le nombre de caprins</label>
                    <div class="input-group">
                        <input type="number" name="caprins" id="caprins" class="form-control" value="<?= $member[0]['caprins']; ?>">
                        <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<!-- Pour Bovins -->
<div class="col-md-12">
    <h6>Bovins</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Nombre de bovins : <strong><?= $member[0]['bovins']; ?></strong></li>
            <form id="editBovinsForm" action="" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="bovins">Modifier le nombre de bovins</label>
                    <div class="input-group">
                        <input type="number" name="bovins" id="bovins" class="form-control" value="<?= $member[0]['bovins']; ?>">
                        <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Photo du Membre</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                Photo actuelle :
                <img src="<?= str_replace('../files/', './datas/files/', $member[0]['photoMembre']); ?>" alt="Photo de la pièce d'identité" width="150">
            </li>
            <form id="editPhotoMembreForm" action="" method="post" enctype="multipart/form-data" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="photoMembre">Modifier la photo du membre</label>
                    <div class="input-group">
                        <input type="file" name="photoMembre" id="photoMembre" class="form-control">
                        <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                        <input type="hidden" name="currentPhotoPath" value="<?= $member[0]['photoMembre']; ?>">
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>
<br>
<div class="col-md-12">
    <h6>Signature scannée du Membre</h6>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                Signature actuelle :
                <img src="<?= str_replace('../files/', './datas/files/', $member[0]['signatureScan']); ?>" alt="Signature scannée du membre" width="150">
            </li>
            <form id="editSignatureScanForm" action="" method="post" enctype="multipart/form-data" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="container col-12">
                    <label class="mt-4" for="signatureScan">Modifier la signature scannée</label>
                    <div class="input-group">
                        <input type="file" name="signatureScan" id="signatureScan" class="form-control">
                        <input type="hidden" name="memberId" value="<?= $member[0]['idMembers']; ?>">
                        <input type="hidden" name="currentSignaturePath" value="<?= $member[0]['signatureScan']; ?>">
                    </div>
                </div>
                <div class="container mt-2 mb-2 col-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </ul>
    </div>
</div>





