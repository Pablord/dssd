<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Tus Archivos</title>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/api.js"></script>
<script type="text/javascript">
    
   

    $(document).ready(function(){
    $('.boton').click(function() {
  init = function() {
        s = new gapi.drive.share.ShareClient();
        s.setOAuthToken(<?php echo $_SESSION['token']; ?>);
        s.setItemIds(['0B5yF3Vi03uX_LVFsZVlCbHhYTWs']);
    }
    gapi.load('drive-share', init);
    s.showSettingsDialog();
});
});
</script>
</head>


<body>

<?php
require_once '../vendor/autoload.php'; 
 
session_start();
require("initClient.php");


print "<div class=background>
        <div class=content ><h3 style='margin-bottom: 0px; padding-bottom: 0px;'>DSSD - Grupo 12</h3>
        <h4>CLOUD COMPUTING</h4> <a href='#' class='btn btn-sm'>Tus Archivos</a> <a  href='crearArchivo.php' class='btn btn-sm success'>Crear Archivo</a> <a class='logout btn btn-sm success' href='logout.php'>Salir</a><br/><br/>";
    $client->setAccessToken($_SESSION['token']);
    $service = new Google_Service_Drive($client); 
    $results = $service->files->listFiles();
     
 
    echo "<table style='width: 450px; left:0; right:0;
    top:0; bottom:0;
    margin:auto;
     
    overflow:auto;'> ";
    foreach ($results->files as $file) {
        $nombreArchivo = $file->name;
        if(strlen($nombreArchivo) > 50) $nombreArchivo = substr($nombreArchivo, 0, 50).'...';
    	echo "<tr>"; 
        echo "<td style='text-align: left;'>".$nombreArchivo . "</td>";
        echo "<td><a href='permisos.php?id=" .  $file->id . "&nombre=".$nombreArchivo."' class='btn btn-sm primary'>PERMISOS</a></td>"; 
        echo "</tr>";
    }
    echo "</table></div></div>";
    
?>
 
</body>
</html>