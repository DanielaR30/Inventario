<?php
    require_once "../modelo/Clase.php";
    // print_r("holaaa");
    $clase = new Clase();

    $IdClase = "";
    $NmClase = "";
    $IDFamilia = "";
     
    (isset($_POST["IdClase"])) ? $IdClase = $_POST["IdClase"] : ""; // ? LimpiarCadena($_POST["IdClase"]) : "";
    (isset($_POST["NmClase"])) ? $NmClase = $_POST["NmClase"] : ""; // ? LimpiarCadena($_POST["NmClase"]) : "";
    (isset($_POST["IDFamilia"])) ? $IDFamilia = $_POST["IDFamilia"] : $IDFamilia = "0";   // ? LimpiarCadena($_POST["IDFamilia"]) : "";
   
   
    session_start();
    switch ($_GET["op"]) {
    
      case 'validarid': 
        $rspta = $clase->validaid($IdClase);               
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
        $rspta = $clase->validaid($IdClase);  
        while ($row = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          if (isset($row['IdClase'])) {
          // echo "dato existente";
            echo json_encode($row);
          }   
        }       
      break;
    
      case 'guardar':
        $rspta = $clase->insertar($IdClase, $NmClase, $IDFamilia);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
        break;

      case 'editar':
        $rspta = $clase->editar($IdClase, $NmClase, $IDFamilia);
        echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";
        break;

      case 'mostrar':
        $rspta = $clase->mostrar($IdClase);
        echo json_encode($rspta);
        break;

      case 'eliminar':
        $rspta = $clase->eliminar($IdClase);
        echo  $rspta ? "Registro Eliminado" : "Registro no se pudo eliminar";
        break;        

      case 'listar':
        //  print_r('to list.... data');
        $rspta = $clase->listar();
        $data = array();
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_NUMERIC)) {
          //echo $row[0] . ", " . $row[1] . "<br />"; 
          $data[] = array(           
            "0" => '<button type="button" class="btn btn-warning btn-sm" onclick="mostrar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Actualizar"><i class="fas fa-pen"></i></button> &nbsp;' .//eses lo lleva a la func mostrar
              '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fas fa-trash"></i></button>',
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

        case 'selectFamilia':
        $rspta = $clase->selectFamilia();
        echo '<option value="" selected disabled> Seleccione la familia </option>';
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          echo '<option value="' . $reg['IdFamilia'] . '">' . $reg['NmFamilia'] . '</option>';
        }
        break;
          
        case'salir':
          session_destroy();
          header("location:../vista/login.html");
        break;
    }
    ?>