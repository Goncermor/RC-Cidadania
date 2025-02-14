<?php
require 'require/database.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if (!isset($_GET['key'])) {
    $cfg['status'] = 'error';
    $cfg['message'] = 'Parameter key must be set';
    echo json_encode($cfg);
    die;
}

$collection = $database->selectCollection('config');
$document = $collection->findOne(['_id' => $_GET['key']]);

if ($document == NULL) {
    $cfg['status'] = 'error';
    $cfg['message'] = 'Configuration key not found';
} else {
    $cfg['status'] = 'ok';
    $cfg['value'] = $document['value'];
}
echo json_encode($cfg);

?>