<?php 
include_once("_db.php");

switch ($_POST["action"]) {
	case 'login':
		login();
		break;

default:
 
break;

}

function login(){
	global $db;
	$mail= $_POST["mail"];
	$pswd = $_POST["password"];

	if (empty($mail) && empty($pswd)) {
	//Ingresa Usuario y Contraseña	
       echo"4";
    }  
    	else if(empty($pswd)) {
    	//Ingresa un Usuario y contraseña
      		echo"3";
    	}
   			else {

	$query = "SELECT * FROM smoothop_segundo_parcial.usuarios where correo_usr ='$mail'";
    $stmt = $db->query($query);
	$row_count = $stmt->rowCount();

   	if ($row_count == 0) {
   	//Correo no existe
    	 echo "2";
    }
	    else {
	    	$query = "SELECT * FROM smoothop_segundo_parcial.usuarios where correo_usr ='$mail' and pswd_usr = '$pswd'";
	    	$stmt = $db->query($query);
			$row_count = $stmt->rowCount();
				if ($row_count == 0) {
				//Contraseña Incorrecta	
					echo "1";
				}
				else{
				//Acceso Correcto
					echo "0";
				}
	    	}
	    }
	 }

 ?>