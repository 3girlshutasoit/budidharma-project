<?php  session_start();
require_once("../controller/controldaftargurumapel.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$kelasp = $_POST['kelasp'];
	$gurup = $_POST['gurup'];
	$controll = new DataGuruMapel();
	$data = $controll->controlDataGuruMapel($kelasp, $gurup);
    echo json_encode($data);
}
?>