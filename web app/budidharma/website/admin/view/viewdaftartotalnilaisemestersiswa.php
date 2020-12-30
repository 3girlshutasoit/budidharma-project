<?php  session_start();
require_once("../controller/controldaftartotalnilaisemestersiswa.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$tap = $_POST['tap'];
	$semp = $_POST['semp'];
	$kelasp = $_POST['kelasp'];
	$siswap = $_POST['siswap'];
	$controll = new DataDaftarTotalNilaiSemesterSiswa();
	$data = $controll->controlDataDaftarTotalNilaiSemesterSiswa($tap, $semp, $kelasp, $siswap);
    echo json_encode($data);
}
?>