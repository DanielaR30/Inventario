<?php
    require_once "../modelo/Tipotransaccion.php";
    $tipotransaccion = new Tipotransaccion();
    
    $IdTipoTransaccion = "";
    $NmTipoTransaccion = "";
    $CdNaturaleza = "";
  
    (isset($_POST["IdTipoTransaccion"])) ? $IdTipoTransaccion = $_POST["IdTipoTransaccion"] : "";
    (isset($_POST["NmTipoTransaccion"])) ? $NmTipoTransaccion = $_POST["NmTipoTransaccion"] : ""; 
    (isset($_POST["CdNaturaleza"])) ? $CdNaturaleza = $_POST["CdNaturaleza"] : ""; 
    
  
    session_start();
    switch ($_GET["op"]) { 
    
      case 'validarid': 
        $rspta = $tipotransaccion->validaid($IdTipoTransaccion);               
        if ($rspta) {
          $row = sqlsrv_has_rows( $rspta );
            if ($row === true) {
              echo "Dato existente.";
            } else {
              echo "null";
            }          
        }              
      break;
      
      case 'datosid': 
        $rspta = $tipotransaccion->validaid($IdTipoTransaccion);  
        while ($row = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          if (isset($row['IdTipoTransaccion'])) {
          // echo "dato existente";
            echo json_encode($row);
          }   
        }       
      break;  
    
      case 'guardar':
        $rspta = $tipotransaccion->insertar($NmTipoTransaccion, $CdNaturaleza);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
      break;

      case 'editar':
        $rspta = $tipotransaccion->editar($IdTipoTransaccion, $NmTipoTransaccion, $CdNaturaleza);
        echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";
      break;

      case 'mostrar':
        $rspta = $tipotransaccion->mostrar($IdTipoTransaccion);
        echo json_encode($rspta);
      break;

      case 'eliminar':
        $rspta = $tipotransaccion->eliminar($IdTipoTransaccion);
        echo  $rspta ? "Registro Eliminado" : "Registro no se pudo eliminar";
      break;


  case 'listar':
    $rspta = $tipotransaccion->listar();
    $data = array();
    while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_NUMERIC)) {
      $data[] = array(            
          "0" =>'<button type="button" class="btn btn-warning btn-sm" onclick="mostrar(' . $reg[0] . ')"><i class="fas fa-pen"></i></button> &nbsp;'.  //lleva a la func mostrar
                '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' . $reg[0] . ')"><i class="fas fa-trash"></i></button>',
          
          "1" => $reg[0],
          "2" => $reg[1],
          "3" => $reg[2],     
           );
    }
      $results = array(
        "sEcho" => 1, //Mostrar desde la fila 1
        "iTotalRecords" => count($data), //Total registros de la tabla
        "iTotalDisplayRecord" => count($data), //Total registros de a visualizar en pantalla
        "aaData" => $data //En este indice del array llamado "aaData" se envia los datos del array $data
      );
    echo json_encode($results);
  break;
    }
    ?>