<?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";
    
    //clase para la tabla categoría.
    Class Bodega
    {
        //implementamos nuestro constructor vacío de la clase categoría.
        public function __construct()
        {
        }

        //implementamos un metodo para Agregar un registro 
        public function insertar($NmBodega,$FlActiva)
        {
            $sql="INSERT INTO INV_BODEGA  (NmBodega,FlActiva)
                 VALUES('$NmBodega','$FlActiva')";
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($IdBodega,$NmBodega,$FlActiva)
        {
            $sql="UPDATE INV_BODEGA 
            SET  NmBodega='$NmBodega',FlActiva='$FlActiva'
            WHERE IdBodega='$IdBodega'"; 
            return ejecutarConsulta($sql);
        }
        
        public function validaid($IdBodega)
        { 
            $sql = "SELECT * FROM INV_BODEGA 
            WHERE IdBodega='$IdBodega'"; 
            return ejecutarConsulta($sql);               
        } 
  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($IdBodega)
        {
            $sql="SELECT * FROM INV_BODEGA 
            WHERE IdBodega='$IdBodega'"; 
            return consultarUnaFila($sql);
        }
      
        //Método para eliminar un registro
        public function eliminar($IdBodega)
        {
            $sql="DELETE FROM INV_BODEGA
            WHERE IdBodega='$IdBodega'";
            return ejecutarConsulta($sql);
        }
        
        //Método para ver todos los registros
        public function listar(){
            $sql= "SELECT IdBodega,NmBodega,FlActiva FROM INV_BODEGA"; 
            return ejecutarConsulta($sql);
        }
    }
?>