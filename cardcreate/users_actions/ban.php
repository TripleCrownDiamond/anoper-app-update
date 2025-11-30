<?php
include '../../configs/databaseconnect.php'; // Changez cela selon votre structure

$data = json_decode(file_get_contents("php://input"));
$userId = $data->id;

$response = array();

$query = $DB->query("UPDATE users SET active = 0 WHERE id = $userId");
if ($query) {
    $response["success"] = true;
} else {
    $response["success"] = false;
}

echo json_encode($response);
?>
