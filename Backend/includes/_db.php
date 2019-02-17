<?php 
/*$server = "smoothoperators.com.mx";
 $db = "smoothop_segundo_parcial";
 $user = "smoothop_db" ;
 $password = "Goodluck13";

$mysqli = new mysqli($server, $user, $password, $db);
	if($mysqli-connect_errno){
		echo "Lo sentimos este sitio web está experimentando problemas";
		echo "Error: Fallo al conectarse a MySQL debido a: \n";
		echo "Errno: " . $mysqli->connect_errno . "\n";
		echo "Errno: " . $mysqli->connect_errno . "\n";
		exit;
	}

	print_r($mysqli);
	*/
try{
	$db = new PDO('mysql:host=smoothoperators.com.mx; dbname=smoothop_segundo_parcial', 'smoothop_db', 'Goodluck13');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $ex) {
    echo "An Error occured!"; 
    some_logging_function($ex->getMessage());
}
   
?>