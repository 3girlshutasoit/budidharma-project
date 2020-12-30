<?php  session_start();
require_once("../controller/controlupdatetahunajaran.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$ridtap = $_POST['ridtap'];
	$statusp = $_POST['statusp'];
	$controll = new entriUpdthnAjaran();
	$data = $controll->entricontrolUpdTA($ridtap, $statusp);
    echo json_encode($data);
}
?>