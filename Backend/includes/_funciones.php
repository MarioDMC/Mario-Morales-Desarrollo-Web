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
	case 'consultar_iconsFooter':
		consultar_iconsFooter();
		break;	
	case 'update_header':
		update_header();
		break;	
	case 'update_footer':
		update_footer();
		break;	
	case 'update_shareIcons':
		update_shareIcons();
		break;		
	case 'eliminar_registro':
		eliminar_usuarios($registro= $_POST["id"]);
		break;	
	case 'editar_registro':
		editar_registro($registro= $_POST["id"]);
		break;	
	case 'consultar_registro':
		consultar_registro($registro= $_POST["id"]);
		break;
	case 'carga_foto':
		carga_foto();
		break;

	default:
 
		break;

}

	function carga_foto(){
		if (isset($_FILES['foto'])) {
			$file = $_FILES['foto'];
			$nombre = $_FILES['foto']['name'];
			$tipo = $_FILES['foto']['type'];
			$temporal = $_FILES['foto']['tmp_name'];
			$tam = $_FILES['foto']['size'];
			$dir = "../../img/usuarios/";
			$respuesta = [
				"archivo" => "../img/usuarios/logotipo.png",
				"status" => 0
			];
			if(move_uploaded_file($temporal, $dir.$nombre)){
				$respuesta['archivo'] = "../img/usuarios/".$nombre;
				$respuesta['status'] = 1;
			}
			echo json_encode($respuesta);

		}
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
						session_start();
	       				error_reporting(0);
	        			$_SESSION['user'] = $mail;
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
		$tel= $_POST["telefono"];
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

	function editar_registro($id){
	 	$nombre= $_POST["nombre"];
		$tel= $_POST["telefono"];
		$mail = $_POST["mail"];
		$pswd = $_POST["password"];
	 global $db;
	 	$stmt = $db->prepare("UPDATE smoothop_segundo_parcial.usuarios SET nombre_usr =?, correo_usr =?, pswd_usr =?, telefono_usr =? WHERE id_usr =? ");
	 	$stmt->execute(array($nombre, $mail, $pswd, $tel, $id));
	 	$affected_rows = $stmt->rowCount();
	 	if ($affected_rows > 0) {
	 		echo "2";
	 	} else {
	 		echo"3";
	 	}
	 }

 	function consultar_registro($id){
	 	global $db;
	 	$query = "SELECT * FROM smoothop_segundo_parcial.usuarios WHERE id_usr =? LIMIT 1";
    	$stmt = $db->prepare($query);
    	$stmt->execute(array($id));
    	$fila = $stmt->fetch(PDO::FETCH_ASSOC);
    	echo json_encode($fila);
	 }

	 function consultar_header(){
	 	global $db;
	 	$query = "SELECT * FROM smoothop_segundo_parcial.header";
    	$stmt = $db->prepare($query);
    	$stmt->execute();
    	$fila = $stmt->fetch(PDO::FETCH_ASSOC);
    	echo json_encode($fila);

	 }


	 function consultar_footer(){
	 	global $db;
	 	$query = "SELECT * FROM smoothop_segundo_parcial.footer";
    	$stmt = $db->prepare($query);
    	$stmt->execute();
    	$fila = $stmt->fetch(PDO::FETCH_ASSOC);
    	echo json_encode($fila);

	 }

	 function consultar_shareFooter(){
	 	global $db;
	 	$query = "SELECT * FROM smoothop_segundo_parcial.share_footer WHERE status_share_footer = 1";
	 	$array = [];
    	foreach($db->query($query) as $fila) {

    	$temp =	"<li><a href='".$fila['link_share_footer']."' ><img src='".$fila['icon_share_footer']."'alt=''></a></li>" ; 

    	array_push($array, $temp);
					}
				echo json_encode($array);
	
		  }

	function consultar_iconsFooter(){
	 	global $db;
	 	$query = "SELECT id_share_footer,link_share_footer, status_share_footer FROM smoothop_segundo_parcial.share_footer";
	 	$array = [];
    	foreach($db->query($query) as $fila) {

    	array_push($array, array('id_share_footer'=>$fila[0], 'link_share_footer'=>$fila[1], 
    		'status_share_footer'=>$fila[2]) );
					}
				echo json_encode($array);
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

	function update_footer(){
	$location= $_POST["location"];
	$about= $_POST["about"];
	$copyright = $_POST["copyright"];

	 	global $db;
	 	$stmt = $db->prepare("UPDATE smoothop_segundo_parcial.footer SET location_content_footer =?, about_content_footer =?, copyright_content_footer =? WHERE id_footer = 1");
	 	$stmt->execute(array($location, $about, $copyright));
	 	$affected_rows = $stmt->rowCount();
	 	if ($affected_rows > 0) {
	 		echo "1";
	 	} else {
	 		echo"0";
	 	}
	 }

function update_shareIcons(){
	$id = $_POST["id"];
	$link = $_POST["link_"];
	$status = $_POST["status_"];
	global $db;
	 	$stmt = $db->prepare("UPDATE smoothop_segundo_parcial.share_footer SET link_share_footer =?, status_share_footer =?  WHERE id_share_footer =? ");
	 	$stmt->execute(array($link, $status, $id));
	 	$affected_rows = $stmt->rowCount();
	 	if ($affected_rows > 0) {
	 		echo "1";
	 	} else {
	 		echo"0";
 	}
	 }


 ?>