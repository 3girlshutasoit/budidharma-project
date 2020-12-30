<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$ridgurup		= $_SESSION['varridguru'];

	$data = array(
		array(
    	"ridgurup"			=> $ridgurup
		)
	);
	echo json_encode($data);
}
?>