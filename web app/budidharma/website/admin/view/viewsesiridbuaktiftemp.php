<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$varridbuaktif = $_POST['varridbuaktif'];
	
	$_SESSION['varridbuaktif']	= $varridbuaktif;
	}
?>