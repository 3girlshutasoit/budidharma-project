<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$varbsp = $_POST['sem'];
	
	$_SESSION['varbsp']	= $varbsp;
	}
?>