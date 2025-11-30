<!-- La Modal -->
<div class="modal fade" id="modalNouveauMembre" tabindex="-1" aria-labelledby="modalNouveauMembreLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNouveauMembreLabel">Nouveau membre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">

                <form action="server.php" method="post" enctype="multipart/form-data"> 

                    <div class="mb-3">
                        <label for="dateAdhesion" class="form-label">Date d'adhésion:</label>
                        <input type="date" name="dateAdhesion" id="dateAdhesion" class="form-control">
                        <div class="invalid-feedback d-none">Veuillez sélectionner une date d'adhésion valide.</div>
                    </div>

                    <div class="mb-3">
                        <label for="departement" class="form-label">Département:</label>
                        <select id="departement" name="departement" class="form-control">
                            <option value="">Sélectionner un département</option>
                        </select>
                        <div class="invalid-feedback d-none">Veuillez sélectionner un département.</div>
                    </div>

                    <div class="mb-3">
                        <label for="commune" class="form-label">Commune:</label>
                        <select id="commune" name="commune" class="form-control">
                            <option value="">Sélectionner un département d'abord</option>
                        </select>
                        <div class="invalid-feedback d-none">Veuillez sélectionner une commune.</div>
                    </div>

                    <div class="mb-3">
                        <label for="arrondissement" class="form-label">Arrondissement:</label>
                        <select id="arrondissement" name="arrondissement" class="form-control">
                            <option value="">Sélectionner un arrondissement</option>
                            <!-- Les options d'arrondissement seront chargées ici via AJAX en fonction de la commune choisie -->
                        </select>
                        <div class="invalid-feedback d-none">Veuillez sélectionner un arrondissement.</div>
                    </div>

                    <div class="mb-3">
                        <label for="udoper" class="form-label">UDOPER:</label>
                        <select id="udoper" name="udoper" class="form-control">
                            <option value="">Sélectionner une UDOPER</option>
                        </select>
                        <div class="invalid-feedback d-none">Veuillez sélectionner une UDOPER.</div>
                    </div>

                    <div class="mb-3">
                        <label for="village" class="form-label">Village: </label>
                        <input type="text" name="village" id="village" class="form-control" placeholder="Préciser le village du membre">
                        <div class="invalid-feedback d-none">Veuillez préciser le village du membre.</div>
                    </div>

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom: </label>
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Préciser le nom du membre">
                        <div class="invalid-feedback d-none">Veuillez préciser le nom du membre.</div>
                    </div>

                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom: </label>
                        <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Préciser le prénom du membre">
                        <div class="invalid-feedback d-none">Veuillez préciser le prénom du membre.</div>
                    </div>

                    <div class="mb-3">
                        <label for="dateNaissance" class="form-label">Date de naissance:</label>
                        <input type="date" name="dateNaissance" id="dateNaissance" class="form-control">
                        <div class="invalid-feedback d-none">Veuillez sélectionner une date de naissance valide.</div>
                    </div>

                    <div class="mb-3">
                        <label for="lieuNaissance" class="form-label">Lieu de naissance: </label>
                        <input type="text" name="lieuNaissance" id="lieuNaissance" class="form-control" placeholder="Préciser le lieu de naissance du membre">
                        <div class="invalid-feedback d-none">Veuillez préciser le lieu de naissance du membre.</div>
                    </div>

                    <div class="mb-3">
                        <label for="sexe" class="form-label">Sexe: </label>
                        <select name="sexe" id="sexe" class="form-control">
                            <option value="" selected>Choisir le sexe...</option>
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                        <div class="invalid-feedback d-none">Veuillez préciser le sexe du membre.</div>
                    </div>

                    <div class="mb-3">
                        <label for="tel" class="form-label">Téléphone (Sans l'indicatif): </label>
                        <input type="tel" name="tel" id="tel" class="form-control" placeholder="Préciser le numéro de téléphone du membre">
                        <div class="invalid-feedback d-none">Veuillez saisir un numéro de téléphone valide.</div>
                    </div>

                    <div class="mb-3">
                        <label for="typePieceIdentite" class="form-label">Type de pièce d'identité :</label>
                        <select id="typePieceIdentite" name="typePieceIdentite" class="form-control">
                            <option value="">Sélectionner un type de pièce d'identité</option>
                        </select>
                        <div class="invalid-feedback d-none">Veuillez sélectionner un type de pièce d'identité.</div>
                    </div>

                    <div class="mb-3">
                        <label for="numeroPieceIdentite" class="form-label">Numéro de pièce d'identité :</label>
                        <input type="number" id="numeroPieceIdentite" name="numeroPieceIdentite" class="form-control" placeholder="Laisser vide si vous avez choisi 'Témoignage' précédemment">
                        
                    </div>

                    <div class="mb-3">
                        <label for="photoPieceIdentite" class="form-label">Photo de la pièce d'identité :</label>
                        <input type="file" id="photoPieceIdentite" name="photoPieceIdentite" class="form-control">
                        <!-- Div de feedback invalide -->
                        <div class="invalid-feedback d-none">
                            Veuillez sélectionner une photo de la pièce d'identité.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dateExpirationPieceIdentite" class="form-label">Date d'expiration de la pièce d'identité :</label>
                        <input type="date" id="dateExpirationPieceIdentite" name="dateExpirationPieceIdentite" class="form-control">
                        <div class="invalid-feedback d-none">Veuillez saisir une date d'expiration de pièce d'identité valide.</div>
                    </div>

                    <div class="mb-3">
                        <label for="ovins" class="form-label">Nombre d'ovins:</label>
                        <input type="number" name="ovins" id="ovins" class="form-control" min="0">
                        <div class="invalid-feedback d-none">Veuillez préciser le nombre d'ovins.</div>
                    </div>

                    <div class="mb-3">
                        <label for="bovins" class="form-label">Nombre de bovins:</label>
                        <input type="number" name="bovins" id="bovins" class="form-control" min="0">
                        <div class="invalid-feedback d-none">Veuillez préciser le nombre de bovins.</div>
                    </div>

                    <div class="mb-3">
                        <label for="caprins" class="form-label">Nombre de caprins:</label>
                        <input type="number" name="caprins" id="caprins" class="form-control" min="0">
                        <div class="invalid-feedback d-none">Veuillez préciser le nombre de caprins.</div>
                    </div>

                    <div class="mb-3">
                        <label for="photoMembre" class="form-label">Photo du membre (format photo d'identité) :</label>
                        <input type="file" id="photoMembre" name="photoMembre" class="form-control">
                        <!-- Div de feedback invalide -->
                        <div class="invalid-feedback d-none">
                            Veuillez sélectionner une photo du membre au format photo d'identité.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="signatureScan" class="form-label">Signature scannée :</label>
                        <input type="file" id="signatureScan" name="signatureScan" class="form-control">
                        <!-- Div de feedback invalide -->
                        <div class="invalid-feedback d-none">
                            Veuillez sélectionner une signature scannée au format image.
                        </div>
                    </div>

                    <!-- Ajoutez ici d'autres champs du formulaire -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="./datas/new/scripts.js"></script>
<script src="./datas/new/validate_form.js"></script>
