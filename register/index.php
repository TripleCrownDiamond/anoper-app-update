<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION["user_id"])) {
    // Rediriger vers la page "cardcreate/index.php" si l'utilisateur est déjà connecté
    header("Location: ../cardcreate/");
    exit();
}
?>
<!doctype html>
<html lang="fr" data-bs-theme="auto">

<head>
    <script src="../scripts/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Inscription - Générateur de Carte Membre</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/logo-anoper.jpg" sizes="180x180">
    <link rel="icon" href="../assets/logo-anoper.jpg" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png../assets/logo-anoper.jpg" sizes="16x16" type="image/png">
    <link rel="icon" href="../assets/logo-anoper.jpg">
    <meta name="theme-color" content="#712cf9">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Autres liens CSS et balises <style> -->

    <!-- Lien vers le fichier JavaScript de SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        /* Augmentation de la largeur des champs du formulaire */
        .form-floating.mb-3 input[type="text"],
        .form-floating.mb-3 input[type="email"],
        .form-floating.mb-3 input[type="tel"],
        .form-floating.mb-3 input[type="password"] {
            width: 100%;
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="../css/theme.css" rel="stylesheet">
</head>

<body class="align-items-center py-4">
    <main class="form-signin w-100 m-auto">
        <form class="col-12" id="registrationForm">
            <div class="text-center mb-2">
                <a href="../"><img class="" src="../assets/logo-anoper.jpg" alt="" width="150"></a>
            </div>
            <h1 class="h3 mb-3 fw-normal text-center">Inscription</h1>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingNom" placeholder="Nom" required>
                <label for="floatingNom">Nom</label>
                <div class="invalid-feedback" id="nomError"></div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingPrenom" placeholder="Prénom" required>
                <label for="floatingPrenom">Prénom</label>
                <div class="invalid-feedback" id="prenomError"></div>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" required>
                <label for="floatingEmail">Adresse email</label>
                <div class="invalid-feedback" id="emailError"></div>
            </div>
            <div class="form-floating mb-3">
                <input type="tel" class="form-control" id="floatingTelephone" placeholder="Téléphone">
                <label for="floatingTelephone">Téléphone (facultatif)</label>
                <div class="invalid-feedback" id="telephoneError"></div>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Mot de passe" required>
                <label for="floatingPassword">Mot de passe</label>
                <div class="invalid-feedback" id="passwordError"></div>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingConfirmPassword" placeholder="Confirmer le mot de passe" required>
                <label for="floatingConfirmPassword">Confirmer le mot de passe</label>
                <div class="invalid-feedback" id="confirmPasswordError"></div>
            </div>


            <div class="text-center">
                <button class="btn btn-primary w-100 mt-3" type="submit">S'inscrire</button>
            </div>
            <p class="mt-3 mb-0 text-center">Vous avez déjà un compte ? <a href="../login/">Connectez-vous</a></p>
            <p class="mt-3 mb-0 text-center"><a href="../">Retour à l'accueil</a></p>
            <p class="mt-5 mb-3 text-body-secondary text-center">&copy; <a href="http://anoper.bj">Anoper</a> 2017–2023</p>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- Ajout du script AJAX -->
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();

            const nom = document.getElementById('floatingNom').value;
            const prenom = document.getElementById('floatingPrenom').value;
            const email = document.getElementById('floatingEmail').value;
            const password = document.getElementById('floatingPassword').value;
            const confirmPassword = document.getElementById('floatingConfirmPassword').value;
            const telephone = document.getElementById('floatingTelephone').value;

            // Réinitialiser les messages d'erreur
            document.getElementById('nomError').innerText = '';
            document.getElementById('prenomError').innerText = '';
            document.getElementById('emailError').innerText = '';
            document.getElementById('telephoneError').innerText = '';
            document.getElementById('passwordError').innerText = '';
            document.getElementById('confirmPasswordError').innerText = '';

            // Requête AJAX
            const xhr = new XMLHttpRequest();
            const url = 'server.php';
            const params = `nom=${encodeURIComponent(nom)}&prenom=${encodeURIComponent(prenom)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}&confirm_password=${encodeURIComponent(confirmPassword)}&telephone=${encodeURIComponent(telephone)}`;
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                // Le reste du code JavaScript est inchangé

                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Afficher le message de succès avec SweetAlert
                            Swal.fire({
                                icon: 'success',
                                title: 'Inscription réussie',
                                text: 'Vous êtes maintenant inscrit !',
                            });
                            // Réinitialiser le formulaire après une inscription réussie
                            document.getElementById('registrationForm').reset();
                        } else {
                            if (response.errors) {
                                let errorMessage = '';

                                // Vérifier s'il y a une erreur pour le champ "Nom"
                                if (response.errors.nom) {
                                    errorMessage += response.errors.nom + '\n';
                                    document.getElementById('nomError').innerText = response.errors.nom;
                                }

                                // Vérifier s'il y a une erreur pour le champ "Prénom"
                                if (response.errors.prenom) {
                                    errorMessage += response.errors.prenom + '\n';
                                    document.getElementById('prenomError').innerText = response.errors.prenom;
                                }

                                // Vérifier s'il y a une erreur pour le champ "Adresse email"
                                if (response.errors.email) {
                                    errorMessage += response.errors.email + '\n';
                                    document.getElementById('emailError').innerText = response.errors.email;
                                }

                                // Vérifier s'il y a une erreur pour le champ "Téléphone"
                                if (response.errors.telephone) {
                                    errorMessage += response.errors.telephone + '\n';
                                    document.getElementById('telephoneError').innerText = response.errors.telephone;
                                }

                                // Vérifier s'il y a une erreur pour le champ "Mot de passe"
                                if (response.errors.password) {
                                    errorMessage += response.errors.password + '\n';
                                    document.getElementById('passwordError').innerText = response.errors.password;
                                }

                                // Vérifier s'il y a une erreur pour le champ "Confirmer le mot de passe"
                                if (response.errors.confirm_password) {
                                    errorMessage += response.errors.confirm_password + '\n';
                                    document.getElementById('confirmPasswordError').innerText = response.errors.confirm_password;
                                }

                                // Utiliser SweetAlert pour afficher les erreurs spécifiques
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erreur d\'inscription',
                                    text: errorMessage,
                                });
                            } else {
                                // Utiliser SweetAlert pour afficher un message d'erreur générique
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erreur d\'inscription',
                                    text: 'Une erreur s\'est produite lors de l\'inscription.',
                                });
                            }

                        }
                    } else {
                        // Utiliser SweetAlert pour afficher un message d'erreur en cas de problème de connexion
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur de connexion',
                            text: 'Une erreur s\'est produite lors de la connexion au serveur.',
                        });
                    }
                }
            };
            xhr.send(params);
        });
    </script>
</body>

</html>