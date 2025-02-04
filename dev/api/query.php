<?php
require 'require/database.php';
header('Content-Type: application/json');


if (!isset($_GET['q'])) {
    $cfg['status'] = 'error';
    $cfg['message'] = 'Parameter q must be set';
    echo json_encode($cfg);
    die;
}


$collection = $database->selectCollection('articles');



$documents = $collection->find(['title' => ['$regex' => $_GET['q'], '$options' => 'i']],[
    'sort' => ['date' => -1], 
]);

$articleList = [];

foreach ($documents as $document) {
    $obj['id'] = (string) $document->_id;
    $obj['title'] = (string) $document->title;
    $obj['author'] = (string) $document->author;
    $obj['date'] = (string) $document->date;
    $obj['cover'] = (string) $document->cover;

    $articleList[] = $obj;
}
$data['status'] = 'ok';
$data['articles'] = $articleList;


//if ($documents == NULL) {
//    $data['status'] = 'error';
//    $cfg['message'] = 'Configuration key not found';
//} else {
//    $cfg['status'] = 'ok';
//    $cfg['articles'] = ;
//}


echo json_encode($data);

?>