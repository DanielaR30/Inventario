<?php
    require_once "../modelo/Bodega.php";
    $bodega = new Bodega();
    $IdBodega = "";
    $NmBodega = "";
    $FlActiva = "";
  
    (isset($_POST["IdBodega"])) ? $IdBodega = $_POST["IdBodega"] : "";
    (isset($_POST["NmBodega"])) ? $NmBodega = $_POST["NmBodega"] : ""; 
    (isset($_POST["FlActiva"])) ? $FlActiva = $_POST["FlActiva"] : ""; 
    
  
    session_start();
    switch ($_GET["op"]) { 
    
      case 'validarid': 
        $rspta = $bodega->validaid($IdBodega);               
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
        $rspta = $bodega->validaid($IdBodega);  
        while ($row = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          if (isset($row['IdBodega'])) {
          // echo "dato existente";
            echo json_encode($row);
          }   
        }       
      break;  
    
      case 'guardar':
        $rspta = $bodega->insertar($NmBodega, $FlActiva);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
      break;

      case 'editar':
        $rspta = $bodega->editar($IdBodega, $NmBodega, $FlActiva);
        echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";
      break;

      case 'mostrar':
        $rspta = $bodega->mostrar($IdBodega);
        echo json_encode($rspta);
      break;

      case 'eliminar':
        $rspta = $bodega->eliminar($IdBodega);
        echo  $rspta ? "Registro Eliminado" : "Registro no se pudo eliminar";
      break;


  case 'listar':
    $rspta = $bodega->listar();
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