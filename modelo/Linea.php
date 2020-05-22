<?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";
    
    //clase para la tabla categoría.
    Class Linea
    {
        //implementamos nuestro constructor vacío de la clase categoría.
        public function __construct()
        {
        }

        //implementamos un metodo para Agregar un registro 
        public function insertar($NmLinea)
        {                       
            $sql="INSERT INTO INV_LINEA (NmLinea)
                 VALUES('$NmLinea')";
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($IdLinea,$NmLinea)
        {
            $sql="UPDATE INV_LINEA 
            SET  NmLinea='$NmLinea'
            WHERE IdLinea='$IdLinea'"; 
            return ejecutarConsulta($sql);
        }
  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($IdLinea)
        {
            $sql="SELECT * FROM INV_LINEA 
            WHERE IdLinea='$IdLinea'"; 
            return consultarUnaFila($sql);
        }
      
        //Método para eliminar un registro
        public function eliminar($IdLinea)
        {
            $sql="DELETE FROM INV_LINEA
            WHERE IdLinea='$IdLinea'";
            return ejecutarConsulta($sql);
        }
        
        //Método para ver todos los registros
        public function listar(){
            $sql= "SELECT IdLinea,NmLinea FROM INV_LINEA"; 
            return ejecutarConsulta($sql);
        }
    }
?>
