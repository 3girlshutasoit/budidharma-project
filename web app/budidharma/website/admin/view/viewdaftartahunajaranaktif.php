<?php  session_start();
require_once("../controller/controldaftartahunajaranaktif.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$tap = $_POST['tap'];
	$semp = $_POST['semp'];
	$controll = new TahunAjaranAktif();
	$data = $controll->controlTahunAjaranAktif($tap, $semp);
    echo json_encode($data);
}
?>