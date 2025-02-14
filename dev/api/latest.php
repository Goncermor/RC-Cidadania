<?php
require 'require/database.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$collection = $database->selectCollection('articles');
$documents = $collection->find([],[
    'sort' => ['date' => -1], 
    'limit' => 4
]);

$articleList = [];

foreach ($documents as $document) {
    $obj['id'] = (string) $document->_id;
    $obj['title'] = (string) $document->title;
    $obj['description'] = (string) $document->description;
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