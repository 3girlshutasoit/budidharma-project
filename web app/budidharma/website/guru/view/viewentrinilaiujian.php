<?php  session_start();
require_once("../controller/controlentrinilaibulanan.php");
require_once("../controller/controlentrinilaimid.php");
require_once("../controller/controlentrinilaisemester.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$nama		= $_POST['nama'];
	$riduserp	= $_POST['riduserp'];
	$ridgurup	= $_POST['ridgurup'];
	$ridksp		= $_POST['ridksp'];
	$ridkup		= $_POST['ridkup'];
	$ridpep		= $_POST['ridpep'];
	$nilai		= $_POST['nilai'];
		$controll = new entriNilaiBulanan();
		$data = $controll->entricontrolNilaiBulanan("2", "5", "2", "1", "4", "78");
    echo json_encode($data);
}
?>