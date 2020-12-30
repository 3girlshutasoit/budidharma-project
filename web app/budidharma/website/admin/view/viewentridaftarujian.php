<?php  session_start();
require_once("../controller/controlentridaftarujian.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$tap	= $_POST['tap'];
	$bup	= $_POST['bup'];
	$kup	= $_POST['kup'];
	$controll = new entriDaftarUjian();
	$data = $controll->entricontrolDaftarUjian($tap, $bup, $kup);
    echo json_encode($data);
}
?>