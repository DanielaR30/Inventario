<?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";
    
    //clase para la tabla categoría.
    Class UnidadMedida
    {
        //implementamos nuestro constructor vacío de la clase categoría.
        public function __construct()
        {
        }

        //implementamos un metodo para Agregar un registro 
        public function insertar($CdUnidadMedida, $NmUnidadMedida)
        {                       
            $sql="INSERT INTO INV_UNIDAD_MEDIDA (CdUnidadMedida,NmUnidadMedida)
                 VALUES('$CdUnidadMedida','$NmUnidadMedida')";              
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($IdUnidadMedida, $CdUnidadMedida, $NmUnidadMedida)
        {
            $sql="UPDATE INV_UNIDAD_MEDIDA 
            SET  NmUnidadMedida='$NmUnidadMedida', CdUnidadMedida='$CdUnidadMedida'
            WHERE IdUnidadMedida='$IdUnidadMedida'"; 
            // print_r($sql); die();
            return ejecutarConsulta($sql);
        }
  
        public function validaid($IdUnidadMedida)
        { 
            $sql = "SELECT * FROM INV_UNIDAD_MEDIDA 
            WHERE IdUnidadMedida='$IdUnidadMedida'";
            return ejecutarConsulta($sql);               
        } 
  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($IdUnidadMedida)
        {
            $sql="SELECT * FROM INV_UNIDAD_MEDIDA 
            WHERE IdUnidadMedida='$IdUnidadMedida'"; 
            // $u= consultarUnaFila($sql);
            // print_r($u); die();
            return consultarUnaFila($sql);
        }
      
        //Método para eliminar un registro
        public function eliminar($IdUnidadMedida)
        {
            $sql="DELETE FROM INV_UNIDAD_MEDIDA
            WHERE IdUnidadMedida='$IdUnidadMedida'";
            return ejecutarConsulta($sql);
        }
        
        //Método para ver todos los registros
        public function listar(){
            $sql= "SELECT * FROM INV_UNIDAD_MEDIDA"; 
            return ejecutarConsulta($sql);
        }
    }
?>
