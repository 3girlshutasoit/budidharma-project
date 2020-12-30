<?php  session_start();
require_once("../controller/controldaftartotalnilaibulanan.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$kelasp = $_POST['kelasp'];
	$siswap = $_POST['siswap'];
	$gurup = $_POST['gurup'];
	$controll = new DataDaftarTotalNilaiBulanan();
	$data = $controll->controlDataDaftarTotalNilaiBulanan($kelasp, $siswap, $gurup);
    echo json_encode($data);
}
?>