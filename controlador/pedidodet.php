    <?php
    require_once "../modelo/Tercero.php";
    // print_r("holaaa");
    $tercero = new Tercero();

    $IdTercero = "";
    $DigVerificacion = "";
    $NmRazonSocial = "";
    $Direccion = "";
    $TelefonoFijo = "";
    $TelefonoMovil = "";
    $CorreoElectronico = "";
    $IdTipoDocumento = "";
    $IdCiudad = "";
    $IdGenero = "";
    $FlActivo = "";
  
    (isset($_POST["IdTercero"])) ? $IdTercero = $_POST["IdTercero"] : ""; // ? LimpiarCadena($_POST["idOficina"]) : "";
    (isset($_POST["DigVerificacion"])) ? $DigVerificacion = $_POST["DigVerificacion"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
    (isset($_POST["NmRazonSocial"])) ? $NmRazonSocial = $_POST["NmRazonSocial"] : ""; // ? LimpiarCadena($_POST["Direccion"]) : "";
    (isset($_POST["Direccion"])) ? $Direccion = $_POST["Direccion"] : "";  // ? LimpiarCadena($_POST["Telefono"]) : "";
    (isset($_POST["TelefonoFijo"])) ? $TelefonoFijo = $_POST["TelefonoFijo"] : "";   // ? LimpiarCadena($_POST["IdCiudad"]) : "";
    (isset($_POST["TelefonoMovil"])) ? $TelefonoMovil =  $_POST["TelefonoMovil"] : ""; // ? LimpiarCadena($_POST["FlPuntodeAtencion"]) : "";
    (isset($_POST["CorreoElectronico"])) ? $CorreoElectronico = $_POST["CorreoElectronico"] : ""; // ? LimpiarCadena($_POST["IdZona"]) : "";
    (isset($_POST["IdTipoDocumento"])) ? $IdTipoDocumento = $_POST["IdTipoDocumento"] : ""; // ? LimpiarCadena($_POST["FcApertura"]) : "";
    (isset($_POST["IdCiudad"])) ? $IdCiudad = $_POST["IdCiudad"] : ""; // ? LimpiarCadena($_POST["FlSedePropia"]) : "";
    (isset($_POST["IdGenero"])) ? $IdGenero = $_POST["IdGenero"] : ""; // ? LimpiarCadena($_POST["FlSedePropia"]) : "";
    (isset($_POST["FlActivo"])) ? $FlActivo = $_POST["FlActivo"] : ""; // ? LimpiarCadena($_POST["NuEmpleados"]) : "";
  

    session_start();
    switch ($_GET["op"]) {
        
      case 'validarid': 
        $rspta = $tercero->validaid($IdTercero);               
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
        $rspta = $tercero->validaid($IdTercero);  
        while ($row = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          if (isset($row['IdTercero'])) {
          // echo "dato existente";
            echo json_encode($row);
          }   
        }       
      break;
    
      case 'guardar':
        $rspta = $tercero->insertar($IdTercero,$DigVerificacion,$NmRazonSocial,$Direccion,$TelefonoFijo,$TelefonoMovil,$CorreoElectronico,$IdTipoDocumento,$IdCiudad,$IdGenero,$FlActivo);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
        break;

      case 'editar':
        $rspta = $tercero->editar($IdTercero,$DigVerificacion,$NmRazonSocial,$Direccion,$TelefonoFijo,$TelefonoMovil,$CorreoElectronico,$IdTipoDocumento,$IdCiudad,$IdGenero,$FlActivo);
        echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";
        break;

      case 'mostrar':
        $rspta = $tercero->mostrar($IdTercero);
        //Codificar el resultado utilizando json_encode(array)
        echo json_encode($rspta);
        break;

      case 'eliminar':
        $rspta = $tercero->eliminar($IdTercero);
        echo  $rspta ? "Registro Eliminado" : "Registro no se pudo eliminar";
        break;

      case 'listar':
        //  print_r('to list.... data');
        $rspta = $tercero->listar();
        $data = array();
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_NUMERIC)) {
          $data[] = array(
           
            "0" => '<button type="button" class="btn btn-warning btn-sm" onclick="mostrar(' . $reg[0] . ')"  data-toggle="tooltip" data-placement="right" title="Actualizar"><i class="fas fa-pen"></i></button> &nbsp;'.
              '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fas fa-trash"></i></button>',
            "1" => $reg[0],
            "2" => $reg[1],
            "3" => $reg[2],
            "4" => $reg[3],
            "5" => $reg[4],
            "6" => $reg[5],
            "7" => $reg[6],
            "8" => $reg[7],
            "9" => $reg[8],
            "10" => $reg[9],
            "11" => $reg[10],
          );
        }
     
        $results = array(
          "sEcho" => 1,
          "iTotalRecords" => count($data),
          "iTotalDisplayRecord" => count($data),
          "aaData" => $data
        );
        // print_r($data); die();
        echo json_encode($results);
        break;

        case 'selectDocumento':
          $rspta = $tercero->selectDocumento();
          echo '<option value="" selected disabled> Seleccione el tipo de documento </option>';
          while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
            echo '<option value="' . $reg['IdTipoDocumento'] . '">' . $reg['NmTipoDocumento'] . '</option>';
          }
        break;
        
        case 'selectCiudad':
          $rspta = $tercero->selectCiudad();
          echo '<option value="" selected disabled> Seleccione la ciudad </option>';
          while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
            echo '<option value="' . $reg['IdCiudad'] . '">' . $reg['NmCiudad'] . '</option>';
          }
        break;
          
          case 'selectGenero':
            $rspta = $tercero->selectGenero();
            echo '<option value="" selected disabled> Seleccione el género </option>';
            while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
              echo '<option value="' . $reg['IdGenero'] . '">' . $reg['NmGenero'] . '</option>';
            }
          break;

        case'salir':
          session_destroy();
          header("location:../vista/log.php");
        break;
    }
    ?>