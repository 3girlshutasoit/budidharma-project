<?php  session_start();
require_once("../controller/controlentrikelasmapel.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$ridkp		= $_POST['ridkp'];
	$ridpelp	= $_POST['ridpelp'];
	$controll = new entriKelasMapel();
	$data = $controll->entricontrolKelasMapel($ridkp, $ridpelp);
    echo json_encode($data);
}
?>