<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$varnilaip = $_POST['subtotal'];
	
	$_SESSION['varnilaip']	= $varnilaip;
	}
?>