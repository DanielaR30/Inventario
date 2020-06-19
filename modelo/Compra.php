    <?php
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";

    class Compra
    {
      //implementamos nuestro constructor
      public function __construct()
      {
      }

      // //implementamos un metodo para el insert de registro
      public function insertar($FcTransaccion, $IdTercero, $NuDocumento, $FcDocumento, $Observaciones)
      {
        $IdUsuario = $_SESSION["IdUsuario"];
        $sql = "INSERT INTO  INV_MOVIMIENTOCAB (IdTipoTransaccion, FcTransaccion, IdTercero, NuDocumento, FcDocumento, VlSubtotal, VlIVA, Observaciones, FlAnulado, IdUsuario) 
            VALUES ('1','$FcTransaccion','$IdTercero','$NuDocumento', '$FcDocumento', '0', '0', '$Observaciones', 'N', '$IdUsuario')";
        // print_r($sql); die();
        return ejecutarConsulta($sql);
      }

      // public function insertardet($IdTransaccionCab,$IdProducto,$NuCantidad,$VlUnitario,$VlIVA)
      public function insertardet($filas)
      {
        try {

          for ($k=0; $k < count($filas); $k++) { 
            //print_r($filas[$k]); 
            $sql = "INSERT INTO  INV_MOVIMIENTODET (IdTransaccionCab, IdProducto, NuCantidad, VlUnitario, VlIVA) 
            VALUES (".$filas[$k]['IdTransaccionCab'].",".$filas[$k]['IdProducto'].",".$filas[$k]['NuCantidad'].",".$filas[$k]['VlUnitario'].",'2')";
            ejecutarConsulta($sql);
          }
          return 'datos guardados';
          //die();
        } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
      }
      
      public function selectTercero()
      {
        $sql = "SELECT * FROM TERCERO";
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