<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$ridksp		= $_SESSION['varridks'];
$ridekp		= $_SESSION['varridek'];
$ridkup 	= $_SESSION['varridku'];
$ridpep 	= $_SESSION['varridpe'];

	$data = array(
		array(
    	"ridksp"	=> $ridksp,
    	"ridekp"	=> $ridekp,
    	"ridkup"	=> $ridkup,
    	"ridpep"	=> $ridpep
		)
	);
	echo json_encode($data);
}
?>