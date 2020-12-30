<?php  session_start();
require_once("../controller/controlentrikelassiswa.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$tap	= $_POST['tap'];
	$kelasp	= $_POST['kelasp'];
	$siswap	= $_POST['siswap'];
	$controll = new entriKelasSiswa();
	$data = $controll->entricontrolKelasSiswa($tap, $kelasp, $siswap);
    echo json_encode($data);
}
?>