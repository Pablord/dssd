<?php
require_once 'google-api-php-client-2.0.3/vendor/autoload.php';
 
session_start();
require("initClient.php");
  

$client->setAccessToken($_SESSION['token']);

$service = new Google_Service_Drive($client);

$service->getClient()->setUseBatch(true);
$fileId = $_POST['idfile'];
$nombre = $_POST['nombre'];

try {
  $batch = $service->createBatch();

  $userPermission = new Google_Service_Drive_Permission(array(
    'type' => 'user',
    'role' => 'writer',
    'emailAddress' => $_POST['mail']
  ));
  $request = $service->permissions->create(
    $fileId, $userPermission, array('fields' => 'emailAddress, id'));
  $batch->add($request, 'user');
  
  $results = $batch->execute();

  //foreach ($results as $result) {
   // if ($result instanceof Google_Service_Exception) {
      // Handle error
  //    printf($result);
   // } else {
   //   printf("Permission ID: %s\n", $result->emailAddress . "   " . $result->id);
   // }
  //}
} finally {
  $service->getClient()->setUseBatch(false);
 

  
  header('Location: http://elpsico.com/distri/permisos.php?id='.$fileId.'&nombre='.$nombre);
}