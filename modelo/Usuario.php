    <?php 
    // incluir la conexion ala base datos 
    require "../conexionDB/Conexion.php";

    Class Usuario
    {
        //implementamos nuestro constructor
        public function __construct()
        {
        }

        //implementamos un metodo para el insert de registro        
        // public function ids(){
        //     $sql = "SELECT MAX(IdUsuario)+1 as ID  FROM USUARIO";
        //     return ejecutarConsulta($sql);
        // }                    
        
        public function insertar($IdUsuario,$NmUsuario,$hash, $TipoUsuario, $FlUsuarioActivo, $IdOficina, $IdCargo)
        {       
            $sql="INSERT INTO  USUARIO (IdUsuario, NmUsuario, Clave, TipoUsuario, FlUsuarioActivo, IdOficina, IdCargo)
            VALUES ('$IdUsuario','$NmUsuario','$hash','$TipoUsuario','$FlUsuarioActivo','$IdOficina','$IdCargo')";
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($IdUsuario, $NmUsuario, $hash, $TipoUsuario, $FlUsuarioActivo, $IdOficina, $IdCargo)
        {  
            $sql="UPDATE USUARIO 
            SET  IdUsuario='$IdUsuario',NmUsuario='$NmUsuario',Clave='$hash',TipoUsuario='$TipoUsuario',FlUsuarioActivo='$FlUsuarioActivo',IdOficina='$IdOficina',IdCargo='$IdCargo'
            WHERE IdUsuario='$IdUsuario'";
            //  print_r($IdUsuario); die();
            return ejecutarConsulta($sql);
        }
  
        public function validaid($IdUsuario)
        { 
            $sql = "SELECT * FROM USUARIO 
            WHERE IdUsuario='$IdUsuario'";
            return ejecutarConsulta($sql);               
        } 
          
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($IdUsuario)
        {
            $sql="SELECT * FROM USUARIO 
            WHERE IdUsuario='$IdUsuario'"; 
            return consultarUnaFila($sql);
        }
        
        public function noreg()
        {
            $sql="SELECT COUNT(IdUsuario) FROM USUARIO"; 
            return ejecutarConsulta($sql);
        }
                
        // where'.$idOficina.       
        public function eliminar($IdUsuario)
        {
            $sql="DELETE FROM USUARIO
            WHERE IdUsuario='$IdUsuario'";
            return ejecutarConsulta($sql);
        }
        
        public function listar(){
            $sql= "SELECT u.IdUsuario,u.NmUsuario,u.Clave,u.TipoUsuario,u.FlUsuarioActivo,o.NmOficina,c.NmCargo 
            FROM USUARIO AS u
            INNER JOIN OFICINA AS o ON u.IdOficina=o.IdOficina
            INNER JOIN CARGO AS c ON u.IdCargo=c.IdCargo"; 
            return ejecutarConsulta($sql);
        }
        
        public function selectoficina()
        {
            $sql="SELECT * FROM OFICINA";  
            return ejecutarConsulta($sql);	 
        }

        public function selectcargo()
        {
            $sql="SELECT * FROM CARGO WHERE FlActivo='S'"; 
            return ejecutarConsulta($sql);		
        }
    }
?>