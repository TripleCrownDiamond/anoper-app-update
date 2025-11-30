function deleteMember(memberId) {
    Swal.fire({
        title: "Êtes-vous sûr?",
        text: "Une fois supprimé, vous ne pourrez pas récupérer ce membre !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui, supprimer",
        cancelButtonText: "Annuler",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            // Appel AJAX pour supprimer le membre
            $.ajax({
                url: "./datas/delete/",
                type: "POST",
                data: {
                    member_id: memberId
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        // Suppression réussie, affichage de la notification SweetAlert
                        Swal.fire({
                            icon: "success",
                            title: "Succès",
                            text: response.message,
                        });
                        
                        location.reload();
                       
                    } else {
                        // Erreur lors de la suppression, affichage de la notification SweetAlert
                        Swal.fire("Erreur", response.message, "error");
                    }
                },
                error: function () {
                    // Erreur lors de la requête AJAX, affichage de la notification SweetAlert
                    Swal.fire("Erreur", "Une erreur est survenue lors de la suppression du membre.", "error");
                }
            });
        }
    });
}
