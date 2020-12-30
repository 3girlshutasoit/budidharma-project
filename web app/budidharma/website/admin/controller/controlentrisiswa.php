<?php 
class entriSiswa {
	public function entricontrolSiswa($nisp, $namap, $alamatp, $nohpp, $emailp) {
		require_once("../lib/nusoap.php");
		error_reporting(0);
		$wsdl   = "http://localhost/budidharma/serverxmladmin/entitasutama/entrisiswa.php?wsdl";
		$client = new nusoap_client($wsdl, array('trace'=>1));

		$request_param = array(
    	"nisp" => $nisp,
    	"namap" => $namap,
		"alamatp" => $alamatp,
    	"nohpp" => $nohpp,
		"emailp" => $emailp
		);

		try
		{
    		$responce_param = $client->call('databasequery', $request_param);
			$result = json_decode(json_encode($responce_param),true);
			
		}catch (Exception $e){ 
    		echo "<h2>Exception Error!</h2>"; 
    		echo $e->getMessage(); 
		}
	return $result;
	}
}
?>