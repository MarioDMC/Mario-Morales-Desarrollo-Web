<?php
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['user'];

  if (isset($varsesion)){

  ?>

<?php include("includes/_session.php") ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Header & Bottom</title>

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

        <h1 class="h2">Header</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
              <div class= "btn-group mr-2">  
                         <form action="" enctype="form-data" id="form_data">               
                <button type="button" class="btn btn-sm btn-outline-success" id="guardar_datos" ">Guardar</button>
          </div>
        </div>
      </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="tituloHeader">Title</label>
                  <textarea id="tituloHeader" name="tituloHeader" class="form-control" rows="3" ></textarea>
                </div>
                <div class="form-group">
                  <label for="textoHeader">Text</label>
                  <textarea  id="textoHeader" name="textoHeader" class="form-control" rows="3"></textarea>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="botonHeader">Button text</label>
                  <textarea  id="botonHeader" name="botonHeader" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="linkHeader">Link</label>
                  <textarea id="linkHeader" name="linkHeader" class="form-control" rows="3"></textarea>
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col">

              </div>
            </div>
          </form>
        </div>
                </main>

       <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="main">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bottom</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <form action="" enctype="form-data" id="form_data">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="texto">Location</label>
                  <textarea id="locationFooter" name="locationFooter" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="aboutFooter">About</label>
                 <textarea id="aboutFooter" name="aboutFooter" class="form-control" rows="3"></textarea>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="copyrightFooter">Copyright</label>
                  <textarea id="copyrightFooter" name="copyrightFooter" class="form-control" rows="3"></textarea>
                </div>
              </div>
            </div>
          </form>
        </div>
         </main>

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

$(function consultarHeader(){

    let obj = {
      "action" : "consultar_header"
    };

    $.post('includes/_funciones.php', obj, function(r) {

    $("#tituloHeader").val(r.title_header);
    $("#textoHeader").val(r.content_header);
    $("#botonHeader").val(r.link_header);
    $("#linkHeader").val(r.href_header);
    }, "JSON");

   });

$(function consultarFooter(){

    let obj = {
      "action" : "consultar_footer"
    };

    $.post('includes/_funciones.php', obj, function(r) {

    $("#tituloHeader").val(r.title_header);
    $("#textoHeader").val(r.content_header);
    $("#botonHeader").val(r.link_header);
    $("#linkHeader").val(r.href_header);
    }, "JSON");
    
   });


</script>
<script>
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