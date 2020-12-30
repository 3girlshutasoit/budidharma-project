<?php  session_start();
require_once("../controller/controldaftardatasiswa.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$tap = $_POST['tap'];
	$kelasp = $_POST['kelasp'];
	$controll = new DataSiswa();
	$data = $controll->controlDataSiswa($tap, $kelasp);
    echo json_encode($data);
}
?>