<?php  session_start();
require_once("../controller/controldaftarnilaibulanan.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$kelasp = $_POST['kelasp'];
	$siswap = $_POST['siswap'];
	$nmpelp = $_POST['nmpelp'];
	$controll = new DataDaftarNilaiBulanan();
	$data = $controll->controlDataDaftarNilaiBulanan($kelasp, $siswap, $nmpelp);
    echo json_encode($data);
}
?>