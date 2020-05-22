<?php 
// incluir la conexion ala base datos 
require "../conexionDB/Conexion.php";

Class Clase
{
    //implementamos nuestro constructor
    public function __construct()
    {
    }

    //implementamos un metodo para el insert de registro
    public function insertar($IdClase,$NmClase,$IDFamilia)
    {    
        $sql="INSERT INTO  INV_CLASE (IdClase,NmClase,IDFamilia) 
        VALUES ('$IdClase','$NmClase','$IDFamilia')";
        //print_r($sql); die();
        return ejecutarConsulta($sql);
    }

    //Método para editar registros
    public function editar($IdClase,$NmClase,$IDFamilia)
    {
        $sql="UPDATE INV_CLASE 
        SET  NmClase='$NmClase',IDFamilia='$IDFamilia'
        WHERE IdClase='$IdClase'";
        return ejecutarConsulta($sql);
    }    
    
    public function validaid($IdClase)
    { 
        $sql = "SELECT * FROM INV_CLASE 
        WHERE IdClase='$IdClase'";
        return ejecutarConsulta($sql);               
    } 

    //Método para mostrar los datos de un registro a modificar
    public function mostrar($IdClase)
    {
        $sql="SELECT * FROM INV_CLASE 
        WHERE IdClase='$IdClase'"; 
        return consultarUnaFila($sql);
    }
    
    // where'.$IdClase.   
    public function eliminar($IdClase)
    {
        $sql="DELETE FROM INV_CLASE
        WHERE IdClase='$IdClase'";
        return ejecutarConsulta($sql);
    }

    public function listar()
    {
        $sql= "SELECT c.IdClase,c.NmClase,f.NmFamilia FROM INV_CLASE as c 
        INNER JOIN INV_FAMILIA as f on f.IdFamilia=c.IDFamilia";
        return ejecutarConsulta($sql);
    }
    
    // select * from zona where idciudad= 'id_cuidadq selecciono'     
    public function selectFamilia()
    {
        $sql="SELECT * FROM INV_FAMILIA";
        return ejecutarConsulta($sql);		
    }
}
?>