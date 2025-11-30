document.addEventListener('DOMContentLoaded', function () {

    $("#editSignatureScanForm").submit(function(event) {
        event.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: response.message,
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: response.message
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: "error",
                    title: "Erreur AJAX",
                    text: "Une erreur est survenue lors de la soumission : " + textStatus + " " + errorThrown
                });
            }
        });
    });
    

    $("#editPhotoMembreForm").submit(function(event) {
        event.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: response.message,
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: response.message
                    });
                }
            }
        });
    });    

    // Pour Caprins
    $("#editCaprinsForm").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Nombre de caprins modifié avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification du nombre de caprins."
                    });
                }
            }
        });
    });

    // Pour Bovins
    $("#editBovinsForm").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Nombre de bovins modifié avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification du nombre de bovins."
                    });
                }
            }
        });
    });

    $("#editOvinsForm").submit(function(event) {
        event.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Nombre d'ovins modifié avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification du nombre d'ovins."
                    });
                }
            }
        });
    });    

    $("#editDateExpirationForm").submit(function(event) {
        event.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Date d'expiration modifiée avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification de la date d'expiration."
                    });
                }
            }
        });
    });    

    $("#editPhotoPieceForm").submit(function(event) {
        event.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: response.message,
                        onClose: function() {  // Ajoutez cette partie
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: response.message
                    });
                }
            }
        });
    });    

    $("#editNumeroPieceForm").submit(function(event) {
        event.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Numéro de pièce modifié avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification du numéro de pièce."
                    });
                }
            }
        });
    });    

    $("#editIdTypePieceForm").submit(function(event) {
        event.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Type de pièce modifié avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification du type de pièce."
                    });
                }
            }
        });
    });
    
    // Pour charger les options dans le select
    $.ajax({
        url: './datas/new/getTypeDePieces.php', // Le fichier PHP pour récupérer les types de pièces
        method: 'GET',
        dataType: 'html',
        success: function(data) {
            $('#idTypePieceIdentite').append(data); // Ajouter les options au select
        }
    });
       

    $("#editTelForm").submit(function(event) {
        event.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",  
            data: formData,
            dataType: "json",
            contentType: false,   
            processData: false,   
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Numéro de téléphone modifié avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification du numéro de téléphone."
                    });
                }
            }
        });
    });    

    $("#editSexeForm").submit(function(event) {
        event.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",  
            data: formData,
            dataType: "json",
            contentType: false,   
            processData: false,   
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Sexe modifié avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification du sexe."
                    });
                }
            }
        });
    });    

    $("#editLieuNaissanceForm").submit(function(event) {
        event.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",  
            data: formData,
            dataType: "json",
            contentType: false,   
            processData: false,   
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Lieu de naissance modifié avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification du lieu de naissance."
                    });
                }
            }
        });
    });    
    
    $("#editVillage").submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",  // Assurez-vous que cette URL est correcte
            data: formData,
            dataType: "json",
            contentType: false,   // Ajouté pour le traitement correct de FormData
            processData: false,   // Ajouté pour le traitement correct de FormData
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Village modifié avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification du village."
                    });
                }
            }
        });
    });

    $("#editNom").submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",  // Assurez-vous que cette URL est correcte
            data: formData,
            dataType: "json",
            contentType: false,   // Ajouté pour le traitement correct de FormData
            processData: false,   // Ajouté pour le traitement correct de FormData
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Nom du membre modifié avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification du nom du membre."
                    });
                }
            }
        });
    });

    $("#editPrenom").submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",  // Assurez-vous que cette URL est correcte
            data: formData,
            dataType: "json",
            contentType: false,   // Ajouté pour le traitement correct de FormData
            processData: false,   // Ajouté pour le traitement correct de FormData
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Prénom du membre modifié avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification du prénom du membre."
                    });
                }
            }
        });
    });

    $("#editDateNaissanceForm").submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",  // Assurez-vous que cette URL est correcte
            data: formData,
            dataType: "json",
            contentType: false,   // Ajouté pour le traitement correct de FormData
            processData: false,   // Ajouté pour le traitement correct de FormData
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Date de naissance modifiée avec succès.",
                        onClose: function() {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification de la date de naissance."
                    });
                }
            }
        });
    });
    
    // Écouter l'événement de soumission du formulaire
    document.querySelector('#editDateAdhesionForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Empêcher le comportement de soumission par défaut
        //alert("worked")
        // Récupérer les données du formulaire
        var formData = new FormData(this);

        // Envoyer les données via une requête AJAX à server.php
        $.ajax({
            url: './datas/edit/server.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    // Afficher un message de succès avec Swal
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès!',
                        text: response.message
                    }).then(function () {
                        // Recharger la page
                        window.location.reload();
                    });
                } else {
                    // Afficher un message d'erreur avec Swal
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur!',
                        text: response.message
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // En cas d'erreur avec la requête AJAX, afficher un message d'erreur avec Swal
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur!',
                    text: 'Erreur lors de la mise à jour : ' + textStatus + ' - ' + errorThrown
                });
            }
        });
    });

    // Formulaire de modification de l'UDOPER
    $("#editUdoperForm").submit(function (event) {
        event.preventDefault(); // Empêche le rechargement de la page
        
        // Récupérer les données du formulaire
        var formData = new FormData(this);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        

        // Envoyer les données en AJAX à server.php (ou l'URL appropriée pour le traitement)
        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php", // Remplacez ceci par l'URL de votre script de traitement PHP
            data: formData,
            processData: false,  // Important!
            contentType: false,  // Important!
            dataType: "json",
            success: function (response) {
                // Afficher le feedback avec Swal en fonction de la réponse du serveur
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "UDOPER modifié avec succès.",
                        onClose: function () {
                            // Recharger la page pour afficher les nouvelles données
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification de l'UDOPER."
                    });
                }
            }
        });
    });

    // Formulaire de modification de département / commune / arrondissement
    $("#editDepCommArr").submit(function (event) {
        event.preventDefault(); // Empêche le rechargement de la page
    
        // Récupérer les données du formulaire
        var formData = new FormData(this);
    
        // Envoyer les données en AJAX à server.php
        $.ajax({
            type: "POST",
            url: "./datas/edit/server.php",
            data: formData,
            dataType: "json",
            processData: false, // Indique à jQuery de ne pas traiter les données
            contentType: false, // Indique à jQuery de ne pas définir le type de contenu, car nous utilisons FormData
            success: function (response) {
                // Afficher le feedback avec Swal en fonction de la réponse du serveur
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Succès",
                        text: "Département / Commune / Arrondissement modifiés avec succès.",
                        onClose: function () {
                            // Recharger la page pour afficher les nouvelles données
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur est survenue lors de la modification du département / commune / arrondissement."
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Afficher le feedback en cas d'erreur réseau ou d'erreur serveur non prévue
                Swal.fire({
                    icon: "error",
                    title: "Erreur",
                    text: "Une erreur inattendue est survenue. Veuillez réessayer."
                });
            }
        });
    });    

    // Charger les options de départements dans le premier select
    $.ajax({
        url: './datas/new/getDepartements.php', // Le fichier PHP pour récupérer les départements
        method: 'GET',
        dataType: 'html',
        success: function (data) {
            $('#departement').append(data); // Ajouter les options de départements au select
        }
    });

    // Écouter les changements sur le premier select (département)
    $('#departement').on('change', function () {
        var selectedDepartementId = $(this).val();
        if (selectedDepartementId !== '') {
            // Charger les options de communes en fonction du département sélectionné
            $.ajax({
                url: './datas/new/getCommunes.php', // Le fichier PHP pour récupérer les communes
                method: 'GET',
                data: {
                    departementId: selectedDepartementId
                }, // Passer l'identifiant du département en paramètre
                dataType: 'html',
                success: function (data) {
                    $('#commune').html(data); // Ajouter les options de communes au select

                    // Déclencher l'événement "change" sur la liste déroulante de la commune pour charger automatiquement les arrondissements
                    $('#commune').trigger('change');
                }
            });
        } else {
            // Réinitialiser le select des communes si aucun département n'est sélectionné
            $('#commune').html('<option value="">Sélectionner un département d\'abord</option>');
        }
    });

    // Code JavaScript pour charger les options d'arrondissements via AJAX en fonction de la commune choisie
    $('#commune').on('change', function () {
        var selectedCommune = $(this).val();
        $('#arrondissement').empty(); // Vider la liste déroulante des arrondissements
        $('#arrondissement').append('<option value="">Sélectionner un arrondissement</option>'); // Option par défaut

        if (selectedCommune !== '') {
            $.ajax({
                url: './datas/new/getArrondissements.php?communeId=' + selectedCommune, // Le fichier PHP pour récupérer les arrondissements en fonction de la commune choisie
                method: 'GET',
                dataType: 'html',
                success: function (data) {
                    $('#arrondissement').html(data); // Ajouter les options d'arrondissements au select
                }
            });
        }
    });

    // Code JavaScript pour charger les options de l'UDOPER via AJAX
    $.ajax({
        url: './datas/new/getUdopers.php', // Le fichier PHP pour récupérer les UDOPER
        method: 'GET',
        dataType: 'html',
        success: function (data) {
            $('#udoper').append(data); // Ajouter les options de l'UDOPER au select
        }
    });

    // Charger les options de types de pièces d'identité dans la select
    $.ajax({
        url: './datas/new/getTypeDePieces.php', // Remplacez le chemin par l'emplacement du fichier getTypeDePieces.php
        method: 'GET',
        dataType: 'html',
        success: function (data) {
            $('#typePieceIdentite').append(data); // Ajouter les options de types de pièces d'identité à la select
        }
    });
});