<?php 
require_once("_db.php");
switch ($_POST["accion"]) {
	case 'login':
		login();
		break;

default:
 
 break;

}

function login(){
	echo "Tu usuario es: ".$_POST["usuario"]. ", Tu contraseña es ".$_POST["password"];
	}
 ?>
