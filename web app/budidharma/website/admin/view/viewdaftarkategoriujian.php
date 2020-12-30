<?php  session_start();
require_once("../controller/controldaftarkategoriujian.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$nama = $_POST['nama'];
	$controll = new KategoriUjian();
	$data = $controll->controlKategoriUjian($nama);
	echo json_encode($data);
}
?>