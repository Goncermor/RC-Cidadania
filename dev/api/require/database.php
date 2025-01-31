<?php

require '../../vendor/autoload.php';
$uri = "mongodb+srv://goncermor:Goncermor%402007@cluster0.op15h.mongodb.net/";

$client = new MongoDB\Client($uri);
$database = $client->selectDatabase('EcoTirso');

?>