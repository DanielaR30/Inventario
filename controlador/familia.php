<?php
    require_once "../modelo/Familia.php";
    // print_r("holaaa");
    $familia = new Familia();

    $IdFamilia = "";
    $NmFamilia = "";
    $IdSegmento = "";
     
    (isset($_POST["IdFamilia"])) ? $IdFamilia = $_POST["IdFamilia"] : ""; // ? LimpiarCadena($_POST["IdFamilia"]) : "";
    (isset($_POST["NmFamilia"])) ? $NmFamilia = $_POST["NmFamilia"] : ""; // ? LimpiarCadena($_POST["NmFamilia"]) : "";
    (isset($_POST["IdSegmento"])) ? $IdSegmento = $_POST["IdSegmento"] : $IdSegmento = "0";   // ? LimpiarCadena($_POST["IdSegmento"]) : "";
   
   
    session_start();
    switch ($_GET["op"]) {
    
      case 'validarid': 
        $rspta = $familia->validaid($IdFamilia);               
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
        $rspta = $familia->validaid($IdFamilia);  
        while ($row = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          if (isset($row['IdFamilia'])) {
          // echo "dato existente";
            echo json_encode($row);
          }   
        }       
      break;
    
      case 'guardar':
        $rspta = $familia->insertar($IdFamilia, $NmFamilia, $IdSegmento);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
        break;

      case 'editar':
        $rspta = $familia->editar($IdFamilia, $NmFamilia, $IdSegmento);
        echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";
        break;

      case 'mostrar':
        $rspta = $familia->mostrar($IdFamilia);
        echo json_encode($rspta);
        break;

      case 'eliminar':
        $rspta = $familia->eliminar($IdFamilia);
        echo  $rspta ? "Registro Eliminado" : "Registro no se pudo eliminar";
        break;        

      case 'listar':
        //  print_r('to list.... data');
        $rspta = $familia->listar();
        $data = array();
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_NUMERIC)) {
          //echo $row[0] . ", " . $row[1] . "<br />"; 
          $data[] = array(  
            "0" => '<button type="button" class="btn btn-warning btn-sm"  onclick="mostrar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Actualizar"><i class="fas fa-pen"></i> </button> &nbsp;&nbsp;' .
            '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fas fa-trash"></i> </button>',                   
          
            "1" => $reg[0],
            "2" => $reg[1],
            "3" => $reg[2],
           );
        }
        
        $results = array(
          "sEcho" => 1,
          "iTotalRecords" => count($data),
          "iTotalDisplayRecord" => count($data),
          "aaData" => $data
        );
        echo json_encode($results);
        break;

        case 'selectSegmento':
        $rspta = $familia->selectSegmento();
        echo '<option value="" selected disabled> Seleccione el segmento </option>';
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          echo '<option value="' . $reg['IdSegmento'] . '">' . $reg['NmSegmento'] . '</option>';
        }
        break;
          
        case'salir':
          session_destroy();
          header("location:../vista/login.html");
        break;
    }
    ?>