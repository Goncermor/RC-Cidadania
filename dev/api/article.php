<?php
require 'require/database.php';
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    $response = [
        'status' => 'error',
        'message' => 'Parameter id must be set'
    ];
    echo json_encode($response);
    die;
}

$id = $_GET['id'];

try {
    $objectId = new MongoDB\BSON\ObjectId($id);
} catch (Exception $e) {
    $response = [
        'status' => 'error',
        'message' => 'Invalid ObjectId'
    ];
    echo json_encode($response);
    die;
}

$collection = $database->selectCollection('articles');
$document = $collection->findOne(['_id' => $objectId]);

if ($document === null) {
    $response = [
        'status' => 'error',
        'message' => 'Article not found'
    ];
    echo json_encode($response);
    die;
}

$article = [
    'title' => (string) $document->title,
    'author' => (string) $document->author,
    'cards' => (array) $document->cards,
    'content' => (array) $document->cards,
    'date' => (string) $document->date
];

echo json_encode($article);
?>