    <?php 
    // incluir la conexion ala base datos 
    require "../conexionDB/Conexion.php";

    Class Oficina
    {
        //implementamos nuestro constructor
        public function __construct()
        {
        }

        //implementamos un metodo para el insert de registro
        public function insertar($idOficina,$NmOficina,$Direccion,$Telefono,$IdCiudad)
        {
            // $idOficina = "SELECT MAX(idOficina)+1 AS ID FROM OFICINA";
            // $res =  consultarUnaFila($idOficina);
            
            $sql="INSERT INTO  OFICINA (IdOficina,NmOficina,Direccion,Telefono,IdCiudad) 
            VALUES ('$idOficina','$NmOficina','$Direccion','$Telefono','$IdCiudad')";
            //print_r($sql); die();
            return ejecutarConsulta($sql);
        }

        //Método para editar registros
        public function editar($idOficina,$NmOficina,$Direccion,$Telefono,$IdCiudad)
        {
            $sql="UPDATE OFICINA 
            SET  NmOficina='$NmOficina',Direccion='$Direccion',Telefono='$Telefono',IdCiudad='$IdCiudad'
            WHERE IdOficina='$idOficina'";
            return ejecutarConsulta($sql);
        }
        
        public function validaid($idOficina)
        { 
            $sql="SELECT * FROM OFICINA 
            WHERE IdOficina='$idOficina'"; 
            return ejecutarConsulta($sql);               
        }         
  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($idOficina)
        {
            $sql="SELECT * FROM OFICINA 
            WHERE IdOficina='$idOficina'"; 
            return consultarUnaFila($sql);
        }
        // where'.$idOficina. 
      
        public function eliminar($idOficina)
        {
            $sql="DELETE FROM OFICINA
            WHERE IdOficina='$idOficina'";
            return ejecutarConsulta($sql);
        }

        public function listar(){
            $sql= "SELECT o.IdOficina,o.NmOficina,o.Direccion,o.Telefono,c.NmCiudad FROM OFICINA as o 
            INNER JOIN CIUDAD as c on c.IdCiudad=o.IdCiudad";
            return ejecutarConsulta($sql);
        }

        // select * from zona where idciudad= 'id_cuidadq selecciono' 
        
        public function selectCiudad()
        {
            $sql="SELECT * FROM CIUDAD";
            return ejecutarConsulta($sql);		
        }

        // public function selectZona()
        // {
        //     $sql="SELECT * FROM ZONA"; 
        //     return ejecutarConsulta($sql);		
        // }
    }
?>
