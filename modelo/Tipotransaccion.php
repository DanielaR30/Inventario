<?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";
    
    //clase para la tabla categoría.
    Class TipoTransaccion
    {
        //implementamos nuestro constructor vacío de la clase categoría.
        public function __construct()
        {
        }

        //implementamos un metodo para Agregar un registro 
        public function insertar($NmTipoTransaccion,$CdNaturaleza)
        {
            $sql="INSERT INTO INV_TIPO_TRANSACCION  (NmTipoTransaccion,CdNaturaleza)
                 VALUES('$NmTipoTransaccion','$CdNaturaleza')";
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($IdTipoTransaccion,$NmTipoTransaccion,$CdNaturaleza)
        {
            $sql="UPDATE INV_TIPO_TRANSACCION 
            SET  NmTipoTransaccion='$NmTipoTransaccion',CdNaturaleza='$CdNaturaleza'
            WHERE IdTipoTransaccion='$IdTipoTransaccion'"; 
            return ejecutarConsulta($sql);
        }
        
        public function validaid($IdTipoTransaccion)
        { 
            $sql = "SELECT * FROM INV_TIPO_TRANSACCION 
            WHERE IdTipoTransaccion='$IdTipoTransaccion'"; 
            return ejecutarConsulta($sql);               
        } 
  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($IdTipoTransaccion)
        {
            $sql="SELECT * FROM INV_TIPO_TRANSACCION 
            WHERE IdTipoTransaccion='$IdTipoTransaccion'"; 
            return consultarUnaFila($sql);
        }
      
        //Método para eliminar un registro
        public function eliminar($IdTipoTransaccion)
        {
            $sql="DELETE FROM INV_TIPO_TRANSACCION
            WHERE IdTipoTransaccion='$IdTipoTransaccion'";
            return ejecutarConsulta($sql);
        }
        
        //Método para ver todos los registros
        public function listar(){
            $sql= "SELECT IdTipoTransaccion,NmTipoTransaccion,CdNaturaleza FROM INV_TIPO_TRANSACCION"; 
            return ejecutarConsulta($sql);
        }
    }
    
?>