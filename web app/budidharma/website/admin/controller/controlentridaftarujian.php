<?php 
class entriDaftarUjian {
	public function entricontrolDaftarUjian($tap, $bup, $kup) {
		require_once("../lib/nusoap.php");
		error_reporting(0);
		$wsdl   = "http://localhost/budidharma/serverxmladmin/subentitas/entridaftarujian.php?wsdl";
		$client = new nusoap_client($wsdl, array('trace'=>1));

		$request_param = array(
    	"tap" => $tap,
    	"bup" => $bup,
    	"kup" => $kup
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