<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$ridta		= $_SESSION['varridta'];
$ridkelas	= $_SESSION['varridk'];

	$data = array(
		array(
    	"ridtap"	=> $ridta,
    	"ridkelasp"	=> $ridkelas
		)
	);
	echo json_encode($data);
}
?>