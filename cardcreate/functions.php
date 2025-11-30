<?php
require_once '../configs/databaseconnect.php';

function getAllMembers()
{
    $DB = new connexionDB();

    $sql = "SELECT m.*, 
                   d.name AS nom_departement, 
                   c.name AS nom_commune, 
                   a.name AS nom_arrondissement, 
                   u.name AS nom_udoper, 
                   t.type AS nom_type_piece,
                   z.nom AS z_nom,          
                   z.prenom AS z_prenom       
            FROM members m
            LEFT JOIN departements d ON m.idDepartement = d.idDepartements
            LEFT JOIN communes c ON m.idCommune = c.idCommunes
            LEFT JOIN arrondissements a ON m.idArrondissement = a.idArrondissements
            LEFT JOIN udopers u ON m.idUdoper = u.idUdopers
            LEFT JOIN type_piece_identite t ON m.idTypePieceIdentite = t.id
            LEFT JOIN users z ON m.user_id = z.id
            WHERE m.archived = 0";

    $stmt = $DB->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getMembersByUser72($userId)
{
    $DB = new connexionDB();

    $sql = "SELECT m.*, 
                   d.name AS nom_departement, 
                   c.name AS nom_commune, 
                   a.name AS nom_arrondissement, 
                   u.name AS nom_udoper, 
                   t.type AS nom_type_piece,
                   z.nom AS z_nom,          
                   z.prenom AS z_prenom      
            FROM members m
            LEFT JOIN departements d ON m.idDepartement = d.idDepartements
            LEFT JOIN communes c ON m.idCommune = c.idCommunes
            LEFT JOIN arrondissements a ON m.idArrondissement = a.idArrondissements
            LEFT JOIN udopers u ON m.idUdoper = u.idUdopers
            LEFT JOIN type_piece_identite t ON m.idTypePieceIdentite = t.id
            LEFT JOIN users z ON m.user_id = z.id
            WHERE m.user_id = :userId 
              AND m.date_time >= NOW() - INTERVAL 72 HOUR
              AND m.archived = 0";

    $stmt = $DB->query($sql, array('userId' => $userId));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function isAdmin($userId)
{
    $DB = new connexionDB();

    $sql = "SELECT * 
            FROM users 
            WHERE id = :userId 
              AND admin = 1";

    $stmt = $DB->query($sql, array('userId' => $userId));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return count($result) > 0;
}

// Autres fonctions (formatDateFrench, removeLeadingDots, etc.)
function formatDateFrench($dateStr) {
    return (new DateTime($dateStr))->format('d/m/Y');
}

function formatDateFrenchWithTime($dateStr) {
    return (new DateTime($dateStr))->format('d/m/Y à H:i:s');
}

function removeLeadingDots($filePath) {
    return preg_replace('/^\.\.\//', '', $filePath);
}
?>
