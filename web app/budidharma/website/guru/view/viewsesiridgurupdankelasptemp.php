<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$varridkelas 				= $_POST['varridkelas'];
	$_SESSION['varridkelas']	= $varridkelas;

	$ridkelasp 					= $_SESSION['varridkelas'];
	$gurup 						= $_SESSION['ridgurup'];

	$data = array(
		array(
    	"gurup"		=> $gurup,
    	"ridkelasp"	=> $ridkelasp
		)
	);
	echo json_encode($data);
}
?>