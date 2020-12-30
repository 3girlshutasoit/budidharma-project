<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$tap	= $_SESSION['vta'];
$semp	= $_SESSION['vsemester'];
$kelasp	= $_SESSION['vkelasp'];
$siswap	= $_SESSION['vsiswap'];

	$data = array(
		array(
    	"tap"		=> $tap,
    	"semp"		=> $semp,
    	"kelasp"	=> $kelasp,
    	"siswap"	=> $siswap
		)
	);
	echo json_encode($data);
}
?>