<?php  session_start();
require_once("../controller/controlentribulanujian.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$nama = $_POST['nama'];
	$controll = new entriblnUjian();
	$data = $controll->entricontrolBU($nama, "nonaktif");
	echo json_encode($data);
}
?>