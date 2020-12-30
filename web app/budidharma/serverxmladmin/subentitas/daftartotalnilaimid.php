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
		"id_nilai"			=> array("name" => "id_nilai",  		"type" => "xsd:string"),
		"id_kelassiswa"		=> array("name" => "id_kelassiswa",		"type" => "xsd:string"),
		"id_tahunajaran"	=> array("name" => "id_tahunajaran",	"type" => "xsd:string"),
		"tahun_ajaran"		=> array("name" => "tahun_ajaran",		"type" => "xsd:string"),
		"semester"			=> array("name" => "semester",			"type" => "xsd:string"),
		"id_bulanujian"		=> array("name" => "id_bulanujian",		"type" => "xsd:string"),
		"nama_bulan"		=> array("name" => "nama_bulan",		"type" => "xsd:string"),
		"id_daftarujian"	=> array("name" => "id_daftarujian",	"type" => "xsd:string"),
		"id_kategori"		=> array("name" => "id_kategori",		"type" => "xsd:string"),
		"nama_kategori"		=> array("name" => "nama_kategori",		"type" => "xsd:string"),
		"id_kelas"			=> array("name" => "id_kelas",			"type" => "xsd:string"),
		"nama_kelas"		=> array("name" => "nama_kelas",		"type" => "xsd:string"),
		"id_siswa"			=> array("name" => "id_siswa", 			"type" => "xsd:string"),
		"nama_siswa"		=> array("name" => "nama_siswa",		"type" => "xsd:string"),
		"id_pelajaran"		=> array("name" => "id_pelajaran",		"type" => "xsd:string"),
		"nama_pelajaran"	=> array("name" => "nama_pelajaran",	"type" => "xsd:string"),
		"nilai"				=> array("name" => "nilai",				"type" => "xsd:string"),
		"total_nilai"		=> array("name" => "total_nilai",		"type" => "xsd:string"),
		"rata_nilai"		=> array("name" => "rata_nilai",		"type" => "xsd:string"),
		"bobot_nilai"		=> array("name" => "bobot_nilai",		"type" => "xsd:string"),
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
					array(	"kelasp"	=> "xsd:string",
							"siswap"	=> "xsd:string",
							"gurup"		=> "xsd:string"
					),
					array("items" => "tns:DATAArray"),
					"urn:serverbudidharma",
					"urn:serverbudidharma#databasequery",
					"rpc",
					"encoded",
					"Tampil Data Query" 
				);

function databasequery($kelasp, $siswap, $gurup){
	$conn = new db();
	$db = $conn->dbconn();
	
	$sql  = "
		select *
		from subentitas.ftabtotalnilaimid	(kelasp		:=:kelasp,
							 		 	 	 siswap   	:=:siswap,
							 		 	 	 gurup   	:=:gurup)
	";

 

	$cmd = $db->prepare($sql);
	$cmd->bindValue(':kelasp', $kelasp, PDO::PARAM_STR);
	$cmd->bindValue(':siswap', $siswap, PDO::PARAM_STR);
	$cmd->bindValue(':gurup', $gurup, PDO::PARAM_STR);
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
							"id_nilai"			=> $field['id_nilai'],
							"id_kelassiswa"		=> $field['id_kelassiswa'],
							"id_tahunajaran"	=> $field['id_tahunajaran'],
							"tahun_ajaran"		=> $field['tahun_ajaran'],
							"semester"			=> $field['semester'],
							"id_bulanujian"		=> $field['id_bulanujian'],
							"nama_bulan"		=> $field['nama_bulan'],
							"id_daftarujian"	=> $field['id_daftarujian'],
							"id_kategori"		=> $field['id_kategori'],
							"nama_kategori"		=> $field['nama_kategori'],
							"id_kelas"			=> $field['id_kelas'],
							"nama_kelas"		=> $field['nama_kelas'],
							"id_siswa"			=> $field['id_siswa'],
							"nama_siswa"		=> $field['nama_siswa'],
							"id_pelajaran"		=> $field['id_pelajaran'],
							"nama_pelajaran"	=> $field['nama_pelajaran'],
							"nilai"				=> $field['nilai'],
							"total_nilai"		=> $field['total_nilai'],
							"rata_nilai"		=> $field['rata_nilai'],
							"bobot_nilai"		=> $field['bobot_nilai']

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