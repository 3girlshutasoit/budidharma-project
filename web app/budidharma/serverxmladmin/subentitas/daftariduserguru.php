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
		"id_userguru"	=> array("name" => "id_userguru",  "type" => "xsd:string"),
		"id_guru"		=> array("name" => "id_guru", "type" => "xsd:string"),
		"nip"			=> array("name" => "nip", "type" => "xsd:string"),
		"nama_guru"		=> array("name" => "nama_guru", "type" => "xsd:string"),
		"nama_user"		=> array("name" => "nama_user", "type" => "xsd:string"),
		"sandi"			=> array("name" => "sandi", "type" => "xsd:string"),
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
					array(	"nmuserp"	=> "xsd:string"
					),
					array("items" => "tns:DATAArray"),
					"urn:serverbudidharma",
					"urn:serverbudidharma#databasequery",
					"rpc",
					"encoded",
					"Tampil Data Query" 
				);

function databasequery($nmuserp){
	$conn = new db();
	$db = $conn->dbconn();
	
	$sql  = "
		select *
		from subentitas.ftabiduserguru	(nmuserp	:=:nmuserp)
	";

 

	$cmd = $db->prepare($sql);
	$cmd->bindValue(':nmuserp', $nmuserp, PDO::PARAM_STR);
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
							"id_userguru"	=> $field['id_userguru'],
							"id_guru"		=> $field['id_guru'],
							"nip"			=> $field['nip'],
							"nama_guru"		=> $field['nama_guru'],
							"nama_user"		=> $field['nama_user'],
							"sandi"			=> $field['sandi']
							

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