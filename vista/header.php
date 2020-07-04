<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventario</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="../public/css/font-awesome.css">  
  <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../public/css/_all-skins.min.css">
  <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
  
  <link rel="shortcut icon" href="../public/img/favicoon.ico">
  <!-- Estilos del datatables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="../public/datatables/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="../public/datatables/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="../public/datatables/fixedColumns.dataTables.min.css">
  
  <!-- sweetalert2 -->
  <link rel="stylesheet" href="../public/css/sweetalert.min.css" />
  
  <!-- bootstrap-select -->
  <link rel="stylesheet" href="../public/css/bootstrap-select.min.css"> 
  
   <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../public/plugins/select2-bootstrap4-theme-master/dist/select2-bootstrap4.css">
  
  <!-- datepicker -->
  <link href = "../public/plugins/datepicker-master/src/css/datepicker.css" rel = " stylesheet "> 
     
  
<style type="text/css">
.thumb-image{
 float:left;
 width:167px;
 position:relative;
 padding:3px;
}
</style>
 
</head>

<body class="hold-transition skin-green	sidebar-mini ">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="Example/index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>I</b>NV</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Inventario</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Navegación</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
        
          
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../public/images/lg1.png" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php print_r($_SESSION["NmUsuario"]);?> </span>
                <!-- echo '<h1>Welcome - ' .$_SESSION["NmUsuario"]. '</h1>';   -->
              </a>
              <ul class="dropdown-menu">
              
                 <!-- User image -->
                 <li class="user-header">
                <img src="../public/images/lg1.png" class="img-circle" alt="User Image">

                <p>
                <?php print_r($_SESSION["NmUsuario"]);?> 
                  <!-- <small>Member since Nov. 2012</small> -->
                </p>
              </li>             
                            
                <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <!-- <a href="#">Seguidores</a> -->
                  </div>
                  <div class="col-xs-4 text-center">
                    <!-- <a href="#">Ventas</a> -->
                  </div>
                  <div class="col-xs-4 text-center">
                    <!-- <a href="#">Amigos</a> -->
                  </div>
                </div>
                <!-- /.row -->
              </li>
              
                <!-- Menu Footer-->
                <li class="user-footer">
                <div class="pull-left">
                  <!-- <a href="#" class="btn btn-default btn-flat">Perfil</a> -->
                </div>
                  <div class="pull-right">
                    <a href="../modelo/Logout.php"  class="btn btn-default btn-flat"><i class="fas fa-sign-out-alt"></i>&nbsp; Salir</a>
                  </div>
                </li>
              </ul>
            </li>
             <!-- Control Sidebar Toggle Button -->
              <li>
                <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
              </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
             <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../public/images/lg1.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php print_r($_SESSION["NmUsuario"]);?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
        <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->