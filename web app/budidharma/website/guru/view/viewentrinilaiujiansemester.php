<?php  session_start();
require_once("../controller/controlentrinilaisemester.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$riduserp	= $_POST['riduserp'];
	$ridgurup	= $_POST['ridgurup'];
	$ridksp		= $_POST['ridksp'];
	$ridkup		= $_POST['ridkup'];
	$ridpep		= $_POST['ridpep'];
	$nilai		= $_POST['nilai'];
		$controll = new entriNilaiSemester();
		$data = $controll->entricontrolNilaiSemester($riduserp, $ridgurup, $ridksp, $ridkup, $ridpep, $nilai);
    echo json_encode($data);
}
?>