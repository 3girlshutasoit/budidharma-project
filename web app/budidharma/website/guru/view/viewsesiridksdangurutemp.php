<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$kelasp	= $_SESSION['varridnamakelas'];
$siswap	= $_SESSION['varridnamasiswa'];
$gurup	= $_SESSION['ridgurup'];

	$data = array(
		array(
    	"kelasp"	=> $kelasp,
    	"siswap"	=> $siswap,
    	"gurup"		=> $gurup
		)
	);
	echo json_encode($data);
}
?>