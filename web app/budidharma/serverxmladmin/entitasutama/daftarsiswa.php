<?php

require_once("../config/db.php");
require_once("../lib/nusoap.php");

$server = new nusoap_server();

$server->configureWSDL("serverbudidharma", "urn:serverbudidharma");

$server->wsdl->schemaTargetNamespace = "urn:serverbudidharma";

//DAFTAR SISWA
$server->wsdl->addComplexType(
	"DATA",
	"ComplexType",
	"struct",
	"all",
	"",
	array(
		"rid"		=> array("name" => "rid",  "type" => "xsd:string"),
		"nis"		=> array("name" => "nis", "type" => "xsd:string"),
		"nama"		=> array("name" => "nama", "type" => "xsd:string"),
		"alamat"	=> array("name" => "alamat", "type" => "xsd:string"),
		"no_hp"		=> array("name" => "no_hp", "type" => "xsd:string"),
		"email"		=> array("name" => "email", "type" => "xsd:string"),
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
					array(	"nisp"	=> "xsd:string",
							"namap"	=> "xsd:string"
					),
					array("items" => "tns:DATAArray"),
					"urn:serverbudidharma",
					"urn:serverbudidharma#databasequery",
					"rpc",
					"encoded",
					"Tampil Data Query" 
				);

function databasequery($nisp, $namap){
	$conn = new db();
	$db = $conn->dbconn();
	
	$sql  = "
		select *
		from entitasutama.ftabsiswa	(nisp		:=:nisp,
							 		 namap   	:=:namap)
	";

 

	$cmd = $db->prepare($sql);
	$cmd->bindValue(':nisp', $nisp, PDO::PARAM_STR);
	$cmd->bindValue(':namap', $namap, PDO::PARAM_STR);
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
							"rid"		=> $field['rid'],
							"nis"		=> $field['nis'],
							"nama"		=> $field['nama'],
							"alamat"	=> $field['alamat'],
							"no_hp"		=> $field['no_hp'],
							"email"		=> $field['email']
							

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