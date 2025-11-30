//Code JavaScript pour charger les options de départements via AJAX
$(document).ready(function() {
    // Charger les options de départements dans le premier select
    $.ajax({
        url: './datas/new/getDepartements.php', // Le fichier PHP pour récupérer les départements
        method: 'GET',
        dataType: 'html',
        success: function(data) {
            $('#departement').append(data); // Ajouter les options de départements au select
        }
    });  

    // Écouter les changements sur le premier select (département)
    $('#departement').on('change', function() {
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
                success: function(data) {
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
    $('#commune').on('change', function() {
        var selectedCommune = $(this).val();
        $('#arrondissement').empty(); // Vider la liste déroulante des arrondissements
        $('#arrondissement').append('<option value="">Sélectionner un arrondissement</option>'); // Option par défaut

        if (selectedCommune !== '') {
            $.ajax({
                url: './datas/new/getArrondissements.php?communeId=' + selectedCommune, // Le fichier PHP pour récupérer les arrondissements en fonction de la commune choisie
                method: 'GET',
                dataType: 'html',
                success: function(data) {
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
        success: function(data) {
            $('#udoper').append(data); // Ajouter les options de l'UDOPER au select
        }
    });

    // Charger les options de types de pièces d'identité dans la select
    $.ajax({
        url: './datas/new/getTypeDePieces.php', // Remplacez le chemin par l'emplacement du fichier getTypeDePieces.php
        method: 'GET',
        dataType: 'html',
        success: function(data) {
            $('#typePieceIdentite').append(data); // Ajouter les options de types de pièces d'identité à la select
        }
    });
});