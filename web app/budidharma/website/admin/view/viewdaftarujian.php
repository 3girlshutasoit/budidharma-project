<?php  session_start();
require_once("../controller/controldaftarujian.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$tap = $_POST['tap'];
	$kup = $_POST['kup'];
	$controll = new DataDaftarUJian();
	$data = $controll->controlDataDaftarUJian($tap, $kup);
    echo json_encode($data);
}
?>