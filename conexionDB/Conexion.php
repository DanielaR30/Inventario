  <?php 

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

// define("KEY","inventario");
// define("COD","AES-128-ECB");
  ?>