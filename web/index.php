<?php
require_once '../vendor/autoload.php';
//require_once '../google-api-php-client-2.0.3/vendor/autoload.php';
 
session_start();
require("initClient.php");

if (!$client->getAccessToken() && !isset($_SESSION['token'])) {
    $authUrl = $client->createAuthUrl();
    print "<a class='login' href='$authUrl'>Conectar</a>";
}else{
	header('Location: https://dssd-grupo12.herokuapp.com/listFiles.php');
}

?> 