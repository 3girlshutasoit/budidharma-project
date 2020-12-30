<?php  session_start();
require_once("../controller/controlentriiduserguru.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$gurup		= $_POST['gurup'];
	$nmuserins	= $_POST['nmuserins'];
	$controll = new entriIdUserGuru();
	$data = $controll->entricontrolIdUserGuru($gurup, $nmuserins);
    echo json_encode($data);
}
?>