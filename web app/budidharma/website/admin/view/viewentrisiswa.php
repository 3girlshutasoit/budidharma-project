<?php  session_start();
require_once("../controller/controlentrisiswa.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$nis = $_POST['nis'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$nohp = $_POST['nohp'];
	$email = $_POST['email'];
	$controll = new entriSiswa();
	$data = $controll->entricontrolSiswa($nis, $nama, $alamat, $nohp, $email);
	echo json_encode($data);
}
?>