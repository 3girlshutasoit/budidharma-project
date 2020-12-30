<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$ridgurup		= $_SESSION['varridguru'];
$ridkelasmapelp	= $_SESSION['varridkelasmapel'];

	$data = array(
		array(
    	"ridgurup"			=> $ridgurup,
    	"ridkelasmapelp"	=> $ridkelasmapelp
		)
	);
	echo json_encode($data);
}
?>