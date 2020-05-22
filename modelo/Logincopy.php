<?php 
//incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";

    Class Login
    {
        //implementamos nuestro constructor
        public function __construct()
        {
        }

        public function validarusuario($correo,$clave)
        {
            $sql="SELECT * FROM LOG_OFICINA WHERE correo='$correo' and clave='$clave'";
           // print_r($sql); die();
            return ejecutarConsulta($sql);
        }

        // public function listar(){
        //     $sql= "SELECT * FROM OFICINA";
        //     return ejecutarConsulta($sql);
        // }
    
    }
?>
