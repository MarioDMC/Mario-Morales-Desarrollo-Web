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
	case 'consultar_header':
		consultar_header();
		break;
	case 'consultar_footer':
		consultar_footer();
		break;
	case 'consultar_shareFooter':
		consultar_shareFooter();
		break;	
	case 'consultar_slider':
		consultar_slider();
		break;
	case 'insertar_slider':
		insertar_slider();
		break;	
	case 'update_header':
		update_header();
		break;	
	case 'eliminar_registro':
		eliminar_usuarios($registro= $_POST["registro"]);
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

	  function eliminar_usuarios($id){
	 	global $db;
	 	$query = "DELETE FROM smoothop_segundo_parcial.usuarios WHERE id_usr =?";
	 	$stmt = $db->prepare($query);
    	$stmt->execute(array($id));
    	$row_count = $stmt->rowCount();
				if ($row_count == 1) {
					echo "1";
				}
				else{
					echo "0";
				}
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

	 function consultar_header(){
	 	global $db;
	 	$query = "SELECT * FROM smoothop_segundo_parcial.header";
    	$stmt = $db->prepare($query);
    	$stmt->execute();
    	$fila = $stmt->fetchAll(PDO::FETCH_ASSOC);
    	echo json_encode($fila);

	 }

	 function consultar_footer(){
	 	global $db;
	 	$query = "SELECT * FROM smoothop_segundo_parcial.footer";
    	$stmt = $db->prepare($query);
    	$stmt->execute();
    	$fila = $stmt->fetchAll(PDO::FETCH_ASSOC);
    	echo json_encode($fila);

	 }

	 function consultar_shareFooter(){
	 	global $db;
	 	$query = "SELECT * FROM smoothop_segundo_parcial.share_footer WHERE status_share_footer = 1";
	 	$array = [];
    	foreach($db->query($query) as $fila) {

    	$temp =	"<li><a href='".$fila['link_share_footer']."' ><img src='".$fila['icon_share_footer']."'alt=''></a></li>" ; 

    	echo $temp;
	
		  }

	   }

	function update_header(){
	$titulo= $_POST["titulo"];
	$texto= $_POST["texto"];
	$boton = $_POST["boton"];
	$link = $_POST["link"];

	 	global $db;
	 	$stmt = $db->prepare("UPDATE smoothop_segundo_parcial.header SET title_header =?, content_header =?, link_header =?, href_header =? WHERE id_header = 1");
	 	$stmt->execute(array($titulo, $texto, $boton, $link));
	 	$affected_rows = $stmt->rowCount();
	 	if ($affected_rows > 0) {
	 		echo "1";
	 	} else {
	 		echo"0";
	 	}
	 }

	 function footer_header(){
	$titulo= $_POST["titulo"];
	$texto= $_POST["texto"];
	$boton = $_POST["boton"];
	$link = $_POST["link"];

	 	global $db;
	 	$stmt = $db->prepare("UPDATE smoothop_segundo_parcial.footer SET title_header =?, content_header =?, link_header =?, href_header =? WHERE id_header = 1");
	 	$stmt->execute(array($titulo, $texto, $boton, $link));
	 	$affected_rows = $stmt->rowCount();
	 	if ($affected_rows > 0) {
	 		echo "1";
	 	} else {
	 		echo"0";
	 	}
	 }

 ?>