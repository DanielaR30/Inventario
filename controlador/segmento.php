<?php
    require_once "../modelo/Segmento.php";
    // print_r("holaaa");
    $segmento = new Segmento();

    $IdSegmento = "";
    $NmSegmento = "";
   
    (isset($_POST["IdSegmento"])) ? $IdSegmento = $_POST["IdSegmento"] : ""; // ? LimpiarCadena($_POST["idOficina"]) : "";
    (isset($_POST["NmSegmento"])) ? $NmSegmento = $_POST["NmSegmento"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
    
    session_start();
    switch ($_GET["op"]) {
    
      case 'validarid': 
        $rspta = $segmento->validaid($IdSegmento);               
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
        $rspta = $segmento->validaid($IdSegmento);  
        while ($row = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          if (isset($row['IdSegmento'])) {
          // echo "dato existente";
            echo json_encode($row);
          }   
        }       
      break;      
    
      case 'guardar':
        $rspta = $segmento->insertar($IdSegmento, $NmSegmento);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
      break;

      case 'editar':
        $rspta = $segmento->editar($IdSegmento, $NmSegmento);
        echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";
      break;

      case 'mostrar':
        $rspta = $segmento->mostrar($IdSegmento);
        //Codificar el resultado utilizando json_encode(array)
        echo json_encode($rspta);
      break;

      case 'eliminar':
        $rspta = $segmento->eliminar($IdSegmento);
        echo  $rspta ? "Registro Eliminado" : "Registro no se pudo eliminar";
      break;

      case 'listar':
        // print_r('to list.... data'); die();
        $rspta = $segmento->listar();
        $data = array();
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_NUMERIC)) {
          //echo $row[0] . ", " . $row[1] . "<br />"; 
          $data[] = array(
            
            "0" =>'<button type="button" class="btn btn-warning btn-sm" onclick="mostrar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Actualizar"><i class="fas fa-pen"></i></button> &nbsp;'. // lleva a la func mostrar
              '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fas fa-trash"></i></button>',
            "1" => $reg[0],
            "2" => $reg[1]
           
          );
        }
          $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecord" => count($data),
            "aaData" => $data
          );
          
          // print_r ($data); 
        echo json_encode($results);
      break;
 
        // case'salir':
        //   session_destroy();
        //   header("location:../vista/login.html");
        // break;
    }
    ?>