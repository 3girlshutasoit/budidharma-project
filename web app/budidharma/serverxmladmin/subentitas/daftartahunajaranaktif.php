<?php

require_once("../config/db.php");
require_once("../lib/nusoap.php");

$server = new nusoap_server();

$server->configureWSDL("serverbudidharma", "urn:serverbudidharma");

$server->wsdl->schemaTargetNamespace = "urn:serverbudidharma";

//DAFTAR TAHUN AJARAN
$server->wsdl->addComplexType(
	"DATA",
	"ComplexType",
	"struct",
	"all",
	"",
	array(
		"rid"			=> array("name" => "rid",  "type" => "xsd:string"),
		"tahun_ajar"	=> array("name" => "tahun_ajar", "type" => "xsd:string"),
		"semester"		=> array("name" => "semester", "type" => "xsd:string"),
		"status"		=> array("name" => "status", "type" => "xsd:string"),
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
					array(	"tap"	=> "xsd:string",
							"semp"	=> "xsd:string"
					),
					array("items" => "tns:DATAArray"),
					"urn:serverbudidharma",
					"urn:serverbudidharma#databasequery",
					"rpc",
					"encoded",
					"Tampil Data Query" 
				);

function databasequery($tap, $semp){
	$conn = new db();
	$db = $conn->dbconn();
	
	$sql  = "
		select *
		from subentitas.ftabtahunajaranaktif(tap		:=:tap,
							 		 		 semp   	:=:semp)
	";

 

	$cmd = $db->prepare($sql);
	$cmd->bindValue(':tap', $tap, PDO::PARAM_STR);
	$cmd->bindValue(':semp', $semp, PDO::PARAM_STR);
	$cmd->execute();
	$ok = $cmd->fetchAll();
	
	$error = $cmd->errorInfo();
	if(!empty($error[2])){
		$data[] = array(
						"respon"	=> "0",
						"pesan"		=> $error[2]
					);
	}else{
		if(empty($ok)){
			$data[] = array(
						"respon"	=> "0",
						"pesan"		=> "Data tidak ditemukan!"
					);
		}else{
			foreach($ok as $field){
				$data[] = array(
							"rid"			=> $field['rid'],
							"tahun_ajar"	=> $field['tahun_ajar'],
							"semester"		=> $field['semester'],
							"status"		=> $field['status']
						);
			} 
		}
		
	}
	
	return $data; 
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";

//$server->service($HTTP_RAW_POST_DATA);

@$server->service(file_get_contents("php://input"));

?>