    <?php 
    // incluir la conexion ala base datos 
    require "../conexionDB/Conexion.php";

    Class Oficina
    {
        //implementamos nuestro constructor
        public function __construct()
        {
        }

        // public function validarusuario($correo,$clave)
        // {
        //     // print_r('hola...'); die();
        //     $sql="SELECT nombre FROM LOG_OFICINA WHERE correo='$correo' and clave='$clave'";
        //     return ejecutarConsulta($sql);
        // }

        //implementamos un metodo para el insert de registro
        public function insertar($idOficina,$NmOficina,$Direccion,$Telefono,$IdCiudad,$FlPuntodeAtencion,$IdZona,$FcApertura,$FlSedePropia,$NuEmpleados,$NuHabitantes)
        {
            $sql="INSERT INTO  OFICINA1 (idOficina,NmOficina,Direccion,Telefono,IdCiudad,FlPuntodeAtencion,IdZona,FcApertura,FlSedePropia,NuEmpleados,NuHabitantes) 
            VALUES ('$idOficina','$NmOficina','$Direccion','$Telefono','$IdCiudad','$FlPuntodeAtencion','$IdZona','$FcApertura','$FlSedePropia','$NuEmpleados','$NuHabitantes')";
            //print_r($sql); die();
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($idOficina,$NmOficina,$Direccion,$Telefono,$IdCiudad,$FlPuntodeAtencion,$IdZona,$FcApertura,$FlSedePropia,$NuEmpleados,$NuHabitantes)
        {
            $sql="UPDATE OFICINA1 
            SET  NmOficina='$NmOficina',Direccion='$Direccion',Telefono='$Telefono',IdCiudad='$IdCiudad',FlPuntodeAtencion='$FlPuntodeAtencion',IdZona='$IdZona',FcApertura='$FcApertura',FlSedePropia='$FlSedePropia',NuEmpleados='$NuEmpleados',NuHabitantes='$NuHabitantes'
            WHERE idOficina='$idOficina'";
            // print_r($sql); die();
            return ejecutarConsulta($sql);
        }
  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($idOficina)
        {
            $sql="SELECT * FROM OFICINA1 
            WHERE idOficina='$idOficina'"; 
            return consultarUnaFila($sql);
        }
        // where'.$idOficina. 
      
        public function eliminar($idOficina)
        {
            $sql="DELETE FROM OFICINA1
            WHERE idOficina='$idOficina'";
            return ejecutarConsulta($sql);
        }

        public function listar(){
            $sql= "SELECT o.idOficina,o.NmOficina,o.Direccion,o.Telefono,c.NmCiudad,o.FlPuntodeAtencion,z.NmZona,o.FcApertura,o.FlSedePropia,o.NuEmpleados,o.NuHabitantes FROM OFICINA1 as o 
            INNER JOIN CIUDAD as c on c.IdCiudad=o.IdCiudad
            INNER JOIN ZONA as z on z.IdZona=o.IdZona"; 
            return ejecutarConsulta($sql);
        }

        // select * from zona where idciudad= 'id_cuidadq selecciono' 
        
        public function selectCiudad($IdZona)
        {
            $sql="SELECT * 
            FROM CIUDAD 
            where IdZona='$IdZona'";
            return ejecutarConsulta($sql);		
        }

        public function selectZona()
        {
            $sql="SELECT * FROM ZONA"; 
            return ejecutarConsulta($sql);		
        }


    }
?>
