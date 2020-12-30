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
					array(	"dkp"		=> "xsd:string",
							"siswap"	=> "xsd:string",
							"statusp"	=> "xsd:string",
							"ketp"		=> "xsd:string"
					),
					array("items" => "tns:DATAArray"),
					"urn:serverbudidharma",
					"urn:serverbudidharma#databasequery",
					"rpc",
					"encoded",
					"Tampil Data Query" 
				);

function databasequery($dkp, $siswap, $statusp, $ketp){
	
	$conn = new db();
	$db = $conn->dbconn();
	
	$sql  = "
		select 	  respon,
				  pesan
		from subentitas.fentridaftarsiswa	(dkp 		:=:dkp,
							   			 	 siswap   	:=:siswap,
										 	 statusp   	:=:statusp,
							   			 	 ketp 		:=:ketp)
	";

 

	$cmd = $db->prepare($sql);
	$cmd->bindValue(':dkp', $dkp, PDO::PARAM_STR);
	$cmd->bindValue(':siswap', $siswap, PDO::PARAM_STR);
	$cmd->bindValue(':statusp', $statusp, PDO::PARAM_STR);
	$cmd->bindValue(':ketp', $ketp, PDO::PARAM_STR);
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