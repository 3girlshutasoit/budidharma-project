<?php

require_once("../config/db.php");
require_once("../lib/nusoap.php");

$server = new nusoap_server();

$server->configureWSDL("serverbudidharma", "urn:serverbudidharma");

$server->wsdl->schemaTargetNamespace = "urn:serverbudidharma";
 
//ENTRI SISWA
$server->wsdl->addComplexType(
	"DATA",
	"ComplexType",
	"struct",
	"all",
	"",
	array(
		"respon"   => array("name" => "respon",		"type" => "xsd:string"),
		"pesan"    => array("name" => "pesan",		"type" => "xsd:string"),
         )
);  

$server->wsdl->addComplexType(
	"DATAArray",
	"ComplexType",
	"array",
	"",
	"SOAP-ENC:Array",
	array(),
	array(
		array("ref"=>"SOAP-ENC:arrayType", "wsdl:arrayType"=>"tns:DATA[]")
	),
	"tns:DATA"
);

$server->register("databasequery",
					array(	"riduserp"	=> "xsd:string",
							"idsesip"	=> "xsd:string",
							"tipepp"	=> "xsd:string",
							"namapp"	=> "xsd:string",
							"sop"		=> "xsd:string",
							"infopp"	=> "xsd:string",
							"sesip"		=> "xsd:string",
							"alamatp"	=> "xsd:string"
					),
					array("items" => "tns:DATAArray"),
					"urn:serverbudidharma",
					"urn:serverbudidharma#databasequery",
					"rpc",
					"encoded",
					"Tampil Data Query" 
				);

function databasequery($riduserp, $idsesip, $tipepp, $namapp, $sop, $infopp, $sesip, $alamatp){
	
	$conn = new db();
	$db = $conn->dbconn();
	
	$sql  = "
		select 	  *
		from subentitas.flogoutadmin(	riduserp   	:=:riduserp,
							   			idsesip		:=:idsesip,
										tipepp		:=:tipepp,
							   			namapp		:=:namapp,
										sop 		:=:sop,
										infopp		:=:infopp,
										sesip 		:=:sesip,
										alamatp		:=:alamatp)
	";

 

	$cmd = $db->prepare($sql);
	$cmd->bindValue(':riduserp', $riduserp, PDO::PARAM_STR);
	$cmd->bindValue(':idsesip', $idsesip, PDO::PARAM_STR);
	$cmd->bindValue(':tipepp', $tipepp, PDO::PARAM_STR);
	$cmd->bindValue(':namapp', $namapp, PDO::PARAM_STR);
	$cmd->bindValue(':sop', $sop, PDO::PARAM_STR);
	$cmd->bindValue(':infopp', $infopp, PDO::PARAM_STR);
	$cmd->bindValue(':sesip', $sesip, PDO::PARAM_STR);
	$cmd->bindValue(':alamatp', $alamatp, PDO::PARAM_STR);
	$cmd->execute();
	$ok = $cmd->fetchAll();
	
	$error = $cmd->errorInfo();
	if(!empty($error[2])){
		$data[] = array(
						"respon"	=> "0",
						"pesan"		=> $error[2]
					);
	}else{
		foreach($ok as $field){
				$data[] = array(
							"respon"	=> $field['respon'],
							"pesan"		=> $field['pesan']
						);
			} 
		}
	
	return $data; 
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";

//$server->service($HTTP_RAW_POST_DATA);

@$server->service(file_get_contents("php://input"));

?>