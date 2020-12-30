<?php  session_start();
require_once("../controller/controldaftarpelajaranforguru.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$gurup = $_POST['gurup'];
	$kelasp = $_POST['kelasp'];
	$controll = new DataDaftarPelajaranForGuru();
	$data = $controll->controlDataDaftarPelajaranForGuru($gurup, $kelasp);
    echo json_encode($data);
}
?>