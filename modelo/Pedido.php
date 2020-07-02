    <?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";

    Class Pedido
    {
        //implementamos nuestro constructor
        public function __construct()
        {
        }
                                                                                                        
        // //implementamos un metodo para el insert de registro
        public function insertar($FcOrdenPedido,$IdTercero)
        {                      
            $IdUsuario = $_SESSION["IdUsuario"];
            
            $sql="INSERT INTO  INV_ORDEN_PEDIDOCAB (FcOrdenPedido, IdTercero, IdEstadoPedido, IdUsuario) 
            VALUES ('$FcOrdenPedido','$IdTercero','1', '$IdUsuario')";
            // print_r($sql); die();
            return ejecutarConsulta($sql);
        }
        
        public function insertardet($filas){
        
            try {
                for ($k=0; $k < count($filas); $k++) { 
                
                $costo ="SELECT VlCostoPromedio
                FROM  INV_PRODUCTO
                WHERE IdProducto=".$filas[$k]['IdProducto']."";
                $costo = consultarUnaFila($costo);
                
                  $sql = "INSERT INTO  INV_ORDEN_PEDIDODET (IdOrdenPedidoCab, IdProducto, NuCantidad, VlCosto) 
                  VALUES (".$filas[$k]['IdOrdenPedidoCab'].",".$filas[$k]['IdProducto'].",".$filas[$k]['NuCantidad'].",".$costo['VlCostoPromedio'].")";
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
            $sql="SELECT * FROM TERCERO"; 
            return ejecutarConsulta($sql);		
        }
          
        public function idlast()  
        {
            $sql="SELECT MAX(IdOrdenPedido) AS ID FROM INV_ORDEN_PEDIDOCAB";
            $res= consultarUnaFila($sql);
            // $IdTransaccion= $res['ID']
            return ($res['ID']);
        }
    }
?>