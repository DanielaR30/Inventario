<?php
    require_once "../modelo/Linea.php";
    // print_r("holaaa");
    $linea = new Linea();

    $IdLinea = "";
    $NmLinea = "";
   
    (isset($_POST["IdLinea"])) ? $IdLinea = $_POST["IdLinea"] : ""; // ? LimpiarCadena($_POST["idOficina"]) : "";
    (isset($_POST["NmLinea"])) ? $NmLinea = $_POST["NmLinea"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
    
    session_start();
    switch ($_GET["op"]) {     
    
      case 'guardar':
        $rspta = $linea->insertar($NmLinea);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
      break;

      case 'editar':
        $rspta = $linea->editar($IdLinea, $NmLinea);
        echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";
      break;

      case 'mostrar':
        $rspta = $linea->mostrar($IdLinea);
        //Codificar el resultado utilizando json_encode(array)
        echo json_encode($rspta);
      break;

      case 'eliminar':
        $rspta = $linea->eliminar($IdLinea);
        echo  $rspta ? "Registro Eliminado" : "Registro no se pudo eliminar";
      break;

      case 'listar':
        // print_r('to list.... data'); die();
        $rspta = $linea->listar();
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