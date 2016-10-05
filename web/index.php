<?php
require_once 'google-api-php-client-2.0.3/vendor/autoload.php';
 
session_start();
require("initClient.php");

if (!$client->getAccessToken() && !isset($_SESSION['token'])) {
    $authUrl = $client->createAuthUrl();
    print "<a class='login' href='$authUrl'>Conectar</a>";
}else{
	header('Location: http://elpsico.com/distri/listFiles.php');
}

?> 