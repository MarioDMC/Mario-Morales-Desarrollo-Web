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

	$query = "SELECT * FROM smoothop_segundo_parcial.usuarios where correo_usr ='$mail'";
    $stmt = $db->query($query);
	$row_count = $stmt->rowCount();

   	if ($row_count == 0) {

    	 echo "Usuario No Existe (2)";
    }

    else {
    	$query = "SELECT * FROM smoothop_segundo_parcial.usuarios where correo_usr ='$mail' and pswd_usr = '$pswd'";
    	$stmt = $db->query($query);
		$row_count = $stmt->rowCount();

			if ($row_count == 0) {

				echo "Contraseña Incorrecta (1)";

			}

			else{

					echo "Acceso Correcto (0)";

			}

    	}

    }

 ?>
