    <?php
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";

    class Compra
    {
      //implementamos nuestro constructor
      public function __construct()
      {
      }

//BUSCAR ID PRODUCTO, IVA, EXISTENCIAS, STOCK SEGUN  NOMBRE DEL PRODUCTO
      public function search($NmProducto)
      {
        $sql = "SELECT IdProducto, PorcentajeIVA, NuExistenciaFisica, NuStockMin, NuStockMax 
                FROM INV_PRODUCTO
                WHERE	NmProducto LIKE '%{$NmProducto}'";
                return consultarUnaFila($sql);
                
                //WHERE	NmProducto = '$NmProducto'";
      }
  
      //GUARDAR CABECERA
      public function insertar($FcTransaccion, $IdTercero, $NuDocumento, $FcDocumento, $Observaciones)
      {
        $IdUsuario = $_SESSION["IdUsuario"];
        $sql = "INSERT INTO  INV_MOVIMIENTOCAB (IdTipoTransaccion, FcTransaccion, IdTercero, NuDocumento, FcDocumento, VlSubtotal, VlIVA, Observaciones, FlAnulado, IdUsuario) 
              VALUES ('1','$FcTransaccion','$IdTercero','$NuDocumento', '$FcDocumento', '0', '0', '$Observaciones', 'N', '$IdUsuario')";
        return ejecutarConsulta($sql);
      }

      //GUARDAR DETALLE 
      public function insertardet($filas)
      {
        try {
          for ($k=0; $k < count($filas); $k++) { 
            //print_r($filas[$k]); 
            $sql = "INSERT INTO  INV_MOVIMIENTODET (IdTransaccionCab, IdProducto, NuCantidad, VlUnitario, VlIVA) 
            VALUES (".$filas[$k]['IdTransaccionCab'].",".$filas[$k]['IdProducto'].",".$filas[$k]['NuCantidad'].",".$filas[$k]['VlUnitario'].",".$filas[$k]['IVA'].")";
            ejecutarConsulta($sql);
          }
          return 'datos guardados';
        } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
      }
      
          //ACTULIZAR SUBTOTAL,IVA EN MOVIMIENTO CAB
           public function subtotal($rows)
           {
             try {
               for ($k=0; $k < count($rows); $k++) { 
                         
                 $sql="UPDATE INV_MOVIMIENTOCAB 
                 SET VlSubtotal=".$rows[$k]['VlSubtotal']." ,VlIVA=".$rows[$k]['Iva']."
                 WHERE IdTransaccion= ".$rows[$k]['IdTransaccionCab']."";
                 ejecutarConsulta($sql);
               }
               return 'Compra Actualizada';
              
             } catch (\PDOException $e) {
               throw new \PDOException($e->getMessage(), (int) $e->getCode());
             }
           } 
      
      //ACTUALIZAR NRO DE EXISTENCIAS EN TABLA PRODUCTO
      public function existencias($rows)
      {
        try {
          for ($k=0; $k < count($rows); $k++) { 
                     //SELECCIONAR EXISTENCIAS Y SUMAR CANTIDAD SEGUN ID PRODUCTO
            $existencia="SELECT NuExistenciaFisica+".$rows[$k]['NuCantidad']." AS Existencia
            FROM INV_PRODUCTO
            WHERE IdProducto = ".$rows[$k]['IdProducto']."";
            $existencia = consultarUnaFila($existencia);
                     //ACTUALIZAR EXISTENCIAS FISICAS EN LA TABLA PRODUCTO
            $sql="UPDATE INV_PRODUCTO
                   SET NuExistenciaFisica = ".$existencia['Existencia']."
                   WHERE IdProducto = ".$rows[$k]['IdProducto']."";
                   ejecutarConsulta($sql);
          }
          return 'Existencia Actualizada';
         
        } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
      } 
      
      public function selectTercero()
      {
        $sql = "SELECT * FROM TERCERO";
        return ejecutarConsulta($sql);
      }
      
      public function selectNmProducto()
      {
        $sql = "SELECT * FROM INV_PRODUCTO";
        return ejecutarConsulta($sql);
      }

      public function idlast()
      {
        $sql = "SELECT MAX(IdTransaccion) AS ID FROM INV_MOVIMIENTOCAB";
        $res = consultarUnaFila($sql);
        return ($res['ID']);
      }
    }
    ?>