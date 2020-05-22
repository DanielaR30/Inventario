<?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";
    
    //clase para la tabla categoría.
    Class Area
    {
        //implementamos nuestro constructor vacío de la clase categoría.
        public function __construct()
        {
        }

        //implementamos un metodo para Agregar un registro 
        public function insertar($NmArea)
        {                       
            $sql="INSERT INTO INV_AREA (NmArea)
                 VALUES('$NmArea')";
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($IdArea,$NmArea)
        {
            $sql="UPDATE INV_AREA 
            SET  NmArea='$NmArea'
            WHERE IdArea='$IdArea'"; 
            return ejecutarConsulta($sql);
        }
  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($IdArea)
        {
            $sql="SELECT * FROM INV_AREA 
            WHERE IdArea='$IdArea'"; 
            return consultarUnaFila($sql);
        }
      
        //Método para eliminar un registro
        public function eliminar($IdArea)
        {
            $sql="DELETE FROM INV_AREA
            WHERE IdArea='$IdArea'";
            return ejecutarConsulta($sql);
        }
        
        //Método para ver todos los registros
        public function listar(){
            $sql= "SELECT IdArea,NmArea FROM INV_AREA"; 
            return ejecutarConsulta($sql);
        }
    }
?>
