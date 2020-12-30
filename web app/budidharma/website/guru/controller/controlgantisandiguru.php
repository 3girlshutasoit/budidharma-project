<?php 
class entriGantiSandiGuru {
	public function entricontrolGantiSandiGuru($sandilama, $sandibaru, $idusergurup) {
		require_once("../lib/nusoap.php");
		error_reporting(0);
		$wsdl   = "http://localhost/budidharma/serverxmladmin/subentitas/entrigantisandiguru.php?wsdl";
		$client = new nusoap_client($wsdl, array('trace'=>1));

		$request_param = array(
    	"sandilama" => $sandilama,
    	"sandibaru" => $sandibaru,
    	"idusergurup" => $idusergurup
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