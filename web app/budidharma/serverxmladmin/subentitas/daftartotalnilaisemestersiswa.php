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
		"id_nts"		=> array("name" => "id_nts",	"type" => "xsd:string"),
		"id_sks"		=> array("name" => "id_sks",	"type" => "xsd:string"),
		"id_siswa"		=> array("name" => "id_siswa",	"type" => "xsd:string"),
		"nis"			=> array("name" => "nis",		"type" => "xsd:string"),
		"nama_siswa"	=> array("name" => "nama_siswa","type" => "xsd:string"),
		"no_hp"			=> array("name" => "no_hp", 	"type" => "xsd:string"),
		"email"			=> array("name" => "email",		"type" => "xsd:string"),
		"id_pel"		=> array("name" => "id_pel",	"type" => "xsd:string"),
		"nama_pel"		=> array("name" => "nama_pel", 	"type" => "xsd:string"),
		"id_ta"			=> array("name" => "id_ta",		"type" => "xsd:string"),
		"tahun_ajar"	=> array("name" => "tahun_ajar","type" => "xsd:string"),
		"semester"		=> array("name" => "semester", 	"type" => "xsd:string"),
		"id_kelas"		=> array("name" => "id_kelas",	"type" => "xsd:string"),
		"nama_kelas"	=> array("name" => "nama_kelas","type" => "xsd:string"),
		"bulanan"		=> array("name" => "bulanan",	"type" => "xsd:string"),
		"mid"			=> array("name" => "mid",		"type" => "xsd:string"),
		"sem"			=> array("name" => "sem", 		"type" => "xsd:string"),
		"total"			=> array("name" => "total", 	"type" => "xsd:string"),
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
					array(	"tap"		=> "xsd:string",
							"semp"		=> "xsd:string",
							"kelasp"	=> "xsd:string",
							"siswap"	=> "xsd:string"
					),
					array("items" => "tns:DATAArray"),
					"urn:serverbudidharma",
					"urn:serverbudidharma#databasequery",
					"rpc",
					"encoded",
					"Tampil Data Query" 
				);

function databasequery($tap, $semp, $kelasp, $siswap){
	$conn = new db();
	$db = $conn->dbconn();
	
	$sql  = "
		select *
		from subentitas.ftabnilaitotalsemestersiswa(tap			:=:tap,
							 		 	 			semp   		:=:semp,
													kelasp		:=:kelasp,
							 		 	 			siswap   	:=:siswap)
	";

 

	$cmd = $db->prepare($sql);
	$cmd->bindValue(':tap', $tap, PDO::PARAM_STR);
	$cmd->bindValue(':semp', $semp, PDO::PARAM_STR);
	$cmd->bindValue(':kelasp', $kelasp, PDO::PARAM_STR);
	$cmd->bindValue(':siswap', $siswap, PDO::PARAM_STR);
	
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
							"id_nts"		=> $field['id_nts'],
							"id_sks"		=> $field['id_sks'],
							"id_siswa"		=> $field['id_siswa'],
							"nis"			=> $field['nis'],
							"nama_siswa"	=> $field['nama_siswa'],
							"no_hp"			=> $field['no_hp'],
							"email"			=> $field['email'],
							"id_pel"		=> $field['id_pel'],
							"nama_pel"		=> $field['nama_pel'],
							"id_ta"			=> $field['id_ta'],
							"tahun_ajar"	=> $field['tahun_ajar'],
							"semester"		=> $field['semester'],
							"id_kelas"		=> $field['id_kelas'],
							"nama_kelas"	=> $field['nama_kelas'],
							"bulanan"		=> $field['bulanan'],
							"mid"			=> $field['mid'],
							"sem"			=> $field['sem'],
							"total"			=> $field['total']
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