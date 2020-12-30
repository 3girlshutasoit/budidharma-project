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
		"riduserp" => array("name" => "riduserp",	"type" => "xsd:string"),
		"userp"    => array("name" => "userp",		"type" => "xsd:string"),
		"ridgurup" => array("name" => "ridgurup",	"type" => "xsd:string"),
		"idsesip"  => array("name" => "idsesip",	"type" => "xsd:string"),
		"sesip"    => array("name" => "sesip",		"type" => "xsd:string"),
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
					array(	"idp"		=> "xsd:string",
							"sandip"	=> "xsd:string",
							"tipepp"	=> "xsd:string",
							"namapp"	=> "xsd:string",
							"sop"		=> "xsd:string",
							"infopp"	=> "xsd:string",
							"alamatp"	=> "xsd:string"
					),
					array("items" => "tns:DATAArray"),
					"urn:serverbudidharma",
					"urn:serverbudidharma#databasequery",
					"rpc",
					"encoded",
					"Tampil Data Query" 
				);

function databasequery($idp, $sandip, $tipepp, $namapp, $sop, $infopp, $alamatp){
	
	$conn = new db();
	$db = $conn->dbconn();
	
	$sql  = "
		select 	  *
		from subentitas.floginguru	(	idp   	:=:idp,
							   			sandip  :=:sandip,
										tipepp  :=:tipepp,
							   			namapp  :=:namapp,
										sop  	:=:sop,
										infopp  :=:infopp,
										alamatp :=:alamatp)
	";

 

	$cmd = $db->prepare($sql);
	$cmd->bindValue(':idp', $idp, PDO::PARAM_STR);
	$cmd->bindValue(':sandip', $sandip, PDO::PARAM_STR);
	$cmd->bindValue(':tipepp', $tipepp, PDO::PARAM_STR);
	$cmd->bindValue(':namapp', $namapp, PDO::PARAM_STR);
	$cmd->bindValue(':sop', $sop, PDO::PARAM_STR);
	$cmd->bindValue(':infopp', $infopp, PDO::PARAM_STR);
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
							"riduserp"	=> $field['riduserp'],
							"userp"		=> $field['userp'],
							"ridgurup"	=> $field['ridgurup'],
							"idsesip"	=> $field['idsesip'],
							"sesip"		=> $field['sesip'],
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