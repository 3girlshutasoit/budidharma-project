<?php  session_start();
require_once("../controller/controlupdatebulanujian.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$ridbup = $_POST['ridbup'];
	$status = $_POST['status'];
	$controll = new entriUpdblnUjian();
	$data = $controll->entricontrolUpdBU($ridbup, $status);
    echo json_encode($data);
}
?>