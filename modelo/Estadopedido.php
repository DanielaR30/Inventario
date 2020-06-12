<?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";
    
    //clase para la tabla categoría.
    Class EstadoPedido
    {
        //implementamos nuestro constructor vacío de la clase categoría.
        public function __construct()
        {
        }

        //implementamos un metodo para Agregar un registro 
        public function insertar($NmEstadoPedido)
        {                       
            $sql="INSERT INTO INV_ESTADO_PEDIDO (NmEstadoPedido)
                 VALUES('$NmEstadoPedido')";
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($IdEstadoPedido,$NmEstadoPedido)
        {
            $sql="UPDATE INV_ESTADO_PEDIDO 
            SET  NmEstadoPedido='$NmEstadoPedido'
            WHERE IdEstadoPedido='$IdEstadoPedido'"; 
            return ejecutarConsulta($sql);
        }
  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($IdEstadoPedido)
        {
            $sql="SELECT * FROM INV_ESTADO_PEDIDO 
            WHERE IdEstadoPedido='$IdEstadoPedido'"; 
            return consultarUnaFila($sql);
        }
      
        //Método para eliminar un registro
        public function eliminar($IdEstadoPedido)
        {
            $sql="DELETE FROM INV_ESTADO_PEDIDO
            WHERE IdEstadoPedido='$IdEstadoPedido'";
            return ejecutarConsulta($sql);
        }
        
        //Método para ver todos los registros
        public function listar(){
            $sql= "SELECT IdEstadoPedido,NmEstadoPedido FROM INV_ESTADO_PEDIDO"; 
            return ejecutarConsulta($sql);
        }
    }
?>