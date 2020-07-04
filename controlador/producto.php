<?php
require_once "../modelo/Producto.php";
$producto = new Producto();

$IdProducto="";
$IdClase="";
$NmProducto="";
$Descripcion="";
$CodigoBarras="";
$ImagenProducto="";
$IdMarca="";
$IdLinea="";
$IdUnidadMedida="";
$IdLocalizacion="";
$NuStockMin="";
$NuStockMax="";
$GravadoIVA="";
$PorcentajeIVA="";

(isset($_POST["IdProducto"])) ? $IdProducto = $_POST["IdProducto"] : ""; // ? LimpiarCadena($_POST["idOficina"]) : "";
(isset($_POST["IdClase"])) ? $IdClase = $_POST["IdClase"] : ""; // ? LimpiarCadena($_POST["NmOficina"]) : "";
(isset($_POST["NmProducto"])) ? $NmProducto = $_POST["NmProducto"] : ""; // ? LimpiarCadena($_POST["Descripcion"]) : "";
(isset($_POST["Descripcion"])) ? $Descripcion = $_POST["Descripcion"] : "";  // ? LimpiarCadena($_POST["Telefono"]) : "";
(isset($_POST["CodigoBarras"])) ? $CodigoBarras = $_POST["CodigoBarras"] : "";   // ? LimpiarCadena($_POST["NuStockMin"]) : "";
(isset($_POST["ImagenProducto"])) ? $ImagenProducto = $_POST["ImagenProducto"] : "";   // ? LimpiarCadena($_POST["NuStockMin"]) : "";
(isset($_POST["IdMarca"])) ? $IdMarca =  $_POST["IdMarca"] : ""; // ? LimpiarCadena($_POST["FlPuntodeAtencion"]) : "";
(isset($_POST["IdLinea"])) ? $IdLinea =  $_POST["IdLinea"] : ""; // ? LimpiarCadena($_POST["FlPuntodeAtencion"]) : "";
(isset($_POST["IdUnidadMedida"])) ? $IdUnidadMedida =  $_POST["IdUnidadMedida"] : ""; // ? LimpiarCadena($_POST["FlPuntodeAtencion"]) : "";
(isset($_POST["IdLocalizacion"])) ? $IdLocalizacion =  $_POST["IdLocalizacion"] : ""; // ? LimpiarCadena($_POST["FlPuntodeAtencion"]) : "";
(isset($_POST["NuStockMin"])) ? $NuStockMin = $_POST["NuStockMin"] : ""; // ? LimpiarCadena($_POST["FlSedePropia"]) : "";
(isset($_POST["NuStockMax"])) ? $NuStockMax = $_POST["NuStockMax"] : ""; // ? LimpiarCadena($_POST["FlSedePropia"]) : "";
(isset($_POST["GravadoIVA"])) ? $GravadoIVA = $_POST["GravadoIVA"] : ""; // ? LimpiarCadena($_POST["FlSedePropia"]) : "";
(isset($_POST["PorcentajeIVA"])) ? $PorcentajeIVA = $_POST["PorcentajeIVA"] : ""; // ? LimpiarCadena($_POST["FlSedePropia"]) : "";

session_start();
switch ($_GET["op"]) {

//cuenta el nro de registros , si no hay reg devuelve null
case 'validarid':
  $rspta = $producto->validaid($IdProducto);
  if ($rspta) {
    $row = sqlsrv_has_rows($rspta);
      if ($row === true) {
        echo "Dato existente.";
      } else {
        echo "null";
      }
  }
break;

//muestra los campos según el id existente
case 'datosid':
  $rspta = $producto->validaid($IdProducto);
  while ($row = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
    if (isset($row['IdProducto'])) {
    // echo "dato existente";
      echo json_encode($row);
    }
  }
break;

//mostrar id producto autoincremental según: familia,segmento y clase
case 'mostrarid':
  $rspta = $producto->mostrarid($IdClase);
  echo $rspta;
break;

case 'guardar':

	if (!file_exists($_FILES['ImagenProducto']['tmp_name']) || !is_uploaded_file($_FILES['ImagenProducto']['tmp_name']))
		{
			$ImagenProducto=$_POST["imagenactual"];
		}
		else
		{
		//explode: obtiene la extensión del archivo
		$ext = explode(".", $_FILES["ImagenProducto"]["name"]);
		//Valida que el archivo cargado cumpla con las extencisones: jpg,jpeg,png
		if ($_FILES['ImagenProducto']['type'] == "image/jpg" || $_FILES['ImagenProducto']['type'] == "image/jpeg" || $_FILES['ImagenProducto']['type'] == "image/png" || $_FILES['ImagenProducto']['type'] == "application/pdf")
		{
			//microtime: renombra el archivo con un formato de tiempo para que no tener archivos repetidos
			$ImagenProducto = round(microtime(true)) . '.' . end($ext);
			//move_uploaded_file: copia el archivo de la ubicacion local y lo mueve a la carpeta del proyecto
			move_uploaded_file($_FILES["ImagenProducto"]["tmp_name"], "../public/img/" . $ImagenProducto);
		}
		}
		// if (empty($barcode)) {
	  //   	$barcode =  $_POST["barcode"]
    // } else {
    //   # code...
    // }

  $rspta = $producto->insertar($IdProducto, $IdClase, $NmProducto, $Descripcion, $CodigoBarras, $ImagenProducto,
  $IdMarca, $IdLinea, $IdUnidadMedida, $IdLocalizacion, $NuStockMin, $NuStockMax, $GravadoIVA, $PorcentajeIVA);
  echo  $rspta ? "Datos guardados" : "Los datos no se pudieron guardar";
  break;

case 'editar':

	if (!file_exists($_FILES['ImagenProducto']['tmp_name']) || !is_uploaded_file($_FILES['ImagenProducto']['tmp_name']))
		{
			$ImagenProducto=$_POST["imagenactual"];
		}
		else
		{
		//explode: obtiene la extensión del archivo
		$ext = explode(".", $_FILES["ImagenProducto"]["name"]);
		//Valida que el archivo cargado cumpla con las extencisones: jpg,jpeg,png
		if ($_FILES['ImagenProducto']['type'] == "image/jpg" || $_FILES['ImagenProducto']['type'] == "image/jpeg" || $_FILES['ImagenProducto']['type'] == "image/png" || $_FILES['ImagenProducto']['type'] == "application/pdf")
		{
			//microtime: renombra el archivo con un formato de tiempo para que no tener archivos repetidos
			$ImagenProducto = round(microtime(true)) . '.' . end($ext);
			//move_uploaded_file: copia el archivo de la ubicacion local y lo mueve a la carpeta del proyecto
			move_uploaded_file($_FILES["ImagenProducto"]["tmp_name"], "../public/img/" . $ImagenProducto);
		}
		}

  $rspta = $producto->editar($IdProducto, $IdClase, $NmProducto, $Descripcion, $CodigoBarras, $ImagenProducto,
  $IdMarca, $IdLinea, $IdUnidadMedida, $IdLocalizacion, $NuStockMin, $NuStockMax, $GravadoIVA, $PorcentajeIVA);
  echo $rspta ? "Datos actualizados" : "Los Datos no se pudieron actualizar";

break;

case 'mostrar': 
  $rspta = $producto->mostrar($IdProducto);
  //Codificar el resultado utilizando json_encode(array)
  echo json_encode($rspta);
break;

case 'mostrarcar': 
  $rspta = $producto->mostrar($IdProducto);
  
  $IdProducto =  $rspta['IdProducto'];
  $ImagenProducto =  $rspta['ImagenProducto'];
  $NmProducto =  $rspta['NmProducto'];
  
  $results[] = array (
    "IdProducto" =>$IdProducto,
    "ImagenProducto" =>$ImagenProducto, 
    "NmProducto" => $NmProducto); 
  
  // print_r(json_encode($results));
    echo json_encode($results);
    
break;

case 'eliminar':
  $rspta = $producto->eliminar($IdProducto);
  echo  $rspta ? "Registro Eliminado" : "Registro no se pudo eliminar";
break;

case 'listar':
  $rspta = $producto->listar();
  $data = array();
  while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_NUMERIC)) {

    $data[] = array(
      "0" => '<button type="button" class="btn btn-warning btn-sm" onclick="mostrar(' . $reg[0] . ')"  data-toggle="tooltip" data-placement="bottom" title="Actualizar"><i class="fas fa-pen"></i></button> &nbsp;'.
        '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' . $reg[0] . ')" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fas fa-trash"></i></button>',
      "1" => $reg[0],
      "2" => $reg[1],
      "3" => $reg[2],
      "4" => $reg[3],
      "5" => $reg[4],
      "6" => "<img src='../public/img/".$reg[5]."' height='80px' width='80px'>",
      "7" => $reg[6],
      "8" => $reg[7],
      "9" => $reg[8],
      "10" => $reg[9],
      "11" => $reg[10],
      "12" => $reg[11],
      "13" => $reg[12],
      "14" => $reg[13],
      "15" => $reg[14],
      "16" => $reg[15],
      "17" => $reg[16],
    );
  }

  $results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecord" => count($data),
    "aaData" => $data
  );
  // $r = json_encode($results);
  // print_r($r); die();
  echo json_encode($results);
  break;
  
  case 'filtropro':
    $rspta = $producto->filtropro($IdClase);
    while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
  
      $IdProducto =  $reg['IdProducto'];
      $ImagenProducto =  $reg['ImagenProducto'];
      $NmProducto =  $reg['NmProducto'];
      
      $results[] = array(
      "IdProducto" =>$IdProducto,
      "ImagenProducto" =>$ImagenProducto, 
      "NmProducto" =>$NmProducto); 
      }
      echo json_encode($results);
  break;
  
  
  case 'selectClasepro':
    $rspta = $producto->selectClasepro();
    echo '<option value="" selected disabled> Seleccione la clase de producto</option>';
    while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
      echo '<option value="' . $reg['IdClase'] . '">' . $reg['NmClase'] . '</option>';
    }
  break;
  
  // case 'filtronmpro':
  //   $rspta = $producto->filtronmpro($NmProducto);
  //   while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
  //   // print_r($reg['NmProducto']); die();
  //     echo '<option>' . $reg['NmProducto'] . '</option>';
  //   }
  // break;
   
  case 'card':
    $rspta = $producto->listar();
    while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
  
    $IdProducto =  $reg['IdProducto'];
    $ImagenProducto =  $reg['ImagenProducto'];
    $NmProducto =  $reg['NmProducto'];
    
    $results[] = array(
    "IdProducto" =>$IdProducto,
    "ImagenProducto" =>$ImagenProducto, 
    "NmProducto" =>$NmProducto); 
    }
    echo json_encode($results);
  break;
    
    case 'selectClasepro':
      $rspta = $producto->selectClasepro();
      echo '<option value="" selected disabled> Seleccione la clase de producto</option>';
      while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
        echo '<option value="' . $reg['IdClase'] . '">' . $reg['NmClase'] . '</option>';
      }
    break;
  
  case 'selectClase':
    $rspta = $producto->selectClase();
    echo '<option value="" selected disabled> Seleccione la clase </option>';
    while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
      echo '<option value="' . $reg['IdClase'] . '">' . $reg['NmClase'] . '</option>';
    }
  break;

  case 'selectMarca':
    $rspta = $producto->selectMarca();
    echo '<option value="" selected disabled> Seleccione la marca </option>';
    while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
      echo '<option value="' . $reg['IdMarca'] . '">' . $reg['NmMarca'] . '</option>';
    }
  break;
 
  case 'selectLinea':
    $rspta = $producto->selectLinea();
    echo '<option value="" selected disabled> Seleccione la línea </option>';
    while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
      echo '<option value="' . $reg['IdLinea'] . '">' . $reg['NmLinea'] . '</option>';
    }
  break;

  case 'selectUnidad':
    $rspta = $producto->selectUnidad();
    echo '<option value="" selected disabled> Seleccione la Unidad de medida </option>';
    while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
      echo '<option value="' . $reg['IdUnidadMedida'] . '">' . $reg['NmUnidadMedida'] . '</option>';
    }
  break;

  case 'selectBodega':
    $rspta = $producto->selectBodega();
    echo '<option value="" selected disabled> Seleccione la Localización </option>';
    while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
      echo '<option value="' . $reg['IdBodega'] . '">' . $reg['NmBodega'] . '</option>';
    }
  break;

    case 'selectEstado':
      $rspta = $producto->selectEstado();
      echo '<option value="" selected disabled> Seleccione el estado </option>';
      while ($reg = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
        echo '<option value="' . $reg['IdEstadoProducto'] . '">' . $reg['NmEstadoProducto'] . '</option>';
      }
    break;

  case'salir':
    session_destroy();
    header("location:../vista/log.php");
  break;
}

?>