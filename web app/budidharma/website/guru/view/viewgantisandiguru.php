<?php  session_start();
require_once("../controller/controlgantisandiguru.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$sandilama		= $_POST['sandilama'];
	$sandibaru		= $_POST['sandibaru'];
	$idusergurup	= $_POST['idusergurup'];
	$controll = new entriGantiSandiGuru();
	$data = $controll->entricontrolGantiSandiGuru($sandilama, $sandibaru, $idusergurup);
    echo json_encode($data);
}
?>