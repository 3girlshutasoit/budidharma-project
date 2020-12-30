<?php  session_start();
require_once("../controller/controldaftarkelassiswaforguru.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$kelasp = $_POST['kelasp'];
	$controll = new DataKelasSiswaForGuru();
	$data = $controll->controlDataKelasSiswaForGuru($kelasp);
    echo json_encode($data);
}
?>