<?php
    require_once "../modelo/Usuario.php";
    // print_r("holaaa");
    $usuario = new Usuario();

    $IdUsuario = "";
    $NmUsuario = "";
    $Clave = "";
    $TipoUsuario = "";
    $FlUsuarioActivo = "";
    $IdOficina = "";
    $IdCargo = "";  
  
    (isset($_POST["IdUsuario"])) ? $IdUsuario = $_POST["IdUsuario"] : ""; // ? LimpiarCadena($_POST["idOficina"]) : "";
    (isset($_POST["NmUsuario"])) ? $NmUsuario = $_POST["NmUsuario"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
    (isset($_POST["Clave"])) ? $Clave = $_POST["Clave"] : ""; 
    (isset($_POST["TipoUsuario"])) ? $TipoUsuario = $_POST["TipoUsuario"] : "";  
    (isset($_POST["FlUsuarioActivo"])) ? $FlUsuarioActivo = $_POST["FlUsuarioActivo"] : "";   
    (isset($_POST["IdOficina"])) ? $IdOficina =  $_POST["IdOficina"] : ""; 
    (isset($_POST["IdCargo"])) ? $IdCargo = $_POST["IdCargo"] : ""; 
    
    $hash=password_hash($Clave,PASSWORD_DEFAULT);   
   
    session_start();
    switch ($_GET["op"]) {  
    
      case 'validarid': 
        $rspta = $usuario->validaid($IdUsuario);               
        if ($rspta) {
          $row = sqlsrv_has_rows($rspta);
            if ($row === true) {
              echo "Dato existente.";
            } else {
              echo "null";
            }          
        }              
      break;
      
      case 'datosid': 
        $rspta = $usuario->validaid($IdUsuario);  
        while ($row = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          if (isset($row['IdUsuario'])) {
          // echo "dato existente";
            echo json_encode($row);
          }   
        }       
      break;
      
      case 'noreg': 
        $rspta = $usuario->noreg();  
        echo  $rspta;
      break;
      
      case 'guardar': 
        $rspta = $usuario->insertar($IdUsuario, $NmUsuario, $hash, $TipoUsuario, $FlUsuarioActivo, $IdOficina, $IdCargo);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
      break;
           
      case 'editar':
        $rspta = $usuario->editar($IdUsuario, $NmUsuario, $hash, $TipoUsuario, $FlUsuarioActivo, $IdOficina, $IdCargo);
        echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";
      break;

      case 'mostrar':
        $rspta = $usuario->mostrar($IdUsuario);
        //Codificar el resultado utilizando json_encode(array)
        echo json_encode($rspta);
      break;

      case 'eliminar':
        $rspta = $usuario->eliminar($IdUsuario);
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
        $rspta = $usuario->listar();
        $data = array();
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_NUMERIC)) {
          //echo $row[0] . ", " . $row[1] . "<br />"; 
          $data[] = array(
            "0" => '<button type="button" class="btn btn-warning btn-sm" onclick="mostrar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Actualizar"><i class="fas fa-pen"></i></button> &nbsp;' . //lleva a la func mostrar
              '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fas fa-trash"></i></button>',
            "1" => $reg[0],
            "2" => $reg[1],
            "3" => $reg[2],
            "4" => $reg[3],
            "5" => $reg[4],
            "6" => $reg[5],
            "7" => $reg[6],
          );
        }
        $results = array(
          "sEcho" => 1,
          "iTotalRecords" => count($data),
          "iTotalDisplayRecord" => count($data),
          "aaData" => $data
        );
        
        // $numR = count($data); 
        // for ($row = 1; $row <= $numR; $row++){
        //  $id=$numR[0][$row];  
        //  print_r($id); 
        // }               
        echo json_encode($results);
      break; 
                 
        case 'selectOficina':
          $rspta = $usuario->selectoficina();
          echo '<option value="" selected disabled> Seleccione la oficina del usuario</option>';
          while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
            echo '<option value="' . $reg['IdOficina'] . '">' . $reg['NmOficina'] . '</option>';
          }
        break;

        case 'selectCargo':
        //carga en la variable $rspta los registros devueltos al ejecutar la consulta del método "selectCargo"        
          $rspta = $usuario->selectcargo();
          echo '<option value="" selected disabled> Seleccione el cargo del usuario
          </option>';
        //carga cada fila del resultado del SELECT en la variable $reg
          while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
        //agregar valores a la lista despleglable, de acuerdo a los datos de cada fila del SELECT
            echo '<option value="'.$reg['IdCargo'].'">'.$reg['NmCargo'].'</option>';
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
    