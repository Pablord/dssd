<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>DSSD Grupo 12</title>

<style type="text/css">
<!--

body { margin: 0px;  background-color: #F4F6F6;}

.background {
	width: 100%;
    height: 100%;
    margin: 0;
    padding: 0; 
}

/* 
http://jsfiddle.net/6KaMy/1/
is there a better way than the absolute positioning and negative margin.
It has the problem that the content will  will be cut on top if the window is smalller than the content.
*/

.content {
	height: 400px;
	padding-top: 48px;
	width: 300px; 
	text-align: center;
	position:absolute;
    left:0; right:0;
    top:0; bottom:0;
	margin:auto;
	
	max-width:100%;
	max-height:100%;
	overflow:auto;
}

.btn{display:inline-block;padding:6px 12px;border:2px solid #ddd;color:#ddd;text-decoration:none;font-weight:700;text-transform:uppercase;margin:15px 5px 0;transition:all .2s;min-width:100px;text-align:center;font-size:14px}
.btn:hover,.btn.hover{background:#ddd;color:#777}
.btn.btn-lg{padding:10px 16px;font-size:18px}
  .btn.success{border-color:#27ae60;color:#27ae60}
.btn.success:hover,.btn.success.hover{background:#27ae60;color:#fff}
-->
</style>
</head>


<body>

<?php
require_once '../vendor/autoload.php';
 
session_start();
require("initClient.php");

if (!$client->getAccessToken() && !isset($_SESSION['token'])) {
    $authUrl = $client->createAuthUrl();
    print "<div class=background>
		<div class=content ><h1 style='margin-bottom: 0px; padding-bottom: 0px;'>DSSD - Grupo 12</h1>
		<h3>CLOUD COMPUTING</h3><br/><br/><br/><a href='$authUrl' class='login btn btn-lg success'>Conectar a Google Drive</a></div> </div>
 ";
}else{
	header('Location: https://dssd-grupo12.herokuapp.com/listFiles.php');
}

?> 
</body>
</html>