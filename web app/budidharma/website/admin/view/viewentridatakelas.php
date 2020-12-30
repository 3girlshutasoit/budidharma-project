<?php  session_start();
require_once("../controller/controlentridatakelas.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$ridtap = $_POST['ridtap'];
	$ridkelasp = $_POST['ridkelasp'];
	$controll = new entriDatakelas();
	$data = $controll->entricontrolDatakelas($ridtap, $ridkelasp);
    echo json_encode($data);
}
?>