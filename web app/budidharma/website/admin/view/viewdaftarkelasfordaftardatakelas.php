<?php  session_start();
require_once("../controller/controldaftarkelas.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$namak = $_POST['namak'];
	$controll = new Kelas();
	$data = $controll->controlKelas($namak);
	echo json_encode($data);
}
?>