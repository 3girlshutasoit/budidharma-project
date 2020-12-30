<?php  session_start();
require_once("../controller/controldaftartotalnilaisem.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$kelasp = $_POST['kelasp'];
	$siswap = $_POST['siswap'];
	$gurup = $_POST['gurup'];
	$controll = new DataDaftarTotalNilaiSem();
	$data = $controll->controlDataDaftarTotalNilaiSem($kelasp, $siswap, $gurup);
    echo json_encode($data);
}
?>