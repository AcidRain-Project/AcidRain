<?php
$http_host = $_SERVER['HTTP_HOST'];



$DbHost = "localhost";
$DbName = "lnc_learningbox_dev";
$DbUser = "websitesuper";
$DbPass = "websitesuper!@2019";

$DbLinkSiteMode = "dev";




try {
	$DbConn = new PDO("mysql:host=$DbHost;dbname=$DbName;charset=utf8", $DbUser, $DbPass);
	$DbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "Connection failed: " . $e->getMessage();
}

//======= 콘텐츠 관리 용 =================
try {
	$DbConn_Box = new PDO("mysql:host=$DbHost;dbname=$DbName;charset=utf8", $DbUser, $DbPass);
	$DbConn_Box->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "Connection failed: " . $e->getMessage();
}
//======= 콘텐츠 관리 용 =================
?>