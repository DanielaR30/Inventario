    <?php
    require_once "../modelo/Oficina.php";
    // print_r("holaaa");
    $oficina = new Oficina();

    $idOficina = "";
    $NmOficina = "";
    $Direccion = "";
    $Telefono = "";
    $IdCiudad = "";
    $FlPuntodeAtencion = "";
    $IdZona = "";
    $FcApertura = "";
    $FlSedePropia = "";
    $NuEmpleados = "";
    $NuHabitantes = "";
  
    (isset($_POST["idOficina"])) ? $idOficina = $_POST["idOficina"] : ""; // ? LimpiarCadena($_POST["idOficina"]) : "";
    (isset($_POST["NmOficina"])) ? $NmOficina = $_POST["NmOficina"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
    (isset($_POST["Direccion"])) ? $Direccion = $_POST["Direccion"] : ""; // ? LimpiarCadena($_POST["Direccion"]) : "";
    (isset($_POST["Telefono"])) ? $Telefono = $_POST["Telefono"] : "";  // ? LimpiarCadena($_POST["Telefono"]) : "";
    (isset($_POST["IdCiudad"])) ? $IdCiudad = $_POST["IdCiudad"] : $IdCiudad = "0";   // ? LimpiarCadena($_POST["IdCiudad"]) : "";
    (isset($_POST["FlPuntodeAtencion"])) ? $FlPuntodeAtencion =  $_POST["FlPuntodeAtencion"] : ""; // ? LimpiarCadena($_POST["FlPuntodeAtencion"]) : "";
    (isset($_POST["IdZona"])) ? $IdZona = $_POST["IdZona"] : $IdZona ="0"; // ? LimpiarCadena($_POST["IdZona"]) : "";
    (isset($_POST["FcApertura"])) ? $FcApertura = $_POST["FcApertura"] : ""; // ? LimpiarCadena($_POST["FcApertura"]) : "";
    
    (isset($FcApertura)) ? $FcApertura = date("Y-m-d H:m:s", strtotime($FcApertura)) : "";
    
    (isset($_POST["FlSedePropia"])) ? $FlSedePropia = $_POST["FlSedePropia"] : ""; // ? LimpiarCadena($_POST["FlSedePropia"]) : "";
    (isset($_POST["NuEmpleados"])) ? $NuEmpleados = $_POST["NuEmpleados"] : ""; // ? LimpiarCadena($_POST["NuEmpleados"]) : "";
    (isset($_POST["NuHabitantes"])) ? $NuHabitantes = $_POST["NuHabitantes"] : ""; // ? LimpiarCadena($_POST["NuHabitantes"]) : "";
  

    // $idOficina = (isset($_POST["idOficina"])) ?  $_POST["idOficina"] : ""; 

    // $Nombre="";  if(isset($_POST["Nombre"])){$Nombre=$_POST["Nombre"];}
    // print_r($idOficina); die();
    // 2019-11-23T03:04  !=  1999-02-15 00:00:00   1970-01-01 01:01:00 aca esta el  ejmplo
    // el isset retorna 1 si es verdadero y 0 si es falso
   
    session_start();
    switch ($_GET["op"]) {
    
      case 'guardar':
        $rspta = $oficina->insertar($idOficina, $NmOficina, $Direccion, $Telefono, $IdCiudad, $FlPuntodeAtencion, $IdZona, $FcApertura, $FlSedePropia, $NuEmpleados, $NuHabitantes);
        echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
        break;

      case 'editar':
        $rspta = $oficina->editar($idOficina, $NmOficina, $Direccion, $Telefono, $IdCiudad, $FlPuntodeAtencion, $IdZona, $FcApertura, $FlSedePropia, $NuEmpleados, $NuHabitantes);
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
            "0" => '<button type="button" class="btn btn-warning btn-sm" onclick="mostrar(' . $reg[0] . ')"><i class="fas fa-pen"></i></button> &nbsp;' .//eses lo lleva a la func mostrar
              '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' . $reg[0] . ')"><i class="fas fa-trash"></i></button>',
            // "0" => $reg[0],
            "1" => $reg[1],
            "2" => $reg[2],
            "3" => $reg[3],
            "4" => $reg[4],
            "5" => $reg[5],
            "6" => $reg[6],
            "7" => 
            
            //(lo q esta entreparentesis dice si el valor q esta $reg con posicion7 es diferente de vacio ) ? entpnces formateelo con y = año, mes,dia ,horas ..
            // H:i:s (:) los dos puntos significa sino sea igual a vacio ( esto es un if corto tiene un nombre)     
            "8" => $reg[8],
            "9" => $reg[9],
            "10" => $reg[10],

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

        case 'selectCiudad':
        $IdZona=$_POST['IdZona'];
        $rspta = $oficina->selectCiudad($IdZona);
        echo '<option value="" selected disabled> Seleccione la ciudad </option>';
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          echo '<option value="' . $reg['IdCiudad'] . '">' . $reg['NmCiudad'] . '</option>';
        }
        break;

      case 'selectZona':
        $rspta = $oficina->selectZona();
        echo '<option value="" selected disabled> Seleccione la zona </option>';
        while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          echo '<option value="' . $reg['IdZona'] . '">' . $reg['NmZona'] . '</option>';
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