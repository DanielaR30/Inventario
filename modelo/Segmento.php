<?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";
    
    //clase para la tabla categoría.
    Class Segmento
    {
        //implementamos nuestro constructor vacío de la clase categoría.
        public function __construct()
        {
        }

        //implementamos un metodo para Agregar un registro 
        public function insertar($IdSegmento, $NmSegmento)
        {
            // $IdSegmento="SELECT MAX(IdSegmento)+1 AS ID FROM INV_SEGMENTO";
            // $res = consultarUnaFila($IdSegmento);
            
            $sql="INSERT INTO INV_SEGMENTO (IdSegmento, NmSegmento)
                 VALUES('$IdSegmento','$NmSegmento')";
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($IdSegmento,$NmSegmento)
        {
            $sql="UPDATE INV_SEGMENTO 
            SET  NmSegmento='$NmSegmento'
            WHERE IdSegmento='$IdSegmento'"; 
            return ejecutarConsulta($sql);
        }
  
        public function validaid($IdSegmento)
        { 
            $sql = "SELECT * FROM INV_SEGMENTO 
            WHERE IdSegmento='$IdSegmento'";
            return ejecutarConsulta($sql);               
        } 
  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($IdSegmento)
        {
            $sql="SELECT * FROM INV_SEGMENTO 
            WHERE IdSegmento='$IdSegmento'"; 
            return consultarUnaFila($sql);
        }
      
        //Método para eliminar un registro
        public function eliminar($IdSegmento)
        {
            $sql="DELETE FROM INV_SEGMENTO
            WHERE IdSegmento='$IdSegmento'";
            return ejecutarConsulta($sql);
        }
        
        //Método para ver todos los registros
        public function listar(){
            $sql= "SELECT IdSegmento,NmSegmento FROM INV_SEGMENTO"; 
            return ejecutarConsulta($sql);
        }
    }
?>
