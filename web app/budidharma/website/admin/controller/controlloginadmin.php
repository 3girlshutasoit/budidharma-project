<?php
class loginAdmin {
	public function logincontrolAdmin($idp, $sandip, $tipepp, $namapp, $sop, $infopp, $alamatp) {
		require_once("../lib/nusoap.php");
		error_reporting(0);
		$wsdl   = "http://localhost/budidharma/serverxmladmin/subentitas/login.php?wsdl";
		$client = new nusoap_client($wsdl, array('trace'=>1));

		$request_param = array(
    	"idp"		=> $idp,
    	"sandip"	=> $sandip,
		"tipepp"	=> $tipepp,
    	"namapp"	=> $namapp,
		"sop"		=> $sop,
		"infopp"	=> $infopp,
		"alamatp"	=> $alamatp
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