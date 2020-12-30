<?php  session_start();
require_once("../controller/controlentridatasiswa.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$riddkp		= $_POST['riddkp'];
	$ridsiswap	= $_POST['ridsiswap'];
	$statusp	= $_POST['statusp'];
	$ketp		= $_POST['ketp'];
	$controll = new entriDatasiswa();
	$data = $controll->entricontrolDatasiswa($riddkp, $ridsiswap, $statusp, $ketp);
    echo json_encode($data);
}
?>