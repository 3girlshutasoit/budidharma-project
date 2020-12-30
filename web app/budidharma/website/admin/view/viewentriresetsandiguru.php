<?php  session_start();
require_once("../controller/controlentriresetsandiguru.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$idr		= $_POST['idr'];
	$controll = new entriResetUserGuru();
	$data = $controll->entricontrolResetUserGuru($idr);
    echo json_encode($data);
}
?>