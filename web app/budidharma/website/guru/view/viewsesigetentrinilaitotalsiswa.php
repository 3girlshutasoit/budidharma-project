<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$riduserp				= $_SESSION['riduserp'];
	$ridgurup				= $_SESSION['ridgurup'];
	$ridksp					= $_SESSION['varridkelassiswa'];
	$ridpelajaranp			= $_SESSION['varridpelajaran'];
	$bbp 					= $_SESSION['varbbp'];
	$bmp 					= $_SESSION['varbmp'];
	$bsp 					= $_SESSION['varbsp'];
	$_SESSION['varnilaip']	= $_SESSION['varbbp'] + $_SESSION['varbmp'] + $_SESSION['varbsp'];
	$nilaip 				= $_SESSION['varnilaip'];

	$data = array(
		array(
    	"riduserp"		=> $riduserp,
    	"ridgurup"		=> $ridgurup,
    	"ridksp"		=> $ridksp,
    	"ridpelajaranp"	=> $ridpelajaranp,
    	"bbp"			=> $bbp,
    	"bmp"			=> $bmp,
    	"bsp"			=> $bsp,
    	"nilaip"		=> $nilaip
		)
	);
	echo json_encode($data);
}
?>