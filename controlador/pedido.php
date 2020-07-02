    <?php
    require_once "../modelo/Pedido.php";
    // print_r("holaaa");
    $pedido = new Pedido();

    $FcOrdenPedido="";
    $IdTercero="";
  
    (isset($_POST["FcOrdenPedido"])) ? $FcOrdenPedido = $_POST["FcOrdenPedido"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
    (isset($FcOrdenPedido)) ? $FcOrdenPedido = date("Y-m-d H:m:s", strtotime($FcOrdenPedido)) : "";
    (isset($_POST["IdTercero"])) ? $IdTercero = $_POST["IdTercero"] : ""; // ? LimpiarCadena($_POST["Direccion"]) : "";
    
    session_start();
    switch ($_GET["op"]) {
        
       case 'guardar':
        $rspta = $pedido->insertar($FcOrdenPedido,$IdTercero);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
       break;
       
       case 'guardardet':
        $filas = json_decode($_POST['valores'], true); // json_decode DECODIFICAR STRING
        // print_r($filas); die();
        $rspta =  $pedido->insertardet($filas); 
        echo  $rspta ? "Pedido realizado" : "Intento fallido";
       break;

        case 'selectTercero':
          $rspta = $pedido->selectTercero();
          echo '<option value="" selected disabled> Seleccione el proveedor</option>';
          while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
            echo '<option value="' . $reg['IdTercero'] . '">' . $reg['IdTercero'] . ' - ' . $reg['NmRazonSocial'] . '</option>';
          }
        break;
        
        case 'idlast':
          $rspta = $pedido->idlast();
          echo  $rspta;
        break;
        
        case'salir':
          session_destroy();
          header("location:../vista/log.php");
        break;
    }
    
    ?>