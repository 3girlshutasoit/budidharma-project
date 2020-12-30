<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$_SESSION['varbbp']		= 0;
	$_SESSION['varbmp']		= 0;
	$_SESSION['varbsp']		= 0;
	$_SESSION['varnilaip']	= 0;

	$bbp	= $_SESSION['varbbp'];
	$bmp	= $_SESSION['varbmp'];
	$bsp	= $_SESSION['varbsp'];
	$nilaip	= $_SESSION['varnilaip'];

	$data = array(
		array(
    	"bbp"		=> $bbp,
    	"bmp"		=> $bmp,
    	"bsp"		=> $bsp,
    	"nilaip"	=> $nilaip
		)
	);
	echo json_encode($data);
}
?>