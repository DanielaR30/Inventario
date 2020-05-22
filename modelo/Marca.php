<?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";
    
    //clase para la tabla categoría.
    Class Marca
    {
        //implementamos nuestro constructor vacío de la clase categoría.
        public function __construct()
        {
        }

        //implementamos un metodo para Agregar un registro 
        public function insertar($NmMarca)
        {                       
            $sql="INSERT INTO INV_MARCA (NmMarca)
                 VALUES('$NmMarca')";
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($IdMarca,$NmMarca)
        {
            $sql="UPDATE INV_MARCA 
            SET  NmMarca='$NmMarca'
            WHERE IdMarca='$IdMarca'"; 
            return ejecutarConsulta($sql);
        }
  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($IdMarca)
        {
            $sql="SELECT * FROM INV_MARCA 
            WHERE IdMarca='$IdMarca'"; 
            return consultarUnaFila($sql);
        }
      
        //Método para eliminar un registro
        public function eliminar($IdMarca)
        {
            $sql="DELETE FROM INV_MARCA
            WHERE IdMarca='$IdMarca'";
            return ejecutarConsulta($sql);
        }
        
        //Método para ver todos los registros
        public function listar(){
            $sql= "SELECT IdMarca,NmMarca FROM INV_MARCA"; 
            return ejecutarConsulta($sql);
        }
    }
?>
