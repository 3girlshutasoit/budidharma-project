<?php  session_start();
require_once("../controller/controldaftartotalnilaimid.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$kelasp = $_POST['kelasp'];
	$siswap = $_POST['siswap'];
	$gurup = $_POST['gurup'];
	$controll = new DataDaftarTotalNilaiMid();
	$data = $controll->controlDataDaftarTotalNilaiMid($kelasp, $siswap, $gurup);
    echo json_encode($data);
}
?>