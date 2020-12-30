<?php  session_start();
require_once("../controller/controlentrigurumapel.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$ridgurup		= $_POST['ridgurup'];
	$ridkelasmapelp = $_POST['ridkelasmapelp'];
	$statusp		= $_POST['statusp'];
	$controll = new entriGuruMapel();
	$data = $controll->entricontrolGuruMapel($ridgurup, $ridkelasmapelp, $statusp);
    echo json_encode($data);
}
?>