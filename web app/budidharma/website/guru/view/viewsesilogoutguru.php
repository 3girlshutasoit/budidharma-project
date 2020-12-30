<?php
error_reporting(0);

$vridp = $_POST['vridp'];
$vidsesip = $_POST['vidsesip'];
$vtipep = $_POST['vtipep'];
$vnamap = $_POST['vnamap'];
$vsop = $_POST['vsop'];
$vinfop = $_POST['vinfop'];
$vsesip = $_POST['vsesip'];
$valamatp = $_POST['valamatp'];

$data = array(
		array(
    	"vridp"		=> $vridp,
		"vidsesip"	=> $vidsesip,
    	"vtipep"	=> $vtipep,
    	"vnamap"	=> $vnamap,
		"vsop"		=> $vsop,
    	"vinfop"	=> $vinfop,
    	"vsesip"	=> $vsesip,
    	"valamatp"	=> $valamatp
		)
	);
echo json_encode($data);
//session_destroy();
?>