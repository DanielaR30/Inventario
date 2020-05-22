<!doctype html>
<html lang="en">
  <head>
    <title>Kardex - Entrar o registrarse</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="shortcut icon" href="../public/img/favicoon.ico">
    
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="crossorigin="anonymous"></script>          
<!-- <script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script> -->
    

    <div id="formWrapper ">
     <form name="formulario" id="formulario" method="post">
    <div id="form">
              <div class="logo">
              <h1 class="logo-active"> Iniciar Sesión </h1>
              </div>
            <div class="form-item">
                <p class="formLabel"> <i class="fas fa-user-circle"></i> Nombre</p>
                <input type="text" name="NmUsuario" id="NmUsuario" class="form-style" autocomplete="off" 
                data-toggle="popover" data-content="El nombre de usuario no coincide con ninguna cuenta."/>
     <!-- <span id="etiqueta" style="display:none; color:rgba(255, 0, 0, 0.904);">
     <i class="fas fa-exclamation-circle"></i> Este campo es obligatorio.</span>  -->
     
      <!-- <span id="valid" style="display:none; color:rgba(255, 0, 0, 0.904);">
<i class="fas fa-exclamation-circle"></i> El nombre de usuario no coincide con ninguna cuenta.</span>  -->
            <!-- <span id="etiqueta"></span>  -->
            <!-- <span id="info"></span> -->
            </div>
                        
            <div class="form-item">
                <p class="formLabel"> <i class="fas fa-key"></i> Contraseña</p>
                <input type="password" name="Clave" id="Clave" class="form-style" autocomplete="off" 
                data-toggle="popover" data-content="Contraseña Incorrecta."/>
     <!-- <span id="etiquet" style="display:none; color:rgba(255, 0, 0, 0.904);">
     <i class="fas fa-exclamation-circle"></i> Este campo es obligatorio.</span>  -->
            <!-- <span id="etiquet"></span> -->
            <!-- <span id="pass"></span> -->
                
            </div>
            <div class="form-item">
            <!-- <p class="pull-left"><a href="#"  class="reg">Crear cuenta</a></p> -->
            <input type="submit" name="login" class="login pull-right" value="Acceder" id="acceder">

            <div class="clear-fix"> </div>
            </div>
          </form>
    </div>
    </div>
    <script src="js/log.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script>
               document.cookie = 'same-site-cookie=foo; SameSite=Lax';
               document.cookie = 'cross-site-cookie=bar; SameSite=None; Secure';
          </script>
          <!-- <script src="https://code.jquery.com/jquery-3.4.1.js"
                  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
                  crossorigin="anonymous"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>