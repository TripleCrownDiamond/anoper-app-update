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

    <title>Connexion - Générateur de Carte Membre</title>

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

        /* Style de la barre de progression */
        #loadingAlert .progress {
            margin-top: 10px;
            height: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }

        #loadingAlert .progress-bar {
            background-color: #712cf9;
            width: 0;
            height: 100%;
            color: #fff;
            text-align: center;
            line-height: 20px;
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="../css/theme.css" rel="stylesheet">
</head>

<body class="align-items-center py-4">

    <main class="form-signin w-100 m-auto">
        <form id="loginForm">
            <div class="text-center mb-4">
                <a href="../"><img class="mb-2" src="../assets/logo-anoper.jpg" alt="" width="150"></a>
            </div>
            <h1 class="h3 mb-3 fw-normal">Veuillez vous connecter</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Adresse e-mail</label>
            </div><br>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Mot de passe">
                <label for="floatingPassword">Mot de passe</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="remember">
                <label class="form-check-label" for="flexCheckDefault">
                    Se souvenir de moi
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Se connecter</button>
            <p class="mt-3 mb-0 text-center">Vous n'avez pas encore de compte ? <a href="../register/">Inscrivez-vous</a></p>
            <p class="mt-1 mb-3 text-center"><a href="../reset_password/">Mot de passe oublié ?</a></p>
            <p class="mt-3 mb-0 text-center"><a href="../">Retour à l'accueil</a></p>
            <p class="mt-5 mb-3 text-center text-body-secondary">&copy; <a href="https://anoper.bj">Anoper</a> 2017–2023</p>

            <!-- Ajouter cette balise div pour l'alerte de chargement -->
            <div id="loadingAlert" class="d-none">
                <h4>Veuillez patienter...</h4>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Chargement...</div>
                </div>
            </div>

        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Soumettre le formulaire via AJAX lorsqu'il est envoyé
            $("#loginForm").submit(function(event) {
                event.preventDefault();

                // Récupérer les données du formulaire
                const email = $("#floatingInput").val();
                const password = $("#floatingPassword").val();
                const remember = $("#flexCheckDefault").prop("checked");

                // Afficher l'alerte de chargement
                $("#loadingAlert").removeClass("d-none");

                // Envoyer les données via AJAX à server.php pour validation
                $.ajax({
                    type: "POST",
                    url: "server.php",
                    data: {
                        email: email,
                        password: password,
                        remember: remember
                    },
                    dataType: "json",
                    success: function(response) {
                        // Cacher l'alerte de chargement une fois la réponse reçue
                        $("#loadingAlert").addClass("d-none");

                        if (response.success) {
                            // Utiliser SweetAlert pour afficher l'alerte de succès
                            Swal.fire({
                                icon: 'success',
                                title: 'Connexion réussie',
                                text: 'Vous allez être redirigé vers votre tableau de bord.',
                                timer: 3000, // Afficher l'alerte pendant 3 secondes
                                showConfirmButton: false // Cacher le bouton de confirmation
                            }).then(function() {
                                // Rediriger vers la page ../cardcreate/ après la fermeture de l'alerte
                                window.location.replace("../cardcreate/");
                            });
                        } else if (response.errors) {
                            // Utiliser SweetAlert pour afficher les erreurs
                            let errorMessage = '';
                            if (response.errors.email) {
                                errorMessage += response.errors.email + '\n';
                            }
                            if (response.errors.password) {
                                errorMessage += response.errors.password + '\n';
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur de connexion',
                                text: errorMessage,
                            });
                        } else {
                            // Utiliser SweetAlert pour afficher un message d'erreur générique
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur de connexion',
                                text: 'Une erreur s\'est produite lors de la connexion.',
                            });
                        }
                    },
                    error: function() {
                        // Cacher l'alerte de chargement en cas d'erreur
                        $("#loadingAlert").addClass("d-none");

                        // Utiliser SweetAlert pour afficher un message d'erreur générique
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur de connexion',
                            text: 'Une erreur s\'est produite lors de la connexion.',
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
