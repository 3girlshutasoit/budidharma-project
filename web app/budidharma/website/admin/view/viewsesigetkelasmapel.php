<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$ridkp		= $_SESSION['varridk'];
$ridpelp	= $_SESSION['varridpel'];

	$data = array(
		array(
    	"ridkp"	=> $ridkp,
    	"ridpelp"	=> $ridpelp
		)
	);
	echo json_encode($data);
}
?>