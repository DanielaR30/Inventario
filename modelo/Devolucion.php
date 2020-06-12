    <?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";

    Class Movimientocab
    {
        //implementamos nuestro constructor
        public function __construct()
        {
        }
                                                                                                        
        // //implementamos un metodo para el insert de registro
        public function insertar($FcTransaccion,$IdTercero,$NuDocumento,$FcDocumento,$Observaciones)
        {                      
            $IdUsuario = $_SESSION["IdUsuario"];
            $sql="INSERT INTO  INV_MOVIMIENTOCAB (IdTipoTransaccion, FcTransaccion, IdTercero, NuDocumento, FcDocumento, VlSubtotal, VlIVA, Observaciones, FlAnulado, IdUsuario) 
            VALUES ('1','$FcTransaccion','$IdTercero','$NuDocumento', '$FcDocumento', '0', '0', '$Observaciones', 'N', '$IdUsuario')";
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
            print_r($res['ID']); die();
            return ($res['ID']);
        }
        
    }
?>