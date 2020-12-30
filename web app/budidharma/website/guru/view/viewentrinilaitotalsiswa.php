<?php  session_start();
require_once("../controller/controlentrinilaitotalsiswa.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$riduserp		= $_POST['riduserp'];
	$ridgurup		= $_POST['ridgurup'];
	$ridksp			= $_POST['ridksp'];
	$ridpelajaranp	= $_POST['ridpelajaranp'];
	$bbp			= $_POST['bbp'];
	$bmp			= $_POST['bmp'];
	$bsp			= $_POST['bsp'];
	$nilaip			= $_POST['nilaip'];
		$controll = new entriNilaiTotalSiswa();
		$data = $controll->entricontrolNilaiTotalSiswa($riduserp, $ridgurup, $ridksp, $ridpelajaranp, $bbp, $bmp, $bsp, $nilaip);
    echo json_encode($data);
}
?>