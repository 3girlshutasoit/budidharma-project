<?php
session_start();
require_once("../controller/controllogoutguru.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$vridp = $_POST['vridp'];
$vidsesip = $_POST['vidsesip'];
$vtipep = $_POST['vtipep'];
$vnamap = $_POST['vnamap'];
$vsop = $_POST['vsop'];
$vinfop = $_POST['vinfop'];
$vsesip = $_POST['vsesip'];
$valamatp = $_POST['valamatp'];

$controll = new logoutGuru();
$data = $controll->logoutcontrolGuru($vridp, $vidsesip, $vtipep, $vnamap, $vsop, $vinfop, $vsesip, $valamatp);

echo json_encode($data);
session_destroy();
}
?>