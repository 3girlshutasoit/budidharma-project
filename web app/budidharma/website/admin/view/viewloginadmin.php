<?php
session_start();
require_once("../controller/controlloginadmin.php");
require_once("../lib/mobile-detect/Mobile-Detect-master/Mobile_Detect.php");
error_reporting(0);
	$idp = $_POST['idp'];
	$sandip = $_POST['sandip'];
	$pilihan = $_POST['pilihan'];
	$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		$scriptVersion = $detect->getScriptVersion();
		$mark1 = htmlentities($_SERVER['HTTP_USER_AGENT']);
		$ip = $_SERVER['REMOTE_ADDR'];
		$pos1 = strpos($mark1, '(')+1;
		$pos2 = strpos($mark1, ')')-$pos1;
		$part = substr($mark1, $pos1, $pos2);
		$parts = explode("; ", $part);

		

	$controll = new loginAdmin();
	$data = $controll->logincontrolAdmin($idp, $sandip, $deviceType, $parts[count($parts)-1], $parts[0]." ".$parts[1], $mark1, $ip);
	echo json_encode($data);
	foreach($data as $key => $value) {
		$_SESSION['riduserp'] = $value['riduserp'];
		$_SESSION['userp'] = $value['userp'];
		$_SESSION['idsesip'] = $value['idsesip'];
		$_SESSION['sesip'] = $value['sesip'];
	}
	$_SESSION['pilihan']	= $pilihan;
	$_SESSION['tipepp']		= $deviceType;
	$_SESSION['namapp']		= $parts[count($parts)-1];
	$_SESSION['sop']		= $parts[0]." ".$parts[1];
	$_SESSION['infopp']		= $mark1;
	$_SESSION['alamatp']	= $ip;
?>