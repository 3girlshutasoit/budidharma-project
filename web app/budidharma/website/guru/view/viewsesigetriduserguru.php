<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$riduserp	= $_SESSION['riduserp'];

	$data = array(
		array(
    	"riduser"	=> $riduserp
		)
	);
	echo json_encode($data);
}
?>