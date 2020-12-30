<?php

require_once("../config/db.php");
require_once("../lib/nusoap.php");

$server = new nusoap_server();

$server->configureWSDL("serverbudidharma", "urn:serverbudidharma");

$server->wsdl->schemaTargetNamespace = "urn:serverbudidharma";

//DAFTAR DATA SISWA
$server->wsdl->addComplexType(
	"DATA",
	"ComplexType",
	"struct",
	"all",
	"",
	array(
		"id_kelas"			=> array("name" => "id_kelas", "type" => "xsd:string"),
		"nama_kelas"		=> array("name" => "nama_kelas", "type" => "xsd:string"),
		"id_pel"			=> array("name" => "id_pel", "type" => "xsd:string"),
		"nama_pel"			=> array("name" => "nama_pel", "type" => "xsd:string"),
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
					array(	"gurup"		=> "xsd:string",
							"kelasp"	=> "xsd:string"
					),
					array("items" => "tns:DATAArray"),
					"urn:serverbudidharma",
					"urn:serverbudidharma#databasequery",
					"rpc",
					"encoded",
					"Tampil Data Query" 
				);

function databasequery($gurup, $kelasp){
	$conn = new db();
	$db = $conn->dbconn();
	
	$sql  = "
		select *
		from subentitas.ftabpelajaranforguru(gurup   	:=:gurup,
											 kelasp   	:=:kelasp)
	";

 

	$cmd = $db->prepare($sql);
	$cmd->bindValue(':gurup', $gurup, PDO::PARAM_STR);
	$cmd->bindValue(':kelasp', $kelasp, PDO::PARAM_STR);
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
							"id_kelas"			=> $field['id_kelas'],
							"nama_kelas"		=> $field['nama_kelas'],
							"id_pel"			=> $field['id_pel'],
							"nama_pel"			=> $field['nama_pel'],
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