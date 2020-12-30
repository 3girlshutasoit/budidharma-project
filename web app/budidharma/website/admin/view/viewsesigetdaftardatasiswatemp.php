<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$riddkp		= $_SESSION['varriddk'];
$ridsiswap	= $_SESSION['varridsiswa'];

	$data = array(
		array(
    	"riddkp"	=> $riddkp,
    	"ridsiswap"	=> $ridsiswap
		)
	);
	echo json_encode($data);
}
?>