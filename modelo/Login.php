<?php 
//incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";

    Class Login
    {
        //implementamos nuestro constructor
        public function __construct()
        {
        }
              
        //seleccione usuario si existe y si está activo
         public function validarusuario($NmUsuario)
        {
            $sql="SELECT * FROM USUARIO 
            WHERE NmUsuario = '$NmUsuario' AND FlUsuarioActivo = 'S'";            
            return ejecutarConsulta($sql); 
            
            // $sql="SELECT * FROM USUARIO 
            // WHERE NmUsuario LIKE '$NmUsuario%' AND FlUsuarioActivo = 'S'
            // -- WHERE NmUsuario='$NmUsuario'
            // -- WHERE EXISTS (SELECT * FROM USUARIO WHERE NmUsuario='$NmUsuario') ";
            // return ejecutarConsulta($sql);
        }  
    
        
        
    }
?>