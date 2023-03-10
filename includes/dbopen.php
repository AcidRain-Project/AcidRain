<?php
$http_host = $_SERVER['HTTP_HOST'];



$DbHost = "localhost";
$DbName = "sun";
$DbUser = "root";
$DbPass = "dlWkd364#$0081";





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