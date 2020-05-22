<?php
    require_once "../modelo/Area.php";
    // print_r("holaaa");
    $area = new Area();

    $IdArea = "";
    $NmArea = "";
   
    (isset($_POST["IdArea"])) ? $IdArea = $_POST["IdArea"] : ""; // ? LimpiarCadena($_POST["idOficina"]) : "";
    (isset($_POST["NmArea"])) ? $NmArea = $_POST["NmArea"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
    
    session_start();
    switch ($_GET["op"]) {     
    
      case 'guardar':
        $rspta = $area->insertar($NmArea);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
      break;

      case 'editar':
        $rspta = $area->editar($IdArea, $NmArea);
        echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";
      break;

      case 'mostrar':
        $rspta = $area->mostrar($IdArea);
        //Codificar el resultado utilizando json_encode(array)
        echo json_encode($rspta);
      break;

      case 'eliminar':
        $rspta = $area->eliminar($IdArea);
        echo  $rspta ? "Registro Eliminado" : "Registro no se pudo eliminar";
      break;

      case 'listar':
        // print_r('to list.... data'); die();
        $rspta = $area->listar();
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