<?php
//require_once 'google-api-php-client-2.0.3/vendor/autoload.php';
require_once '../google-api-php-client-2.0.3/vendor/autoload.php';
//require_once '../vendor/autoload.php';
session_start();
require("initClient.php");
  
print "<a  href='listFiles.php'>Lista Archivos</a> - <a class='logout' href='logout.php'>Salir</a><br/><br/>";

$client->setAccessToken($_SESSION['token']);

$service = new Google_Service_Drive($client);



if(isset($_POST['filename'])){
  $nombre = $_POST['filename'];

  //Insert a file
    $file = new Google_Service_Drive_DriveFile();

    
    $file->setName($nombre);
    //print_r($file);
    $file->setDescription('Creado usando la API de Drive.');
    $file->setMimeType('application/vnd.google-apps.document');

    
    //$data = file_get_contents('a.jpg');
   //   print_r($data);
    $createdFile = $service->files->create($file, array(
      //    'data' => $data, 
          'uploadType' => 'multipart'
        ));

    header('Location: http://elpsico.com/distri/listFiles.php');
}else{
  echo "<h3>Crear Archivo</h3><form action='crearArchivo.php' method='post'>
Nombre Archivo: <input type='text' name='filename'><br> 
<input type='submit'>
</form>";
}


 