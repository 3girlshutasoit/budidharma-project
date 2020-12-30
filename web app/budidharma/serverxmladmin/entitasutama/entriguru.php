<?php

require_once("../config/db.php");
require_once("../lib/nusoap.php");

$server = new nusoap_server();

$server->configureWSDL("serverbudidharma", "urn:serverbudidharma");

$server->wsdl->schemaTargetNamespace = "urn:serverbudidharma";
 
//ENTRI GURU
$server->wsdl->addComplexType(
	"DATA",
	"ComplexType",
	"struct",
	"all",
	"",
	array(
		"respon"   => array("name" => "respon", "type" => "xsd:string"),
		"pesan"    => array("name" => "pesan", 	"type" => "xsd:string"),
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
					array(	"nipp"		=> "xsd:string",
							"namap"		=> "xsd:string",
							"alamatp"	=> "xsd:string",
							"nohpp"		=> "xsd:string",
							"emailp"	=> "xsd:string"
					),
					array("items" => "tns:DATAArray"),
					"urn:serverbudidharma",
					"urn:serverbudidharma#databasequery",
					"rpc",
					"encoded",
					"Tampil Data Query" 
				);

function databasequery($nipp, $namap, $alamatp, $nohpp, $emailp){
	
	$conn = new db();
	$db = $conn->dbconn();
	
	$sql  = "
		select 	  respon,
				  pesan
		from entitasutama.fentriguru	(nipp   	:=:nipp,
							   			 namap   	:=:namap,
										 alamatp   	:=:alamatp,
							   			 nohpp  	:=:nohpp,
										 emailp  	:=:emailp)
	";

 

	$cmd = $db->prepare($sql);
	$cmd->bindValue(':nipp', $nipp, PDO::PARAM_STR);
	$cmd->bindValue(':namap', $namap, PDO::PARAM_STR);
	$cmd->bindValue(':alamatp', $alamatp, PDO::PARAM_STR);
	$cmd->bindValue(':nohpp', $nohpp, PDO::PARAM_STR);
	$cmd->bindValue(':emailp', $emailp, PDO::PARAM_STR);
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