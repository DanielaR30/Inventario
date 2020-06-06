    <?php
    require_once "../modelo/Movimientocab.php";
    // print_r("holaaa");
    $movimientocab = new Movimientocab();

    $IdTransaccion="";
    $FcTransaccion="";
    $IdTercero="";
    $NuDocumento="";
    $FcDocumento="";
    $Observaciones="";   
  
  
    (isset($_POST["FcTransaccion"])) ? $FcTransaccion = $_POST["FcTransaccion"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
    (isset($FcTransaccion)) ? $FcTransaccion = date("Y-m-d H:m:s", strtotime($FcTransaccion)) : "";
    
    (isset($_POST["IdTercero"])) ? $IdTercero = $_POST["IdTercero"] : ""; // ? LimpiarCadena($_POST["Direccion"]) : "";
    (isset($_POST["NuDocumento"])) ? $NuDocumento = $_POST["NuDocumento"] : "";  // ? LimpiarCadena($_POST["Telefono"]) : "";
    
    (isset($_POST["FcDocumento"])) ? $FcDocumento = $_POST["FcDocumento"] : "";   // ? LimpiarCadena($_POST["IdCiudad"]) : "";
    (isset($FcDocumento)) ? $FcDocumento = date("Y-m-d H:m:s", strtotime($FcDocumento)) : "";
    
    (isset($_POST["Observaciones"])) ? $Observaciones =  $_POST["Observaciones"] : ""; // ? LimpiarCadena($_POST["FlPuntodeAtencion"]) : "";
    
    // (isset($_POST["FcApertura"])) ? $FcApertura = $_POST["FcApertura"] : ""; // ? LimpiarCadena($_POST["FcApertura"]) : "";
    // (isset($FcApertura)) ? $FcApertura = date("Y-m-d H:m:s", strtotime($FcApertura)) : "";

    session_start();
    switch ($_GET["op"]) {
        
       case 'guardar':
        $rspta = $movimientocab->insertar($FcTransaccion,$IdTercero,$NuDocumento,$FcDocumento,$Observaciones);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
       break;

        case 'selectTercero':
          $rspta = $movimientocab->selectTercero();
          echo '<option value="" selected disabled> Seleccione el proveedor</option>';
          while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
            echo '<option value="' . $reg['IdTercero'] . '">' . $reg['IdTercero'] . ' - ' . $reg['NmRazonSocial'] . '</option>';
          }
        break;
        
        case 'idlast':
          $rspta = $movimientocab->idlast();
          echo  $rspta;
        break;
        
        case'salir':
          session_destroy();
          header("location:../vista/log.php");
        break;
    }
    
    ?>