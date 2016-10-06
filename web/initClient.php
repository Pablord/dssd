<?php
//require_once 'google-api-php-client-2.0.3/vendor/autoload.php';
require_once '../vendor/autoload.php';
//require_once '../google-api-php-client-2.0.3/vendor/autoload.php';
session_start();

$client = new Google_Client();
// Get your credentials from the console
$client->setClientId('937444844992-d2rkg439cva6ekb4dap2fd7cui3im3ik.apps.googleusercontent.com');
$client->setClientSecret('FqWA-hy9gcObNuBxSWwkOvFC');
$client->setRedirectUri('https://dssd-grupo12.herokuapp.com/loggedin.php');
$client->setScopes(array(
    'https://www.googleapis.com/auth/drive'
));