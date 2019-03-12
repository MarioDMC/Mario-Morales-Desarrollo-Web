<?php
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['user'];
  if (isset($varsesion)){

  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Usuarios</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Custom styles for this template -->

      <link href="../css/style.css" rel="stylesheet">
  </head>
  <body>

<?php include("includes/_dashboard.php") ?>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="main">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Usuarios</h1>

        <div class="alert alert-danger" id="infoD" style="display: none;"></div>
        <div class="alert alert-success" id="infoS" style="display: none;"></div>

        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-danger cancelar" id="cancelar">Cancelar</button>
            <button type="button" class="btn btn-sm btn-outline-success" id="nuevo_registro" >Nuevo</button>
          </div>
        </div>
      </div>

      <div class="table-responsive view" id="show_data">
        <table class="table table-striped table-sm" id="list_usuarios">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
       <div id="insert_data" class="view">
       <form action="#" id="form_data" enctype="multipart/form-data">
  <div class="row">
  <div class="col">
       <div class="form-group">
       <label for="nombre">Nombre</label>
       <input type="text" id="nombre" name="nombre" class="form-control">
     </div>
       <div class="form-group">
        <label for="correo">Correo Electronico</label>
       <input type="email" id="mail" name="mail" class="form-control">
       </div>
         <div class="form-group">
       <input type="file" id="foto" name="foto"  accept="image/x-png,image/gif,image/jpeg">
        <input type="hidden" id="ruta" name="ruta" readonly="readonly">
       </div>
        
       <div id="preview"></div>
       </div>
  <div class="col">
        <div class="form-group">
        <label for="telefono">Teléfono</label>
       <input type="tel" id="telefono" name="telefono" class="form-control">
       </div>
       <div class="form-group">
        <label for="password">Contraseña</label>
       <input type="password" id="password" name="password" class="form-control">
       </div>
     </div>
     </div>
     <div class="row">
       <div class="col">
         <button type="button" class="btn btn-success " id="guardar_datos">Guardar</button>
       </div>
     </div>
     </div>
       </form>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  
<script>
  //todas las vitas se ocultan
  //pregunto que vista esta visible
  //pregunto cual es la vista que se va mostrar
  
  function change_view(vista ='show_data'){
    $("#main").find(".view").each(function() {
      $(this).slideUp('fast');
      let id = $(this).attr("id");
      if (vista == id) {
        $(this).slideDown(300);
      }
      
    });
  }

  function  consultar(){
    let obj = {
      "action" : "consultar_usuarios"
    };

    $.post('includes/_funciones.php', obj, function(r) {
     let template = ``;
    $.each(r, function(i, e) {
    template += `
            <tr>
              <td>${e.nombre_usr}</td>
              <td>${e.telefono_usr}</td>
              <td>
                <a href="#" data-id="${e.id_usr}" class="editar_registro">Editar</a>
                <a href="#" data-id="${e.id_usr}" class="eliminar_registro">Eliminar</a>
              </td>
            </tr>
          `;
    });
    $("#list_usuarios tbody").html(template);
  }, "JSON");
  }
  $("#nuevo_registro").click(function() {
   change_view('insert_data');
   });

  $("#cancelar").click(function() {
   consultar();
   });

  $("#guardar_datos").click(function(r) {
   let nombre = $("#nombre").val();
   let telefono = $("#telefono").val();
   let mail = $("#mail").val();
   let pswd = $("#password").val();
   let obj ={
    "action" : "insertar_usuarios",
    "nombre" : nombre,
    "telefono" : telefono,
    "mail" : mail,
    "password" : pswd
   }

   $("#form_data").find("input").each(function(){
    $(this).removeClass("has-error");
   if ($(this).val() != "") {
      obj[$(this).prop("name")] = $(this).val();
   }else{
    $(this).addClass("has-error").focus();
    return false;
   }
  });

    if($(this).data("editar") == 1) {
    obj["action"] = "editar_registro";
    obj["id"] = $(this).data('id');
    $(this).text("Guardar").removeData("editar").removeData("id");
   }

   if (mail == "" || pswd == "" || telefono == "" || nombre == "") {

    $("#infoD").html("Completa Todos los Campos").show().delay(2000).fadeOut(400);

    }else{

   $.post('includes/_funciones.php', obj, function(a) {

    if (a == "1") {
       $("#infoS").html("Usuario Insertado Correctamente").show().delay(2000).fadeOut(400); 
       $("#form_data")[0].reset();
     } else if(a == "0") {
       $("#infoD").html("Error al Insertar Usuario").show().delay(2000).fadeOut(400);
     }
     else if (a == "2") {
       $("#infoS").html("Usuario Editado Correctamente").show().delay(2000).fadeOut(400);
       $("#form_data")[0].reset();
     }
     else if(a == "3") {
       $("#infoD").html("Error al Editar el Usuario").show().delay(2000).fadeOut(400);

     }

   });

   }

});

  $("#list_usuarios").on("click",".eliminar_registro", function(e){
    e.preventDefault();
    let c = confirm('Desea Eliminar Este Registro');
    if (c) {
       let id = $(this).data('id');
       obj = {
        "action" : "eliminar_registro",
        "id" : id
       };
       $.post('includes/_funciones.php', obj, function(i) {

       if (i == "1") {
       $("#infoS").html("Usuario Eliminado Correctamente").show().delay(2000).fadeOut(400);
      
       consultar();
     } else {
       $("#infoD").html("Error al Eliminar Usuario").show().delay(2000).fadeOut(400);
      
     }
       });
    }else{
      $("#infoD").html("El Registro No Se a Eliminado").show().delay(2000).fadeOut(400);
      
    }
  });

    $("#list_usuarios").on("click",".editar_registro", function(e){
    e.preventDefault();
    $("#form_data")[0].reset();
    change_view('insert_data');
    let id = $(this).data('id');
    let obj = {
      "action" : "consultar_registro",
      "id" : id
    }; 

    $("#guardar_datos").text("Editar").data("editar", 1).data("id", id);   
    $.post('includes/_funciones.php', obj, function(r) {
     $("#nombre").val(r.nombre_usr);
     $("#mail").val(r.correo_usr);
     $("#telefono").val(r.telefono_usr);
     $("#password").val(r.pswd_usr);
  }, "JSON");
  });

  $(document).ready(function(){
    consultar();
    change_view();
  }); 

  $("#main").find(".cancelar").click(function() {
    change_view();
    $("#form_data")[0].reset();
  });

$("#foto").on("change", function (e){
 let formDatos = new FormData($("#form_data")[0]);
 formDatos.append("action", "carga_foto");
  $.ajax({
    url: 'includes/_funciones.php',
    type: 'POST',
    data: formDatos,
    contentType: false,
    processData: false,
    success: function(datos) {
      let respuesta = JSON.parse(datos);
      if (respuesta.status == 0){
        alert("No cargó la foto");
      }
  let template = `<img src="${respuesta.archivo}" alt="" class="img-fluid" />`;
  $("#ruta").val(respuesta.archivo);
  $("#preview").html(template);
    }
  });
  });
  

</script>
</body>
</html>  

<?php 
  }
  else 
  {
    header("Location:index.php");
  }
?>