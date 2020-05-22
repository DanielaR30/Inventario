    <?php
    require_once "../modelo/Cargo.php";
    // print_r("holaaa");
    $cargo = new Cargo();

    $IdCargo = "";
    $NmCargo = "";
    $FlActivo = "";
  
  
    (isset($_POST["IdCargo"])) ? $IdCargo = $_POST["IdCargo"] : ""; // ? LimpiarCadena($_POST["idOficina"]) : "";
    (isset($_POST["NmCargo"])) ? $NmCargo = $_POST["NmCargo"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
    (isset($_POST["FlActivo"])) ? $FlActivo = $_POST["FlActivo"] : ""; // ? LimpiarCadena($_POST["Direccion"]) : "";
    
  
    
    session_start();
    switch ($_GET["op"]) {
    
      case 'guardar':
        $rspta = $cargo->insertar($NmCargo, $FlActivo);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
      break;

      case 'editar':
        $rspta = $cargo->editar($IdCargo, $NmCargo, $FlActivo);
        echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";
      break;

      case 'mostrar':
        $rspta = $cargo->mostrar($IdCargo);
        //Codificar el resultado utilizando json_encode(array)
        echo json_encode($rspta);
      break;

      case 'eliminar':
        $rspta = $cargo->eliminar($IdCargo);
        echo  $rspta ? "Registro Eliminado" : "Registro no se pudo eliminar";
      break;

      case 'listar':
        // print_r('to list.... data'); die();
        $rspta = $cargo->listar();
        $data = array();
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_NUMERIC)) {
          //echo $row[0] . ", " . $row[1] . "<br />"; 
          $data[] = array(
            
            "0" =>'<button type="button" class="btn btn-warning btn-sm" onclick="mostrar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Actualizar"><i class="fas fa-pen"></i></button> &nbsp;'. // lleva a la func mostrar
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
          
          // print_r ($data); 
        echo json_encode($results);
      break;
 
        // case'salir':
        //   session_destroy();
        //   header("location:../vista/login.html");
        // break;
    }
    ?>