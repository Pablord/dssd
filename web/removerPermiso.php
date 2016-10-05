<?php
//require_once 'google-api-php-client-2.0.3/vendor/autoload.php';
//require_once '../vendor/autoload.php'; 
require_once '../google-api-php-client-2.0.3/vendor/autoload.php';
session_start();
require("initClient.php");
  

$client->setAccessToken($_SESSION['token']);

$service = new Google_Service_Drive($client);

$service->getClient()->setUseBatch(true);
 $nombre = $_GET['nombre'];


try {
  $permID = $_GET['id'];
$fileId = $_GET['fileid'];
  $batch = $service->createBatch();

  
 $request = $service->permissions->delete(
    $fileId, $permID);
  $batch->add($request, 'user');
  
  $results = $batch->execute();

  foreach ($results as $result) {
   print_r($result);
  }
} finally {
  $service->getClient()->setUseBatch(false);
 header('Location: http://elpsico.com/distri/permisos.php?id='.$fileId.'&nombre='.$nombre);
}