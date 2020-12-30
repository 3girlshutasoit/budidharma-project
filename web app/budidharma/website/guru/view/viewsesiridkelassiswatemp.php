<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$varridks = $_POST['varridks'];
	$varridek = $_POST['varridek'];
	
	$_SESSION['varridks']	= $varridks;
	$_SESSION['varridek']	= $varridek;
	}
?>