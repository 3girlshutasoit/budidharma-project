<?php  session_start();
require_once("../controller/controlentriguru.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$nip = $_POST['nip'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$nohp = $_POST['nohp'];
	$email = $_POST['email'];
	$controll = new entriGuru();
	$data = $controll->entricontrolGuru($nip, $nama, $alamat, $nohp, $email);
	echo json_encode($data);
}
?>