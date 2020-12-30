<?php  session_start();
require_once("../controller/controldaftartahunajaran.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$taps = $_POST['taps'];
	$semp = $_POST['semp'];
	$controll = new TahunAjaran();
	$data = $controll->controlTahunAjaran($taps, $semp);
    echo json_encode($data);
    }
?>