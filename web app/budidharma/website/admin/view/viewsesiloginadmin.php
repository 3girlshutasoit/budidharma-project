<?php session_start();
error_reporting(0);
if(!isset($_SESSION['sesip'])) {
	header( 'Location: http://localhost/budidharma/index.html' );
	exit();
}else {
$rid = $_SESSION['riduserp'];
$user = $_SESSION['userp'];
$idsesi = $_SESSION['idsesip'];
$sesi = $_SESSION['sesip'];
$pilihan = $_SESSION['pilihan'];
$tipe = $_SESSION['tipepp'];
$nama = $_SESSION['namapp'];
$so = $_SESSION['sop'];
$info = $_SESSION['infopp'];
$alamat = $_SESSION['alamatp'];

	$data = array(
		array(
    	"ridp"		=> $rid,
    	"userp"		=> $user,
		"idsesip"	=> $idsesi,
    	"sesip"		=> $sesi,
    	"pilihan"	=> $pilihan,
    	"tipep"		=> $tipe,
    	"namap"		=> $nama,
		"sop"		=> $so,
    	"infop"		=> $info,
    	"alamatp"	=> $alamat
		)
	);
	echo json_encode($data);
}
?>