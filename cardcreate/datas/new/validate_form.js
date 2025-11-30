$(document).ready(function () {
    // Fonction pour vérifier si le fichier uploadé est une image
    function isValidImageFile(input) {
        const file = input.prop("files")[0];
        const acceptedImageTypes = ["image/jpeg", "image/png"]; // Extensions de fichiers acceptées pour les images
        const maxSize = 5 * 1024 * 1024; // Taille maximale : 5 Mo
        return file && acceptedImageTypes.includes(file.type) && file.size <= maxSize;
    }

    // Fonction pour vérifier si le fichier uploadé est une photo d'identité
    function isValidMemberPhoto(input) {
        const file = input.prop("files")[0];
        const acceptedImageTypes = ["image/jpeg", "image/png"]; // Extensions de fichiers acceptées pour les photos
        const maxSize = 5 * 1024 * 1024; // Taille maximale : 5 Mo
        const image = new Image();
        image.src = URL.createObjectURL(file);

        // Vérifier si c'est une image valide
        return (
            file &&
            acceptedImageTypes.includes(file.type) &&
            file.size <= maxSize
        );
    }

    // Validation du formulaire lorsqu'il est soumis
    $("form").submit(function (e) {
        e.preventDefault(); // Empêche l'envoi du formulaire par défaut

        // Réinitialiser les messages d'erreur et les classes invalides
        $(".invalid-feedback").addClass("d-none");
        $(".form-control").removeClass("is-invalid").removeClass("is-valid");

        // Validation des champs obligatoires
        const requiredFields = [
            "dateAdhesion",
            "departement",
            "commune",
            "arrondissement",
            "udoper",
            "village",
            "nom",
            "prenom",
            "dateNaissance",
            "lieuNaissance",
            "sexe",
            "tel",
            "typePieceIdentite",
            "photoPieceIdentite",
            "ovins",
            "bovins",
            "caprins",
            "photoMembre",
            "signatureScan" // Ajout du champ de signature scannée dans les champs obligatoires
        ];

        let isValid = true;
        const formData = new FormData(this); // Utiliser FormData pour récupérer les données du formulaire
        requiredFields.forEach(function (field) {
            const input = $("#" + field);
            if (!formData.get(field)) { // Utiliser formData.get() pour vérifier si la clé existe
                input.addClass("is-invalid");
                input.next(".invalid-feedback").removeClass("d-none");
                isValid = false;
            } else {
                input.addClass("is-valid");
            }
        });

        // Validation spécifique pour le numéro de téléphone (8 chiffres)
        const telInput = $("#tel");
        const telValue = telInput.val();
        if (telValue !== "" && !/^\d{8}$/.test(telValue)) {
            telInput.addClass("is-invalid");
            telInput.next(".invalid-feedback").removeClass("d-none");
            isValid = false;
        } else {
            telInput.addClass("is-valid");
        }

        // Validation pour les fichiers uploadés (images)
        const photoPieceIdentiteInput = $("#photoPieceIdentite");
        if (!isValidImageFile(photoPieceIdentiteInput)) {
            photoPieceIdentiteInput.addClass("is-invalid");
            photoPieceIdentiteInput.next(".invalid-feedback").removeClass("d-none");
            isValid = false;
        } else {
            photoPieceIdentiteInput.addClass("is-valid");
        }

        const photoMembreInput = $("#photoMembre");
        if (!isValidImageFile(photoMembreInput) || !isValidMemberPhoto(photoMembreInput)) {
            photoMembreInput.addClass("is-invalid");
            photoMembreInput.next(".invalid-feedback").removeClass("d-none");
            isValid = false;
        } else {
            photoMembreInput.addClass("is-valid");
        }

        const signatureScanInput = $("#signatureScan");
        if (!isValidImageFile(signatureScanInput)) {
            signatureScanInput.addClass("is-invalid");
            signatureScanInput.next(".invalid-feedback").removeClass("d-none");
            isValid = false;
        } else {
            signatureScanInput.addClass("is-valid");
        }

        // Fonction pour générer les données du code QR à partir des champs du formulaire
        function generateQRCodeData(formData) {
            const qrDataObject = {};
            for (const pair of formData.entries()) {
                // Si le champ est numeroPieceIdentite et la valeur est vide, assigner NULL
                if (pair[0] === "numeroPieceIdentite" && !pair[1]) {
                    qrDataObject[pair[0]] = null;
                } else {
                    qrDataObject[pair[0]] = pair[1];
                }
            }
            return JSON.stringify(qrDataObject);
        }        

        // Si tout est valide, envoyer les données via AJAX
        if (isValid) {
            const formData = new FormData(this);
            formData.append("timestamp", Date.now()); // Ajouter le timestamp
            formData.append("qrCodeData", generateQRCodeData(formData)); // Ajouter les données du code QR

            // Afficher SweetAlert de chargement pendant l'envoi des données
            Swal.fire({
                title: "Envoi des données...",
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "./datas/new/server.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Fermer SweetAlert
                    Swal.close();

                    // Gérer la réponse du serveur ici
                    const responseData = JSON.parse(response);
                    if (responseData.success) {
                        // Afficher une alerte de succès avec SweetAlert
                        Swal.fire({
                            icon: "success",
                            title: "Succès",
                            text: responseData.message,
                            confirmButtonText: "OK"
                        }).then(function () {
                            // Rediriger ou faire d'autres actions nécessaires après le succès
                            console.log("Formulaire soumis avec succès !"); // Message de débogage
                            resetForm();
                            
                        });
                    } else {
                        // Afficher une alerte d'erreur avec SweetAlert
                        Swal.fire({
                            icon: "error",
                            title: "Erreur",
                            text: responseData.message,
                            confirmButtonText: "OK"
                        });
                    }
                },
                error: function () {
                    // Fermer SweetAlert
                    Swal.close();

                    // Afficher une alerte d'erreur avec SweetAlert
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Le serveur est injoignable. Veuillez réessayer plus tard.",
                        confirmButtonText: "OK"
                    });
                }
            });
        }
    });

    // Fonction pour réinitialiser le formulaire
    function resetForm() {
        console.log("Réinitialisation du formulaire..."); // Message de débogage
        $("form")[0].reset();
        $(".form-control").removeClass("is-valid").removeClass("is-invalid");
        $(".invalid-feedback").addClass("d-none");
    }

    // ...
});
