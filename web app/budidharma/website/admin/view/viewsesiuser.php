<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	$idsesiuser = "1";
	$data = array(
		array(
    	"idsesiuserp"		=> $idsesiuser
		)
	);
	echo json_encode($data);
}else {
$idsesiuser = "0";
	$data = array(
		array(
    	"idsesiuserp"		=> $idsesiuser
		)
	);
	echo json_encode($data);
}
?>