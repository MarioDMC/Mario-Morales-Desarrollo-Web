<?php 
include_once("_db.php");

switch ($_POST["action"]) {
	case 'login':
		login();
		break;
	case 'consultar_usuarios':
		consultar_usuarios();
		break;
	case 'insertar_usuarios':
		insertar_usuarios();
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

    $stmt = $db->prepare("SELECT * FROM smoothop_segundo_parcial.usuarios where correo_usr =? ");
    $stmt->execute(array($mail));
	$row_count = $stmt->rowCount();

   	if ($row_count == 0) {
   	//Correo no existe
    	 echo "2";
    }
	    else {
	    	$stmt = $db->prepare("SELECT * FROM smoothop_segundo_parcial.usuarios where correo_usr =? and pswd_usr =? ");
	    	$stmt->execute(array($mail, $pswd));
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

	 function consultar_usuarios(){
	 	global $db;
	 	$query = "SELECT * FROM smoothop_segundo_parcial.usuarios";
    	$array = [];
    	foreach($db->query($query) as $fila){
			array_push($array, $fila);
					}
    	echo json_encode($array);
	 }

	function insertar_usuarios(){
	$nombre= $_POST["nombre"];
	$tel= $_POST["tel"];
	$mail = $_POST["mail"];
	$pswd = $_POST["password"];

	 	global $db;
	 	$stmt = $db->prepare("INSERT INTO smoothop_segundo_parcial.usuarios (id_usr, nombre_usr, correo_usr, pswd_usr, telefono_usr, status_usr)  VALUES ('',?,?,?,?,'1')");
	 	$stmt->execute(array($nombre, $mail, $pswd, $tel));
	 	$affected_rows = $stmt->rowCount();
	 	if ($affected_rows > 0) {
	 		echo "1";
	 	} else {
	 		echo"0";
	 	}

	 }


 ?>