<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$varridkelassiswa = $_POST['varridkelassiswa'];
	$varridnamakelas = $_POST['varridnamakelas'];
	$varridnamasiswa = $_POST['varridnamasiswa'];
	
	$_SESSION['varridkelassiswa']	= $varridkelassiswa;
	$_SESSION['varridnamakelas']	= $varridnamakelas;
	$_SESSION['varridnamasiswa']	= $varridnamasiswa;
	}
?>