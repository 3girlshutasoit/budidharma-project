<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$varbmp = $_POST['mid'];
	
	$_SESSION['varbmp']	= $varbmp;
	}
?>