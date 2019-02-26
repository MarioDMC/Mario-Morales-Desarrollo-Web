<?php 
 function () {
  $path = '/uploads/'; 
  $archivo = $_FILES["archivo"]["name"];
  $tmp = $_FILES["archivo"]["tmp_name"];


  $ext = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

  $final_image = rand(1000,1000000).$archivo;

	$path = $path.strtolower($final_image); 

	if(move_uploaded_file($tmp,$path)){

	echo "<img src='$path' />";
	$texto = $_POST['texto'];
	$nombre = $_POST['nombre'];
	//include database configuration file
	//include_once 'db.php';
	//insert form data in the database
	//$insert = $db->query("INSERT uploading (name,email,file_name) VALUES ('".$name."','".$email."','".$path."')");
	echo $final_image;
	echo $texto;
	echo $nombre;
	}
	else 
	{
	echo 'invalid';
	}
}

 ?>