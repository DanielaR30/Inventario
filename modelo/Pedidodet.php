    <?php 
    // incluir la conexion ala base datos 
    require "../conexionDB/Conexion.php";

    Class Movimientodet
    {
        //implementamos nuestro constructor
        public function __construct()
        {
        }
                                                                                                        
        //implementamos un metodo para el insert de registro
        // public function insertar($IdProducto,$NuCantidad,$VlUnitario,$VlIVA)
        // {
        //     $sql = "SELECT MAX(IdTransaccion) FROM INV_MOVIMIENTOCAB";
        //     $res =  consultarUnaFila($sql);
            
        //     print_r($res['IdTransaccion']); die();
        //     $IdTransaccionCab =  $res['IdTransaccion'];
            
        //     $sql="INSERT INTO  TERCERO (IdTransaccionCab,IdProducto,NuCantidad,VlUnitario,VlIVA) 
        //     VALUES ('$IdTransaccionCab','$IdProducto','$NuCantidad','$VlUnitario','$VlIVA')";
        //     //print_r($sql); die();
        //     return ejecutarConsulta($sql);
        // }
        
        
         //   public function mostrarid()  
    //     {
    //       $sql="SELECT MAX(IdTransaccion) FROM INV_MOVIMIENTOCAB";
    //       $res= consultarUnaFila($sql);
          
    //       return ($res['IdTransaccion']);
    //     }
    

        //Método para editar registros
        // public function editar($IdTercero,$DigVerificacion,$NmRazonSocial,$Direccion,$TelefonoFijo,$TelefonoMovil,$CorreoElectronico,$IdTipoDocumento,$IdCiudad,$IdGenero,$FlActivo)
        // {
        //     $sql="UPDATE TERCERO 
        //     SET DigVerificacion='$DigVerificacion',NmRazonSocial='$NmRazonSocial',Direccion='$Direccion',TelefonoFijo='$TelefonoFijo',TelefonoMovil='$TelefonoMovil',CorreoElectronico='$CorreoElectronico',IdTipoDocumento='$IdTipoDocumento',IdCiudad='$IdCiudad',IdGenero='$IdGenero',FlActivo='$FlActivo'
        //     WHERE IdTercero='$IdTercero'";
        //     // print_r($sql); die();
        //     return ejecutarConsulta($sql);
        // }
  
        // public function validaid($IdTercero)
        // { 
        //     $sql = "SELECT * FROM TERCERO 
        //     WHERE IdTercero='$IdTercero'";
        //     return ejecutarConsulta($sql);               
        // } 
  
        // //Método para mostrar los datos de un registro a modificar
        // public function mostrar($IdTercero)
        // {
        //     $sql="SELECT * FROM TERCERO 
        //     WHERE IdTercero='$IdTercero'"; 
        //     return consultarUnaFila($sql);
        // }
        // // where'.$idOficina. 
      
        // public function eliminar($IdTercero)
        // {
        //     $sql="DELETE FROM TERCERO
        //     WHERE IdTercero='$IdTercero'";
        //     return ejecutarConsulta($sql);
        // }

        // public function listar(){
                    
        //    $sql= "SELECT  t.IdTercero,t.DigVerificacion,t.NmRazonSocial,t.Direccion,t.TelefonoFijo, t.TelefonoMovil,t.CorreoElectronico,d.NmTipoDocumento,c.NmCiudad,g.NmGenero,t.FlActivo 
        //    FROM TERCERO as t
        //    INNER JOIN TIPO_DOCUMENTO as d on d.IdTipoDocumento=t.IdTipoDocumento
        //    INNER JOIN CIUDAD as c on c.IdCiudad=t.IdCiudad
        //    INNER JOIN GENERO as g on g.IdGenero=t.IdGenero";
  
        //     return ejecutarConsulta($sql);
        // }

        // public function selectDocumento()
        // {
        //     $sql="SELECT * FROM TIPO_DOCUMENTO"; 
        //     return ejecutarConsulta($sql);		
        // }
        
        // public function selectCiudad()
        // {
        //     $sql="SELECT * FROM CIUDAD";
        //     return ejecutarConsulta($sql);		
        // }
        
        // public function selectGenero()
        // {
        //     $sql="SELECT * FROM GENERO"; 
        //     return ejecutarConsulta($sql);		
        // }
    }
?>