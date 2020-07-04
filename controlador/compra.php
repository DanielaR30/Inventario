    <?php
    require_once "../modelo/Compra.php";
    $compra = new Compra();

    $FcTransaccion="";
    $IdTercero="";
    $NuDocumento="";
    $FcDocumento="";
    $Observaciones="";   
    
    
  // ---------------------------------COMPRA cabecera------------------------------
    (isset($_POST["FcTransaccion"])) ? $FcTransaccion = $_POST["FcTransaccion"] : "";      // ? LimpiarCadena($_POST["NmOficina"]) : "";
    (isset($FcTransaccion)) ? $FcTransaccion = date("Y-m-d H:m:s", strtotime($FcTransaccion)) : "";
    (isset($_POST["IdTercero"])) ? $IdTercero = $_POST["IdTercero"] : ""; 
    (isset($_POST["NuDocumento"])) ? $NuDocumento = $_POST["NuDocumento"] : ""; 
    (isset($_POST["FcDocumento"])) ? $FcDocumento = $_POST["FcDocumento"] : "";   
    (isset($FcDocumento)) ? $FcDocumento = date("Y-m-d H:m:s", strtotime($FcDocumento)) : "";
    (isset($_POST["Observaciones"])) ? $Observaciones =  $_POST["Observaciones"] : ""; 
    
    
    session_start();
    switch ($_GET["op"]) {
        
        //GUARDAR CAB COMPRA
       case 'guardar':
        $rspta = $compra->insertar($FcTransaccion,$IdTercero,$NuDocumento,$FcDocumento,$Observaciones);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
       break;
       
       //GUARDAR DETALLE COMPRA
       case 'guardardet':
        $filas = json_decode($_POST['valores'], true); // json_decode DECODIFICAR STRING
        $rspta =  $compra->insertardet($filas); 
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
       break;
       
      //ACTUALIZAR CANTIDAD DE PRODUCTO
       case 'existencias':
        $rows = json_decode($_POST['valores'], true); // json_decode DECODIFICAR STRING
        $rspta =  $compra->existencias($rows); 
        echo  $rspta ? "Existencia Actualizada" : "Los datos no se pudieron Actualizar";
       break;
       
       //ACTULIZAR SUBTOTAL,IVA EN CAB COMPRA
       case 'subtotal':
        $rows = json_decode($_POST['valores'], true); // json_decode DECODIFICAR STRING
        $rspta =  $compra->subtotal($rows); 
        echo  $rspta ? "Compra Actualizada" : "Los datos no se pudieron Actualizar";
       break;
       
         //BUSCAR CODIGO,IVA,EXISTENCIAS SEGUN NOMBRE PRODUCTO
       case 'search':
        $NmProducto = json_decode($_POST['NmProducto'], true); //json_decode DECODIFICAR STRING
        $NmProducto = $NmProducto['NmProducto'];
        $rspta = $compra->search($NmProducto);
        echo json_encode($rspta);
       break;

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
        
     //MOSTRAR EL ULTIMO ID DE CAB
      case 'idlast':
        $rspta = $compra->idlast();
        echo  $rspta;
      break;
        
     //CERRAR SESION   
      case'salir':
        session_destroy();
        header("location:../vista/log.php");
      break;
    }
    ?>