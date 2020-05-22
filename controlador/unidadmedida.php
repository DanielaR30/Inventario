<?php
    require_once "../modelo/Unidadmedida.php";
    // print_r("holaaa");
    $unidadmedida = new UnidadMedida();

    $IdUnidadMedida = "";
    $CdUnidadMedida = "";
    $NmUnidadMedida = "";
   
    (isset($_POST["IdUnidadMedida"])) ? $IdUnidadMedida = $_POST["IdUnidadMedida"] : ""; // ? LimpiarCadena($_POST["idOficina"]) : "";
    (isset($_POST["CdUnidadMedida"])) ? $CdUnidadMedida = $_POST["CdUnidadMedida"] : ""; // ? LimpiarCadena($_POST["idOficina"]) : "";
    (isset($_POST["NmUnidadMedida"])) ? $NmUnidadMedida = $_POST["NmUnidadMedida"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
    
    session_start();
    switch ($_GET["op"]) {   
    
      case 'guardar':
        $rspta = $unidadmedida->insertar($CdUnidadMedida, $NmUnidadMedida);        
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
      break;

      case 'editar':
        $rspta = $unidadmedida->editar($IdUnidadMedida, $CdUnidadMedida, $NmUnidadMedida);
        echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";
      break;

      case 'mostrar':
        $rspta = $unidadmedida->mostrar($IdUnidadMedida);
        // print_r($rspta); die();
        //Codificar el resultado utilizando json_encode(array)
        echo json_encode($rspta);
      break;

      case 'eliminar':
        $rspta = $unidadmedida->eliminar($IdUnidadMedida);
        echo  $rspta ? "Registro Eliminado" : "Registro no se pudo eliminar";
      break;

      case 'listar':
        // print_r('to list.... data'); die();
        $rspta = $unidadmedida->listar();
        $data = array();
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_NUMERIC)) {
          //echo $row[0] . ", " . $row[1] . "<br />"; 
          $data[] = array(
            
            "0" =>'<button type="button" class="btn btn-warning btn-sm" onclick="mostrar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Actualizar"><i class="fas fa-pen"></i></button> &nbsp;'. // lleva a la func mostrar
              '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fas fa-trash"></i></button>',
            "1" => $reg[0],
            "2" => $reg[1],           
            "3" => $reg[2]           
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