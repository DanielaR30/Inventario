    <?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";

    Class Pedidocab
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

      public function selectTercero()
        {
            $sql="SELECT * FROM TERCERO"; 
            return ejecutarConsulta($sql);		
        }
          
        public function idlast()  
        {
            $sql="SELECT MAX(IdTransaccion) AS ID FROM INV_MOVIMIENTOCAB";
            $res= consultarUnaFila($sql);
            // $IdTransaccion= $res['ID']
            return ($res['ID']);
        }
        
    }
?>