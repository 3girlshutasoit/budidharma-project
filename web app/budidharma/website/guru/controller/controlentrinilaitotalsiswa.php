<?php 
class entriNilaiTotalSiswa {
	public function entricontrolNilaiTotalSiswa($rididuserp, $rididgurup, $ksp, $pelajaranp, $bbp, $bmp, $bsp, $nilaip) {
		require_once("../lib/nusoap.php");
		error_reporting(0);
		$wsdl   = "http://localhost/budidharma/serverxmladmin/subentitas/entrinilaitotalsiswa.php?wsdl";
		$client = new nusoap_client($wsdl, array('trace'=>1));

		$request_param = array(
    	"rididuserp" => $rididuserp,
    	"rididgurup" => $rididgurup,
    	"ksp" 		 => $ksp,
    	"pelajaranp" => $pelajaranp,
    	"bbp" 		 => $bbp,
    	"bmp" 		 => $bmp,
    	"bsp" 		 => $bsp,
    	"nilaip" 	 => $nilaip
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