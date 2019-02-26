<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Botton</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
      <link href="../css/style.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">ActiveBox</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</nav>

<?php include("includes/_dashboard.php") ?>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="main">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Header & Bottom</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <form action="" enctype="form-data" id="form_data">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="texto">Titulo</label>
                  <input type="text" id="titulo" name="titulo" class="form-control">
                </div>
                <div class="form-group">
                  <label for="texto">Texto</label>
                  <input type="text" id="texto" name="texto" class="form-control">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="nombre">Texto Boton</label>
                  <input type="name" id="boton" name="boton" class="form-control" >
                </div>
                <div class="form-group">
                  <label for="texto">Link</label>
                  <input type="text" id="link" name="link" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <button type="button" class="btn btn-success" id="guardar_datos" ">Guardar</button>
              </div>
            </div>
          </form>
        </div>
                </main>

       <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="main">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Header & Bottom</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <form action="" enctype="form-data" id="form_data">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="texto">Titulo</label>
                  <input type="text" id="titulo" name="titulo" class="form-control">
                </div>
                <div class="form-group">
                  <label for="texto">Texto</label>
                  <input type="text" id="texto" name="texto" class="form-control">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="nombre">Texto Boton</label>
                  <input type="name" id="boton" name="boton" class="form-control" >
                </div>
                <div class="form-group">
                  <label for="texto">Link</label>
                  <input type="text" id="link" name="link" class="form-control">
                </div>
              </div>
            </div>
          </form>
        </div>
         </main>

<script src="includes/_header.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  
<script>

$(function updateHeader() {  
  
  $("#guardar_datos").click(function() {
   let titulo = $("#titulo").val();
   let texto = $("#texto").val();
   let boton = $("#boton").val();
   let link = $("#link").val();
   let obj ={
    "action" : "update_header",
    "titulo" : titulo,
    "texto" : texto,
    "boton" : boton,
    "link" : link
   }

   $("#form_data").find("input").each(function(r){
    $(this).removeClass("has-error");
   if ($(this).val() != "") {
      obj[$(this).prop("name")] = $(this).val();
   }else{
    $(this).addClass("has-error").focus();
    return false;
   }

  });

   $.post('includes/_funciones.php', obj, function() {});

   });

  $("#main").find(".cancelar").click(function() {
    change_view();
    $("#form_data")[0].reset();
  });
});

</script>
<script>
</script>
</body>
</html>