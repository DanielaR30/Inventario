<?php
 session_start();
            // print_r($_SESSION);die();
 if (!isset($_SESSION["NmUsuario"])) 
 {          // print_r('holaaaaaa'); die();
   header("location:../log.php");  
 } else{
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Inventario - Index</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

 <!-- google fonts -->
 <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=Muli&display=swap" rel="stylesheet">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- <link href="../../plugin" rel="stylesheet" /> -->
    <!-- <script src="path/to/select2.min.js"></script> -->

    <!-- =======================================================
  * Template Name: KnightOne - v2.0.0
  * Template URL: https://bootstrapmade.com/knight-simple-one-page-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  
  <style type="text/css">
    .min{
      color : #2c2c2c;
    }
    
    .min :hover{
       color: #088b3a;
    }
    </style>  
</head>

<body>


<div id="carrito" class="container-fluid" style="max-width: 2000px; height: 700px;">
          
          <div class="row">
              <div class="col position-relative">
              
              
          <div class="row border-bottom border-success">
            <div class="mt-3 ml-5">
                <a id="hidecarrito" href="#" class="min"><h1><i class="fas fa-chevron-right"></i></h1></a>
            </div>
           
                <div class="col d-flex justify-content-center pt-4 pb-2 ">
                  <h3 style="font-family: 'Pacifico', cursive;"><i class="fas fa-shopping-cart"></i>&nbsp; Carrito</h3>
                </div>
          </div> 
         
          <div class="row">
           <div class="col col-8 pt-4 pl-4">
           <!-- <div class="col col-8 pt-5" data-spy="scroll" data-target="#navbar-example2" data-offset="0"> -->
           <table id="tb" class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col" colspan="2">Producto</th> 
                  <th scope="col" colspan="2">Cantidad</th>
                </tr>
              </thead>
              <tbody>
               
               <!-- 
               '<tr><td style="display:none;">' + IdProducto + 
               '</td><td style="width: 30px;"><img  class="img-fluid" src="../../public/img/' + ImagenProducto + 
               '" alt=""></td><td style="width: 30px;"><h6> ' + NmProducto + 
               '</h6></td><td style="width: 30px;"><input style="width: 20%;" type="number" value="1" class="form-control cantidad"></td><td style="width: 10px;"> <button id="' + ida + '" onclick="eliminaritem(' + IdProducto + 
               ')" data-toggle="tooltip" data-placement="bottom" title="Eliminar" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="fas fa-times"></i></button></td></tr>'
               -->
        
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
                       <button type="button" id="ingresar" class="btn btn-success btn-lg btn-block">Realizar Pedido</button>
                  </div>
             </div>
           </form>
           </div>
          </div>
              
              </div>
          </div>
        </div>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-xl-9 d-flex align-items-center justify-content-between">
                    <!-- <img src="../../public/images/lg.png" width="50px" height="50px" alt="" class="logo"> -->
                    <!-- <h1 class="logo"><a href="index.html">KnightOne</a></h1> -->
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <a href="index.php" class="logo"><img src="../../public/images/lg.png" width="50px" height="50px" alt="" class="img-fluid"></a>

                    <nav class="nav-menu d-none d-lg-block">
                        <ul>
                       
                            <li id="vercarrito"><a href="#"><i class="fas fa-shopping-cart"></i></a></li>     
                            <li id="prod"><a href="#portfolio">Productos</a></li>
                            
                            <?php if ($_SESSION["TipoUsuario"] === 'A' ) { ?>  
                                 <li><a href="../Dashboard/index.php"> Panel de Control</a></li>
                            <?php } ?>  
                            <li class="dropdown user user-menu">
                                    
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                  <!-- <img src="../../public/images/lg1.png" class="user-image" alt="User Image"> -->
                                  <span class="hidden-xs"> <?php print_r($_SESSION["NmUsuario"]);?> </span>
                                </a>
                    
                                <ul class="dropdown-menu">
                                    <li class="">
                                        
                              <a href="../../modelo/Logout.php" type="button" class="btn btn-secondary p-1"><i class="fas fa-sign-out-alt"></i>&nbsp; Salir</a>
                                     
                                  </li>
                                </ul>
                              </li>
                        </ul>
                    </nav>
                    <!-- .nav-menu -->
                    <!-- <a href="#about" class="get-started-btn scrollto">Get Started</a> -->
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex flex-column justify-content-center">
        <div  class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <h1>Inventario</h1>
                    <h2>Coeducadores Boyacá</h2>
                    <!-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a> -->
                </div>
            </div>
        </div>
    </section>
    
    <!-- End Hero -->

    <main id="main">

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container">

        <div class="row">
            <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-4">
                 <button class="btn btn-success pull-left" style="margin-left: 4px" type="button"  id="btnnvo"><i class="fas fa-truck"></i>&nbsp;Nuevo pedido</button> 
            </div>
        </div>  

            <div id="pedidocab" class="row">
                <div class="col">
                 <form class="form-horizontal" name="formulario" id="formulario" action="" method="post">
                 
                     
              <div class="row">
                      <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="FcOrdenPedido" class="col-sm-2 control-label">Fecha</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="FcOrdenPedido" id="FcOrdenPedido" readonly>
                             <span class="infoDi" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Campo requerido, Ingrese 1 dígito.</i>
                              </span>
                            </div>
                       </div>
              </div>
              
              <div class="row">
                    <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="IdTercero" class="col-sm-2 control-label">Tercero</label>
                            <div class="col-lg-10">
                            <select class="form-control select2" style="width: 100%;" name="IdTercero" id="IdTercero"></select>
                            <span class="infoCor" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Campo requerido.</i>
                             </span>
                            </div>
                      </div>
               </div>
         
              <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-4 d-flex justify-content-end">
                <button class="btn btn-outline-secondary pull-left" style="margin-left: 4px" type="button"  id="btnGuardar">Siguiente &nbsp;<i class="fas fa-chevron-right"></i></button> 
              </div>
              <!-- <button type="button" class="btn btn-primary pull-right">Sign in</button> -->
             
                </form>
                </div>
            </div>

<div class="row" id="card">
    <div class="col col-lg-12">
    <div class="section-title">
    
    <!-- <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-secondary"><select class="form-control select2" style="width: 100%;" name="IdClase" id="IdClase"></select>
</button>
          <button type="button" class="btn btn-secondary"><i class="fas fa-shopping-cart"></i>Mi carrito</button>
    </div> -->
                <div> 
                   <div class="row">
                    <div class="inputWithIcon form-group col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            <div class="col-lg-10">
                            <select class="form-control select2" style="width: 100%;" name="IdClase" id="IdClase"></select>
                            <span class="infoCor" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Campo requerido.</i>
                            </span>
                            </div>
                      </div>
                      
                   </div>
                </div>
                <div class="alert alert-secondary" id="alertcarr" style="display:none; position: fixed; top: 540px; right: 1000px;"> Producto agregado &nbsp; &nbsp; &nbsp;
                        <a href="#" id="vercarrit" class="badge badge-success">Ver carrito</a>&nbsp; &nbsp; &nbsp;<i class="fas fa-times"></i>
                </div>
    </div>         
               <!-- <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-app">App</li>
                            <li data-filter=".filter-card">Card</li>
                            <li data-filter=".filter-web">Web</li>
                        </ul>
                    </div>
                </div> -->

                <div class="row portfolio-container h-100">
                
                    <!-- <div class="col col-8 pt-5">
                       <table id="tb" class="table table-borderless">
                          <thead>
                            <tr>
                              <th scope="col" colspan="2">Producto</th> 
                              <th scope="col" colspan="2">Cantidad</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                       </table>
                    </div> -->
                </div>
    </div>
</div>
                
           
            </div>
        </section>
        <!-- End Portfolio Section -->
        <br><br>

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title">
                    <!-- <h2>Services</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi
                        quidem hic quas.</p> -->
                </div>

                <div class="row">

                    <!-- <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h4><a href="">Lorem Ipsum</a></h4>
                            <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4><a href="">Sed ut perspiciatis</a></h4>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-tachometer"></i></div>
                            <h4><a href="">Magni Dolores</a></h4>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-world"></i></div>
                            <h4><a href="">Nemo Enim</a></h4>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-slideshow"></i></div>
                            <h4><a href="">Dele cardo</a></h4>
                            <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-arch"></i></div>
                            <h4><a href="">Divera don</a></h4>
                            <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
                        </div>
                    </div> -->

                </div>

            </div>
        </section>
        <!-- End Services Section -->

        <!-- ======= Cta Section ======= -->
        <section id="cta" class="cta">
            <div class="container">

                <div class="row">
                    <div class="col-lg-9 text-center text-lg-left">
                        <!-- <h3>Call To Action</h3>
                        <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    -->
                    </div>
                    <div class="col-lg-3 cta-btn-container text-center">
                        <!-- <a class="cta-btn align-middle" href="#">Call To Action</a> -->
                    </div>
                </div>

            </div>
        </section>
        <!-- End Cta Section -->

        <!-- ======= Features Section ======= -->
        <!-- <section id="features" class="features">
            <div class="container"> -->

        <!-- <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div class="icon-box mt-5 mt-lg-0">
                            <i class="bx bx-receipt"></i>
                            <h4>Est labore ad</h4>
                            <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                        </div>
                        <div class="icon-box mt-5">
                            <i class="bx bx-cube-alt"></i>
                            <h4>Harum esse qui</h4>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                        </div>
                        <div class="icon-box mt-5">
                            <i class="bx bx-images"></i>
                            <h4>Aut occaecati</h4>
                            <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                        </div>
                        <div class="icon-box mt-5">
                            <i class="bx bx-shield"></i>
                            <h4>Beatae veritatis</h4>
                            <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                        </div>
                    </div>
                    <div class="image col-lg-6 order-1 order-lg-2" style='background-image: url("assets/img/features.jpg");'></div>
                </div> -->
        <!-- 
        </div>
        </section> -->
        <!-- End Features Section -->

        <!-- ======= Clients Section ======= -->
        <!-- <section id="clients" class="clients">
            <div class="container">


            </div>
        </section> -->
        <!-- End Clients Section -->

        <!-- ======= Counts Section ======= -->
        <!-- <section id="counts" class="counts">
            <div class="container">

                <div class="text-center title">
                    <h3>What we have achieved so far</h3>
                    <p>Iusto et labore modi qui sapiente xpedita tempora et aut non ipsum consequatur illo.</p>
                </div>

                <div class="row counters">

                    <div class="col-lg-3 col-6 text-center">
                        <span data-toggle="counter-up">232</span>
                        <p>Clients</p>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-toggle="counter-up">521</span>
                        <p>Projects</p>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-toggle="counter-up">1,463</span>
                        <p>Hours Of Support</p>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-toggle="counter-up">15</span>
                        <p>Hard Workers</p>
                    </div>

                </div>

            </div>
        </section> -->
        <!-- End Counts Section -->



        <!-- ======= Pricing Section ======= -->
        <!-- <section id="pricing" class="pricing">
            <div class="container">

                <div class="section-title">
                    <h2>Pricing</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi
                        quidem hic quas.</p>
                </div>

                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="box">
                            <h3>Free</h3>
                            <h4><sup>$</sup>0<span> / month</span></h4>
                            <ul>
                                <li>Aida dere</li>
                                <li>Nec feugiat nisl</li>
                                <li>Nulla at volutpat dola</li>
                                <li class="na">Pharetra massa</li>
                                <li class="na">Massa ultricies mi</li>
                            </ul>
                            <div class="btn-wrap">
                                <a href="#" class="btn-buy">Buy Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
                        <div class="box recommended">
                            <span class="recommended-badge">Recommended</span>
                            <h3>Business</h3>
                            <h4><sup>$</sup>19<span> / month</span></h4>
                            <ul>
                                <li>Aida dere</li>
                                <li>Nec feugiat nisl</li>
                                <li>Nulla at volutpat dola</li>
                                <li>Pharetra massa</li>
                                <li class="na">Massa ultricies mi</li>
                            </ul>
                            <div class="btn-wrap">
                                <a href="#" class="btn-buy">Buy Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
                        <div class="box">
                            <h3>Developer</h3>
                            <h4><sup>$</sup>29<span> / month</span></h4>
                            <ul>
                                <li>Aida dere</li>
                                <li>Nec feugiat nisl</li>
                                <li>Nulla at volutpat dola</li>
                                <li>Pharetra massa</li>
                                <li>Massa ultricies mi</li>
                            </ul>
                            <div class="btn-wrap">
                                <a href="#" class="btn-buy">Buy Now</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section> -->
        <!-- End Pricing Section -->

        <!-- ======= Faq Section ======= -->
        <!-- <section id="faq" class="faq">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                        <div class="content">
                            <h3>Frequently Asked <strong>Questions</strong></h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                            </p>
                        </div>

                        <div class="accordion-list">
                            <ul>
                                <li>
                                    <a data-toggle="collapse" class="collapse" href="#accordion-list-1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-1" class="collapse show" data-parent=".accordion-list">
                                        <p>
                                            Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-toggle="collapse" href="#accordion-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-2" class="collapse" data-parent=".accordion-list">
                                        <p>
                                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in
                                            cursus turpis massa tincidunt dui.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-toggle="collapse" href="#accordion-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-3" class="collapse" data-parent=".accordion-list">
                                        <p>
                                            Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna
                                            molestie at elementum eu facilisis sed odio morbi quis
                                        </p>
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>

                    <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("assets/img/faq.jpg");'>&nbsp;</div>
                </div>

            </div>
        </section> -->
        <!-- End Faq Section -->

        <!-- ======= Contact Section ======= -->
        <!-- <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi
                        quidem hic quas.</p>
                </div>
            </div>

            <div>
                <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
                    frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="container">

                <div class="row mt-5">

                    <div class="col-lg-4">
                        <div class="info">
                            <div class="address">
                                <i class="ri-map-pin-line"></i>
                                <h4>Location:</h4>
                                <p>A108 Adam Street, New York, NY 535022</p>
                            </div>

                            <div class="email">
                                <i class="ri-mail-line"></i>
                                <h4>Email:</h4>
                                <p>info@example.com</p>
                            </div>

                            <div class="phone">
                                <i class="ri-phone-line"></i>
                                <h4>Call:</h4>
                                <p>+1 5589 55488 55s</p>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-8 mt-5 mt-lg-0">

                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                    <div class="validate"></div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                    <div class="validate"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                <div class="validate"></div>
                            </div>
                            <div class="mb-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>

                    </div>

                </div>

            </div>
        </section> -->
        <!-- End Contact Section -->

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <h3>KnightOne</h3>
            <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
            <div class="social-links">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
            <div class="copyright">
                &copy; Copyright <strong><span>KnightOne</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/knight-simple-one-page-bootstrap-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <script src="../js/pedidocab.js"></script>
    
    
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counterup/counterup.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/venobox/venobox.min.js"></script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
<?php
}
?>