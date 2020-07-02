    <?php
    require_once "../modelo/Compra.php";
    // print_r("holaaa");
    $compra = new Compra();

    $FcTransaccion="";
    $IdTercero="";
    $NuDocumento="";
    $FcDocumento="";
    $Observaciones="";   
    // $IdTransaccionCab="";
    // $IdProducto="";   
  
    
  // ---------------------------------movimiento cabecera------------------------------
    (isset($_POST["FcTransaccion"])) ? $FcTransaccion = $_POST["FcTransaccion"] : "";      // ? LimpiarCadena($_POST["NmOficina"]) : "";
    (isset($FcTransaccion)) ? $FcTransaccion = date("Y-m-d H:m:s", strtotime($FcTransaccion)) : "";
    (isset($_POST["IdTercero"])) ? $IdTercero = $_POST["IdTercero"] : ""; 
    (isset($_POST["NuDocumento"])) ? $NuDocumento = $_POST["NuDocumento"] : ""; 
    (isset($_POST["FcDocumento"])) ? $FcDocumento = $_POST["FcDocumento"] : "";   
    (isset($FcDocumento)) ? $FcDocumento = date("Y-m-d H:m:s", strtotime($FcDocumento)) : "";
    (isset($_POST["Observaciones"])) ? $Observaciones =  $_POST["Observaciones"] : ""; 
  // ---------------------------------movimiento detalle------------------------------------
    // (isset($_POST["IdTransaccionCab"])) ? $IdTransaccionCab = $_POST["IdTransaccionCab"] : ""; 
    
    
    session_start();
    switch ($_GET["op"]) {
        
       case 'guardar':
        $rspta = $compra->insertar($FcTransaccion,$IdTercero,$NuDocumento,$FcDocumento,$Observaciones);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
       break;
       
       case 'guardardet':
        $filas = json_decode($_POST['valores'], true); // json_decode DECODIFICAR STRING
        $rspta =  $compra->insertardet($filas); 
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
       break;
       
       case 'existencias':
        $rows = json_decode($_POST['valores'], true); // json_decode DECODIFICAR STRING
        $rspta =  $compra->existencias($rows); 
        echo  $rspta ? "Existencia Actualizada" : "Los datos no se pudieron Actualizar";
       break;
       
       case 'search':
        $NmProducto = json_decode($_POST['NmProducto'], true); //json_decode DECODIFICAR STRING
        $NmProducto = $NmProducto['NmProducto'];
        $rspta = $compra->search($NmProducto);
        echo json_encode($rspta);
       break;
       
      //  case 'iva':
      //   $IdProducto = json_decode($_POST['IdProducto'], true); // json_decode DECODIFICAR STRING
      //   $rspta = $compra->iva($IdProducto);
      //   echo  $rspta;
      //  break;

      case 'selectTercero':
        $rspta = $compra->selectTercero();
        echo '<option value="" selected disabled> Seleccionar proveedor</option>';
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          echo '<option value="' . $reg['IdTercero'] . '">' . $reg['IdTercero'] . ' - ' . $reg['NmRazonSocial'] . '</option>';
        }
      break;
      
      case 'selectNmProducto':
        $rspta = $compra->selectNmProducto();
        echo '<option value="" selected disabled> Seleccionar producto </option>';
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          echo '<option>' . $reg['NmProducto'] . '</option>';
        }
      break;
        
      case 'idlast':
        $rspta = $compra->idlast();
        echo  $rspta;
      break;
        
      case'salir':
        session_destroy();
        header("location:../vista/log.php");
      break;
    }
    ?>