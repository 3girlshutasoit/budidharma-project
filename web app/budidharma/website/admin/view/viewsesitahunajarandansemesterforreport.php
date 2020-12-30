<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$vta		= $_POST['varta'];
	$vsemester	= $_POST['varsemester'];
	
	$_SESSION['vta']		= $vta;
	$_SESSION['vsemester']	= $vsemester;

	}
?>