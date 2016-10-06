<?php
//require_once 'google-api-php-client-2.0.3/vendor/autoload.php';
require_once '../vendor/autoload.php';
//require_once '../google-api-php-client-2.0.3/vendor/autoload.php';
session_start();
require("initClient.php");

$client->authenticate($_GET['code']);
$_SESSION['token'] = $client->getAccessToken();
header('Location: https://dssd-grupo12.herokuapp.com/listFiles.php');