<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Permisos del Archivo</title>

<style type="text/css">
<!--

body { margin: 0px;  background-color: #F4F6F6;}

.background {
    
    margin: 0;
    padding: 0; 
}

/* 
http://jsfiddle.net/6KaMy/1/
is there a better way than the absolute positioning and negative margin.
It has the problem that the content will  will be cut on top if the window is smalller than the content.
*/

.content {
     
    text-align: center;
    position:absolute;
    left:0; right:0;
    top:0; bottom:0;
    margin:auto;
     
    overflow:auto;
}

.btn{display:inline-block;padding:6px 12px;border:2px solid #ddd;color:#ddd;text-decoration:none;font-weight:700;text-transform:uppercase;margin:15px 5px 0;transition:all .2s;min-width:100px;text-align:center;font-size:14px}
.btn:hover,.btn.hover{background:#ddd;color:#777}
.btn.btn-sm{padding:5px 10px;font-size:12px}
  .btn.success{border-color:#27ae60;color:#27ae60}
.btn.primary{border-color:#3498db;color:#3498db}
.btn.success:hover,.btn.success.hover{background:#27ae60;color:#fff}
.btn.primary:hover,.btn.primary.hover{background:#3498db;color:#fff}
-->
</style>
 
</head>


<body>



<?php
require_once '../vendor/autoload.php'; 
 
session_start();
require("initClient.php");

print "<div class=background>
        <div class=content ><h3 style='margin-bottom: 0px; padding-bottom: 0px;'>DSSD - Grupo 12</h3>
        <h4>CLOUD COMPUTING</h4> <a href='listFiles.php' class='btn btn-sm success'>Tus Archivos</a> <a  href='crearArchivo.php' class='btn btn-sm success'>Crear Archivo</a> <a class='logout btn btn-sm success' href='logout.php'>Salir</a><br/><br/>";
//print_r($_SESSION['token']);
    $client->setAccessToken($_SESSION['token']);
    $service = new Google_Service_Drive($client); 
      $fileID = $_GET['id']; 
      $nombre = $_GET['nombre'];

    echo "<br/><h3>Archivo: ".$nombre."</h3>";

echo "<h4>Compartir</h4><form action='agregarPermiso.php' method='post'>
<input type='text' id='mail' name='mail' placeholder='Mail'> <input type='hidden' id='idfile' name='idfile' value='".$fileID."'> <input type='hidden' id='nombre' name='nombre' value='".$nombre."'> <input type='submit' value='compartir'>
</form>";

    echo "<br/><h4>Permisos</h4>";

    try {
       //echo "archivo ".$fileID."<br/>";
    $permissions = $service->permissions->listPermissions($fileID);
    foreach ($permissions->permissions as $perm) {
      $optParams = array('fields' => 'emailAddress, role');
       $permi = $service->permissions->get($fileID, $perm->id, $optParams);
     //print_r($permi);echo"<br/><br/><br/>";
     echo $permi->emailAddress." (".$permi->role.")";
     if($permi->role != "owner"){
      echo "   <a href='removerPermiso.php?id=".$perm->id."&fileid=".$fileID."&nombre=".$nombre."' class='btn btn-sm primary'>remover acceso</a><br/>";
     }else{
      echo "<br/>";
     }
    }
    
  } catch (Exception $e) {
    //print "An error occurred: " . $e->getMessage();
    echo "No se pudieron recuperar los permisos. Posible razon: no sos owner del archivo.";
  }

    // Get cURL resource
 ?>

</body>
</html>