  <?php 
  // require_once "global.php";
  // $conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME); 
  // mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');
  // if(mysqli_connect_errno()){
  //     printf("fallo la conexion a la base de datos :%s\n",mysqli_connect_errno()); 
  // exit();
  // }
  // if(!function_exists('ejecutarConsulta'))
  // {
  //         function ejecutarConsulta($sql)
  //         {
  //             global $conexion;
  //             $query=$conexion->query($sql);
  //             return $query;
  //         }      
  //         function LimpiarCadena($str)
  //         {
  //             global $conexion;
  //             $str = mysqli_real_escape_string($conexion,trim($str));
  //             return htmlspecialchars($str);
  //         }
  //         function ejecutarConsulta_returnarID($sql)
  //         {
  //             global $conexion;
  //             $query=$conexion->query($sql);
  //             return $conexion->insert_id;
  //         }
  // }
  // $serverName = 'DB_HOST'; 
  // $connectionInfo = array("Database"=>"DB_NAME", "UID"=>"DB_USERNAME", "PWD"=>"DB_PASSWORD", "CharacterSet"=>"DB_ENCODE");
  // $conexion = sqlsrv_connect($serverName, $connectionInfo);

  $serverName = '192.168.6.4'; 
  $connectionInfo = array("Database"=>"dbFenix1", "UID"=>"aemartinez", "PWD"=>"aemartinez", "CharacterSet"=>"UTF-8");
  $conexion = sqlsrv_connect($serverName, $connectionInfo);
     
    if( $conexion ) {
      // echo "Conexión establecida";
        if(!function_exists('ejecutarConsulta'))
        {
                function ejecutarConsulta($sql)
                {
                    global $conexion;
                    $query = sqlsrv_query( $conexion, $sql );
                    if( $query === false) {
                        die( print_r(sqlsrv_errors(), true) );
                    }else{
                      return $query;
                    }  
                }
                function consultarUnaFila($sql)
                  {
                      global $conexion;
                      $query = sqlsrv_query($conexion,$sql);
                      // print_r($query); die();
                      $reg = sqlsrv_rows_affected($query);                      
                    //   if( $query == FALSE or $reg == FALSE) {
                    //     die(FormatErrors(sqlsrv_errors()));
                    //     echo ($reg. " row(s) updated: " . PHP_EOL);
                    //     sqlsrv_free_stmt($query);
                    // }
                      while ($reg = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                      {
                      return $reg;
                      }
                      sqlsrv_free_stmt( $query);  
                  }

                // function ejecutarConsulta_returnarID($sql)
                // {
                //     global $conexion;
                //     $query=$conexion->query($sql);
                //     return $conexion->insert_id;
                // }     
        }
        
    }else{
        echo "Conexión no se pudo establecer";
        die( print_r(sqlsrv_errors(), true));
    }

  ?>