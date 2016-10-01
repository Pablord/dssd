<?php
require_once 'vendor/autoload.php';
 
session_start();
require("initClient.php");

if (!$client->getAccessToken() && !isset($_SESSION['token'])) {
    $authUrl = $client->createAuthUrl();
    print "<a class='login' href='$authUrl'>Conectar</a>";
}else{
	header('Location: http://elpsico.com/distri/listFiles.php');
}

//echo("HOLA A TODOS");
?> 