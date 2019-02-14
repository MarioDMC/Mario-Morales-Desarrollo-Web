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
  <button class="btn btn-lg btn-primary btn-block" id= "buttonSign" type="button">Iniciar</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>	
<script>
    $("#buttonSign").click(function(){
    // Valor de email
    let mail = $("#inputEmail").val();
    // Valor de Password
    let pswd = $("#inputPassword").val();
    let obj = {
      "accion" : "valor",
      "usuario" : mail,
      "password" : pswd  
    };
    $.post('includes/_funciones.php', obj, function() {

    });

    // Validar los valores
    // En caso de ser valido,redireccionar a usuarios.php
    // En cado se no ser valodo enviar mensaje de rror y denega el acceso
});

</script>



</body>
</html>