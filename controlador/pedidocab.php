    <?php
    require_once "../modelo/Pedidocab.php";
    // print_r("holaaa");
    $pedidocab = new Pedidocab();

    $FcOrdenPedido="";
    $IdTercero="";
  
    (isset($_POST["FcOrdenPedido"])) ? $FcOrdenPedido = $_POST["FcOrdenPedido"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
    (isset($FcOrdenPedido)) ? $FcOrdenPedido = date("Y-m-d H:m:s", strtotime($FcOrdenPedido)) : "";
    (isset($_POST["IdTercero"])) ? $IdTercero = $_POST["IdTercero"] : ""; // ? LimpiarCadena($_POST["Direccion"]) : "";
    
    session_start();
    switch ($_GET["op"]) {
        
       case 'guardar':
        $rspta = $pedidocab->insertar($FcOrdenPedido,$IdTercero);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
       break;

        case 'selectTercero':
          $rspta = $pedidocab->selectTercero();
          echo '<option value="" selected disabled> Seleccione el proveedor</option>';
          while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
            echo '<option value="' . $reg['IdTercero'] . '">' . $reg['IdTercero'] . ' - ' . $reg['NmRazonSocial'] . '</option>';
          }
        break;
        
        case 'idlast':
          $rspta = $pedidocab->idlast();
          echo  $rspta;
        break;
        
        case'salir':
          session_destroy();
          header("location:../vista/log.php");
        break;
    }
    
    ?>