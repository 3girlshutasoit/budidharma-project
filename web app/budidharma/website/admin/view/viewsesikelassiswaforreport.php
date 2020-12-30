<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$vkelasp	= $_POST['varkelasp'];
	$vsiswap	= $_POST['varsiswap'];
	
	$_SESSION['vkelasp']	= $vkelasp;
	$_SESSION['vsiswap']	= $vsiswap;

	}
?>