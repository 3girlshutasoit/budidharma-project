<?php  session_start();
require_once("../controller/controldaftarbulanujian.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$nama = $_POST['nama'];
	$status = $_POST['status'];
	$controll = new blnUjian();
	$data = $controll->controlBU($nama, $status);
    echo json_encode($data);
}
?>