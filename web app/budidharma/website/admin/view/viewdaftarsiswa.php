<?php  session_start();
require_once("../controller/controldaftarsiswa.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$nis = $_POST['nis'];
	$nama = $_POST['nama'];
	$controll = new Siswa();
	$data = $controll->controlSiswa($nis, $nama);
    echo json_encode($data);
}
?>