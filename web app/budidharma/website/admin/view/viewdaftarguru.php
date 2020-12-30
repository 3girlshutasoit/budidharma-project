<?php  session_start();
require_once("../controller/controldaftarguru.php");
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $controll = new Guru();
    $data = $controll->controlGuru($nip, $nama);
    //print_r($data);
    echo json_encode($data);
}
?>