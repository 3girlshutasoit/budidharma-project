<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$ridtap		= $_SESSION['varridta'];

	$data = array(
		array(
    	"ridtap"	=> $ridtap
		)
	);
	echo json_encode($data);
}
?>