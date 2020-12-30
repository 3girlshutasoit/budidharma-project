<?php  session_start();
require_once("../controller/controldaftarujianforguru.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$controll = new DataDaftarUJianForGuru();
	$data = $controll->controlDataDaftarUJianForGuru();
    echo json_encode($data);
}
?>