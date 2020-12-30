<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$gurup	= $_SESSION['ridgurup'];
$kelasp	= $_SESSION['varridek'];

	$data = array(
		array(
    	"gurup"	=> $gurup,
    	"kelasp"	=> $kelasp
		)
	);
	echo json_encode($data);
}
?>