<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$nilaip	= $_SESSION['varnilaip'];

	$data = array(
		array(
    	"nilaip"	=> $nilaip
		)
	);
	echo json_encode($data);
}
?>