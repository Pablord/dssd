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
        <h4>CLOUD COMPUTING</h4> <a href='listFiles.php' class='btn btn-sm success'>Tus Archivos</a> <a  href='#' class='btn btn-sm'>Crear Archivo</a> <a class='logout btn btn-sm success' href='logout.php'>Salir</a><br/><br/>";

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

    header('Location: https://dssd-grupo12.herokuapp.com/listFiles.php');
}else{
  echo "<h3>Crear Archivo</h3><form action='crearArchivo.php' method='post'>
<input type='text' name='filename' placeholder='Nombre de Archivo'>  
<input type='submit' text='Crear'>
</form>";
}


 ?>

</body>
</html>