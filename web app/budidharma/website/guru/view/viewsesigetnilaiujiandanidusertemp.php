<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$riduserp	= $_SESSION['riduserp'];
	$ridgurup	= $_SESSION['ridgurup'];
	$ridksp		= $_SESSION['varridks'];
	$ridkup 	= $_SESSION['varridku'];
	$ridpep 	= $_SESSION['varridpe'];

	$data = array(
		array(
    	"riduserp"	=> $riduserp,
    	"ridgurup"	=> $ridgurup,
    	"ridksp"	=> $ridksp,
    	"ridkup"	=> $ridkup,
    	"ridpep"	=> $ridpep
		)
	);
	echo json_encode($data);
}
?>