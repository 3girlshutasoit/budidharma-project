<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$ridtaktifp		= $_SESSION['varridtaktif'];
$ridbuaktifp	= $_SESSION['varridbuaktif'];
$ridkip 		= $_SESSION['varridki'];

	$data = array(
		array(
    	"ridtaktifp"	=> $ridtaktifp,
    	"ridbuaktifp"	=> $ridbuaktifp,
    	"ridkip"		=> $ridkip
		)
	);
	echo json_encode($data);
}
?>