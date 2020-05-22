    <?php 
    // incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";
    
    //clase para la tabla categoría.
    Class Cargo
    {
        //implementamos nuestro constructor vacío de la clase categoría.
        public function __construct()
        {
        }

        //implementamos un metodo para Agregar un registro 
        public function insertar($NmCargo,$FlActivo)
        {
            $sql="INSERT INTO CARGO  (NmCargo,FlActivo)
                 VALUES('$NmCargo','$FlActivo')";
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($IdCargo,$NmCargo,$FlActivo)
        {
            $sql="UPDATE CARGO 
            SET  NmCargo='$NmCargo',FlActivo='$FlActivo'
            WHERE IdCargo='$IdCargo'"; 
            return ejecutarConsulta($sql);
        }
  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($IdCargo)
        {
            $sql="SELECT * FROM CARGO 
            WHERE IdCargo='$IdCargo'"; 
            return consultarUnaFila($sql);
        }
      
        //Método para eliminar un registro
        public function eliminar($IdCargo)
        {
            $sql="DELETE FROM CARGO
            WHERE IdCargo='$IdCargo'";
            return ejecutarConsulta($sql);
        }
        
        //Método para ver todos los registros
        public function listar(){
            $sql= "SELECT IdCargo,NmCargo,FlActivo FROM CARGO"; 
            return ejecutarConsulta($sql);
        }
    }
?>
