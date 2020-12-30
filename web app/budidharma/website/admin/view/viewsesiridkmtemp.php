<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$varridkelasmapel = $_POST['varridkelasmapel'];
	
	$_SESSION['varridkelasmapel']	= $varridkelasmapel;
	}
?>