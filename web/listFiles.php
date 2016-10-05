<?php
//require_once 'google-api-php-client-2.0.3/vendor/autoload.php';
require_once '../vendor/autoload.php'; 
//require_once '../google-api-php-client-2.0.3/vendor/autoload.php';
session_start();
require("initClient.php");


print "<a  href='crearArchivo.php'>Crear Archivo</a> - <a class='logout' href='logout.php'>Salir</a><br/><br/>";
    $client->setAccessToken($_SESSION['token']);
    $service = new Google_Service_Drive($client); 
    $results = $service->files->listFiles();
     

    echo "<h3>Tus archivos:</h3>";
    echo "<table><tr>
    <th style='text-align:left'>Nombre</th>
    <th>-</th>
  </tr>";
    foreach ($results->files as $file) {
        $nombreArchivo = $file->name;
        if(strlen($nombreArchivo) > 50) $nombreArchivo = substr($nombreArchivo, 0, 50).'...';
    	echo "<tr>"; 
        echo "<td >".$nombreArchivo . "</td>";
        echo "<td><a href='permisos.php?id=" .  $file->id . "&nombre=".$nombreArchivo."'>PERMISOS</a></td>"; 
        echo "</tr>";
    }
    echo "</table>";
    
?>

<head>
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