<?php  session_start();
require_once("../controller/controldaftarkelasmapel.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$kelasp = $_POST['kelasp'];
	$mapelp = $_POST['mapelp'];
	$controll = new DataKelasMapel();
	$data = $controll->controlDataKelasMapel($kelasp, $mapelp);
    echo json_encode($data);
}
?>