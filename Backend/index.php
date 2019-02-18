<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio de sesion- AcitveBox</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/login.css">

</head>
<body>
	 <body class="text-center">
    <form class="form-signin">
  <img class="mb-4" src="../img/ActiveBox.png">
  <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
  <label for="inputEmail" class="sr-only">Dirección de correo</label>
  <input type="email" id="inputEmail" class="form-control" placeholder="Dirección de correo" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Recordar
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" id= "buttonSign" type="button">Iniciar Sesión</button>
  </br>
  <div class="alert alert-danger" id="infoD" style="display: none;"></div>
  <div class="alert alert-success" id="infoS" style="display: none;"></div>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>	
<script>
$(function() {

    $("#buttonSign").click(function(){
    let mail = $("#inputEmail").val();
    let pswd = $("#inputPassword").val();
    let obj = {
      "action" : "login",
      "mail" : mail,
      "password" : pswd 

    };

    $.post('includes/_funciones.php', obj,  function(r){  

       $("#infoD").hide(); 
       $("#infoS").hide();  

     if (r == "4") {
       $("#infoD").html("Ingresa Email y Contraseña (4)").fadeIn(); 

     } else if (r == "3"){
       $("#infoD").html("Ingresa Contraseña (3)").fadeIn(); 

     } else if (r == "2"){
       $("#infoD").html("Email Invalido (2)").fadeIn(); 

     } else if (r == "1"){
       $("#infoD").html("Contraseña Incorrecta (1)").fadeIn(); 

     } else{
       $("#infoS").html("Acceso Correcto (0)").fadeIn();
     }

    });
    });
});
</script>
</body>
</html>