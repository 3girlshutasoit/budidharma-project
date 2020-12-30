<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$ridbup		= $_SESSION['varridbu'];

	$data = array(
		array(
    	"ridbup"	=> $ridbup
		)
	);
	echo json_encode($data);
}
?>