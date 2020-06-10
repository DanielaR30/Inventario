<?php
 session_start();
 //print_r($_SESSION);die();
 if (!isset($_SESSION["NmUsuario"]))
 {
  //  print_r('holaaaaaa'); die();
   header("location:log.php");
 }
 else
 {

?>


<!doctype html>
<html lang="en">
  <head>
    <title>Inventario</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
    <!-- font awesomoe -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   
    <!-- Favicons -->
   <link rel="shortcut icon" href="../public/img/favicoon.ico">
   
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  
  
    <style type="text/css">
    .min{
      color : #2c2c2c;
    }
    
    .min :hover{
       color: #088b3a;
    }
    </style>
  </head>
  
  <body id="carrito">
      
    <div class="container-fluid">
        
      <div class="row border-bottom border-success">
        <div class="mt-3 ml-5">
            <a href="Index/index.php" class="min"><h1><i class="fas fa-chevron-right"></i></h1></a>
        </div>
       
            <div class="col d-flex justify-content-center pt-4 pb-2">
              <h3 style="font-family: 'Pacifico', cursive;"><i class="fas fa-shopping-cart"></i> &nbsp; Carrito</h3>
            </div>
      </div> 
      
        
      <div class="row">
      
       <div class="col col-8 pt-5">
       <!-- <div class="col col-8 pt-5" data-spy="scroll" data-target="#navbar-example2" data-offset="0"> -->
       
       <table id="tb" class="table table-borderless">
          <thead>
            <tr>
              <th scope="col" colspan="2">Producto</th> 
              <th scope="col" colspan="2">Cantidad</th>
            </tr>
          </thead>
          <tbody>
           <!-- '<tr> <td> <img  class="img-fluid" src="../../public/img/' + ImagenProducto + '" alt=""></td><td>' + NmProducto +
           '</td> <td><input style="width: 30%;" type="text" class="form-control" name="NuCantidad" id="NuCantidad"></td></tr>' -->
          </tbody>
       </table>
    
      </div>
       
       <div class="col col-4 border-left mt-5" style="height:450px;">
       
       <form class="form-horizontal" action="" method="post">
         <div class="row">
          <div class="col col-lg-12  pl-4">
                <label for="Observaciones" class="col-lg-1 control-label"> <b>Observaciones</b> </label>
                  <div style="width: 92%;">
                    <textarea class="form-control" name="Observaciones" id="Observaciones" maxlength="255" rows="4" cols="50" style="resize: none;"></textarea>
                  <!-- <input type="text" class="form-control" name="Descripcion" id="Descripcion" required> -->
                    <span class="infoDir" style="display:none; color:rgba(230, 35, 18, 0.952);">
                        <i class="fas fa-exclamation-circle"> Campo requerido. Ingrese máximo 255 caracteres.</i>
                    </span>
                  </div>
          </div>
            
              <div class="col col-lg-10 pt-4 d-flex justify-content-center ml-4">
                   <button type="button" class="btn btn-success btn-lg btn-block">Realizar Pedido</button>
              </div>
         </div>
       </form>
       
    
       </div>
      </div>
    </div>
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script src="js/pedidocab.js"></script>
  
  </body>
</html>


<?php
}
?>