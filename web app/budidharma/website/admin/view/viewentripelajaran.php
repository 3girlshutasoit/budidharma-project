<?php  session_start();
require_once("../controller/controlentripelajaran.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$nama = $_POST['nama'];
	$controll = new entriPelajaran();
	$data = $controll->entricontrolPelajaran($nama);
	echo json_encode($data);
}
?>