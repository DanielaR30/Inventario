<?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";
    
    //clase para la tabla categoría.
    Class EstadoProducto
    {
        //implementamos nuestro constructor vacío de la clase categoría.
        public function __construct()
        {
        }

        //implementamos un metodo para Agregar un registro 
        public function insertar($NmEstadoProducto)
        {                       
            $sql="INSERT INTO INV_ESTADO_PRODUCTO (NmEstadoProducto)
                 VALUES('$NmEstadoProducto')";
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($IdEstadoProducto,$NmEstadoProducto)
        {
            $sql="UPDATE INV_ESTADO_PRODUCTO 
            SET  NmEstadoProducto='$NmEstadoProducto'
            WHERE IdEstadoProducto='$IdEstadoProducto'"; 
            return ejecutarConsulta($sql);
        }
  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($IdEstadoProducto)
        {
            $sql="SELECT * FROM INV_ESTADO_PRODUCTO 
            WHERE IdEstadoProducto='$IdEstadoProducto'"; 
            return consultarUnaFila($sql);
        }
      
        //Método para eliminar un registro
        public function eliminar($IdEstadoProducto)
        {
            $sql="DELETE FROM INV_ESTADO_PRODUCTO
            WHERE IdEstadoProducto='$IdEstadoProducto'";
            return ejecutarConsulta($sql);
        }
        
        //Método para ver todos los registros
        public function listar(){
            $sql= "SELECT IdEstadoProducto,NmEstadoProducto FROM INV_ESTADO_PRODUCTO"; 
            return ejecutarConsulta($sql);
        }
    }
?>
