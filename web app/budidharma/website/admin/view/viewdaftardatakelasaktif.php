<?php  session_start();
require_once("../controller/controldaftardatakelasaktif.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$tap = $_POST['tap'];
	$kelas = $_POST['kelas'];
	$controll = new DataKelasAktif();
	$data = $controll->controlDataKelasAktif($tap, $kelas);
    echo json_encode($data);
}
?>