<?php
class db{
	
private $hostname = "localhost";
private $username = "admin_budidharma";
private $password = 'bdadmin123';
private $port	  = "5432";
private $database = "budidharma_development";

//$conndb = pg_connect("host=".$hostname." port=".$port." dbname=".$database." user=".$username." password=".$password) or die(mysql_error());

public function dbconn(){
	$db = new PDO("pgsql:dbname=".$this->database."; host=".$this->hostname."; port=".$this->port."; user=".$this->username."; password=".$this->password);
	return $db;
}

public function parameter($par){
	
	if(empty($par)){
		$par = null;
	}
	else{
		$par = $par;
	}
	return $par;
}

public function nulltoempty($par){
	
	if($par==null || empty($par)){
		$par = "";
	}
	else{
		$par = $par;
	}
	return $par;
}

}


?>