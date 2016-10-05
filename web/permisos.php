<?php
//require_once 'google-api-php-client-2.0.3/vendor/autoload.php';
//require_once '../vendor/autoload.php'; 
require_once '../google-api-php-client-2.0.3/vendor/autoload.php';
session_start();
require("initClient.php");

print "<a  href='listFiles.php'>Lista Archivos</a> - <a  href='crearArchivo.php'>Crear Archivo</a> - <a class='logout' href='logout.php'>Salir</a><br/><br/>";
//print_r($_SESSION['token']);
    $client->setAccessToken($_SESSION['token']);
    $service = new Google_Service_Drive($client); 
      $fileID = $_GET['id']; 
      $nombre = $_GET['nombre'];

    echo "<h3>Archivo: ".$nombre."</h3>";

echo "<form action='agregarPermiso.php' method='post'>
compartir con <input type='text' id='mail' name='mail'> <input type='hidden' id='idfile' name='idfile' value='".$fileID."'> <input type='hidden' id='nombre' name='nombre' value='".$nombre."'> <input type='submit' value='compartir'>
</form>";

    echo "<h4>Usuarios con permisos</h4>";

    try {
       //echo "archivo ".$fileID."<br/>";
    $permissions = $service->permissions->listPermissions($fileID);
    foreach ($permissions->permissions as $perm) {
      $optParams = array('fields' => 'emailAddress, role');
       $permi = $service->permissions->get($fileID, $perm->id, $optParams);
     //print_r($permi);echo"<br/><br/><br/>";
     echo $permi->emailAddress." (".$permi->role.")";
     if($permi->role != "owner"){
      echo "  -  <a href='removerPermiso.php?id=".$perm->id."&fileid=".$fileID."&nombre=".$nombre."'>remover acceso</a><br/>";
     }else{
      echo "<br/>";
     }
    }
    
  } catch (Exception $e) {
    //print "An error occurred: " . $e->getMessage();
    echo "No se pudieron recuperar los permisos. Posible razon: no sos owner del archivo.";
  }

    // Get cURL resource
 