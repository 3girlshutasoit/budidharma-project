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
					array(	"rididuserp"	=> "xsd:string",
							"rididgurup"	=> "xsd:string",
							"ksp"			=> "xsd:string",
							"pelajaranp"	=> "xsd:string",
							"bbp"			=> "xsd:string",
							"bmp"			=> "xsd:string",
							"bsp"			=> "xsd:string",
							"nilaip"		=> "xsd:string"
					),
					array("items" => "tns:DATAArray"),
					"urn:serverbudidharma",
					"urn:serverbudidharma#databasequery",
					"rpc",
					"encoded",
					"Tampil Data Query" 
				);

function databasequery($rididuserp, $rididgurup, $ksp, $pelajaranp, $bbp, $bmp, $bsp, $nilaip){
	
	$conn = new db();
	$db = $conn->dbconn();
	
	$sql  = "
		select 	  respon,
				  pesan
		from subentitas.fentrintotalsiswa	(rididuserp 	:=:rididuserp,
							   			 	 rididgurup   	:=:rididgurup,
										 	 ksp   			:=:ksp,
										 	 pelajaranp 	:=:pelajaranp,
							   			 	 bbp   			:=:bbp,
							   			 	 bmp   			:=:bmp,
							   			 	 bsp   			:=:bsp,
										 	 nilaip   		:=:nilaip)
	";

 

	$cmd = $db->prepare($sql);
	$cmd->bindValue(':rididuserp', $rididuserp, PDO::PARAM_STR);
	$cmd->bindValue(':rididgurup', $rididgurup, PDO::PARAM_STR);
	$cmd->bindValue(':ksp', $ksp, PDO::PARAM_STR);
	$cmd->bindValue(':pelajaranp', $pelajaranp, PDO::PARAM_STR);
	$cmd->bindValue(':bbp', $bbp, PDO::PARAM_STR);
	$cmd->bindValue(':bmp', $bmp, PDO::PARAM_STR);
	$cmd->bindValue(':bsp', $bsp, PDO::PARAM_STR);
	$cmd->bindValue(':nilaip', $nilaip, PDO::PARAM_STR);
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