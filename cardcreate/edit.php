<?php
session_start();
include_once("../configs/databaseconnect.php");

if (!$_SESSION['user_id']) {
    // Rediriger vers la page "cardcreate/index.php" si l'utilisateur est déjà connecté
    header("Location: ../login");
    exit();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $memberId = $_GET['id'];
}

function getMember($id)
{
    $DB = new connexionDB();

    $sql = "SELECT m.*, 
                   d.name AS nom_departement, 
                   c.name AS nom_commune, 
                   a.name AS nom_arrondissement, 
                   u.name AS nom_udoper, 
                   t.type AS nom_type_piece 
            FROM members m
            LEFT JOIN departements d ON m.idDepartement = d.idDepartements
            LEFT JOIN communes c ON m.idCommune = c.idCommunes
            LEFT JOIN arrondissements a ON m.idArrondissement = a.idArrondissements
            LEFT JOIN udopers u ON m.idUdoper = u.idUdopers
            LEFT JOIN type_piece_identite t ON m.idTypePieceIdentite = t.id WHERE idMembers = $id";

    $stmt = $DB->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

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

$member = getMember($memberId);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tableau de bord - Générateur de carte membre</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/logo-anoper.jpg" sizes="180x180">
    <link rel="icon" href="../assets/logo-anoper.jpg" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png../assets/logo-anoper.jpg" sizes="16x16" type="image/png">
    <link rel="icon" href="../assets/logo-anoper.jpg">
    <meta name="theme-color" content="#712cf9">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Autres liens CSS et balises <style> -->


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once("./includes/sidebar.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once("./includes/topbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php require_once("./includes/edit_page_heading.php"); ?>
                    <?php require_once("./datas/edit/index.php"); ?>

                    <!-- Content Row -->

                    <!-- Content Row -->
                  
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require_once("./includes/footer.php"); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Scripts Bootstrap et jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./datas/edit/script.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Lien vers le fichier JavaScript de SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>



    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>