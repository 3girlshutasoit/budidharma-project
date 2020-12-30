<?php  session_start();
require_once("../controller/controldaftariduserguru.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
	$nmuserp = $_POST['nmuserp'];
	$controll = new DataIdUserGuru();
	$data = $controll->controlDataIdUserGuru($nmuserp);
    echo json_encode($data);
}
?>