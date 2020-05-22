    <?php
    require_once "../modelo/Oficina.php";
    // print_r("holaaa");
    $oficina = new Oficina();

    $idOficina = "";
    $NmOficina = "";
    $Direccion = "";
    $Telefono = "";
    $IdCiudad = "";
   
  
    (isset($_POST["idOficina"])) ? $idOficina = $_POST["idOficina"] : ""; // ? LimpiarCadena($_POST["idOficina"]) : "";
    (isset($_POST["NmOficina"])) ? $NmOficina = $_POST["NmOficina"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
    (isset($_POST["Direccion"])) ? $Direccion = $_POST["Direccion"] : ""; // ? LimpiarCadena($_POST["Direccion"]) : "";
    (isset($_POST["Telefono"])) ? $Telefono = $_POST["Telefono"] : "";  // ? LimpiarCadena($_POST["Telefono"]) : "";
    (isset($_POST["IdCiudad"])) ? $IdCiudad = $_POST["IdCiudad"] : $IdCiudad = "0";   // ? LimpiarCadena($_POST["IdCiudad"]) : "";
   
   
    session_start();
    switch ($_GET["op"]) {
    
      case 'validarid': 
        $rspta = $oficina->validaid($idOficina);               
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
        $rspta = $oficina->validaid($idOficina);  
        while ($row = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          if (isset($row['IdOficina'])) {
          // echo "dato existente";
            echo json_encode($row);
          }   
        }       
      break;
    
      case 'guardar':
        $rspta = $oficina->insertar($idOficina, $NmOficina, $Direccion, $Telefono, $IdCiudad);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
        break;

      case 'editar':
        $rspta = $oficina->editar($idOficina, $NmOficina, $Direccion, $Telefono, $IdCiudad);
        echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";
        break;

      case 'mostrar':
        $rspta = $oficina->mostrar($idOficina);
        //Codificar el resultado utilizando json_encode(array)
        echo json_encode($rspta);
        break;

      case 'eliminar':
        $rspta = $oficina->eliminar($idOficina);
        echo  $rspta ? "Registro Eliminado" : "Registro no se pudo eliminar";
        break;

        // case 'borrar': 
        // $rspta=$alumno->borrar($idalumno);
        // echo  $rspta ? "Registros Eliminados" : "Los Registros no se pudieron eliminar";
        // break;

        //var_dump($stmt); die();
        // while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)){
        //  echo $row[0].", ".$row[1]."<br />";
        // }

      case 'listar':
        //  print_r('to list.... data');
        $rspta = $oficina->listar();
        $data = array();
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_NUMERIC)) {
          //echo $row[0] . ", " . $row[1] . "<br />"; 
          $data[] = array(
            // "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->IdEmpleado.')"><i class="fas fa-edit"></i></button>'.
            // ' <button class="btn btn-danger" onclick="desactivar('.$reg->IdEmpleado.')"><i class="fa fa-close"></i></button>':
            // '<button class="btn btn-warning" onclick="mostrar('.$reg->IdEmpleado.')"><i class="fas fa-edit"></i></i></button>'.
            // ' <button class="btn btn-primary" onclick="activar('.$reg->IdEmpleado.')"><i class="fa fa-check"></i></button>',
            "0" => '<button type="button" class="btn btn-warning btn-sm" onclick="mostrar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Actualizar"><i class="fas fa-pen"></i></button> &nbsp;' .//eses lo lleva a la func mostrar
              '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fas fa-trash"></i></button>',
            "1" => $reg[0],
            "2" => $reg[1],
            "3" => $reg[2],
            "4" => $reg[3],
            "5" => $reg[4],
        
          );
        }
           
            
        // print_r($rspta); 
        // print_r('to list.... data');
        // print_r($data); die();
        
        $results = array(
          "sEcho" => 1,
          "iTotalRecords" => count($data),
          "iTotalDisplayRecord" => count($data),
          "aaData" => $data
        );

        echo json_encode($results);
        break;

        case 'selectCiudad':
        $rspta = $oficina->selectCiudad();
        echo '<option value="" selected disabled> Seleccione la ciudad </option>';
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          echo '<option value="' . $reg['IdCiudad'] . '">' . $reg['NmCiudad'] . '</option>';
        }
        break;


      //   case 'validaracceso':
      // //  print_r('hola...'); die();
      //     $correo=$_POST["correo"];
      //     $clave=$_POST["clave"];
      //     $rspta= $oficina->validarusuario($correo,$clave);
      //     if($fila=sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC))
      //     {
      //       $_SESSION["nombre"]=$fila->nombre;
      //     }
      //     //devuelve los datos a la variable "data" de la funtion js
      //     echo json_encode($fila);
      //   break;
          
        case'salir':
          session_destroy();
          header("location:../vista/login.html");
        break;
    }
    ?>