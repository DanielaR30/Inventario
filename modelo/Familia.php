<?php 
// incluir la conexion ala base datos 
require "../conexionDB/Conexion.php";

Class Familia
{
    //implementamos nuestro constructor
    public function __construct()
    {
    }

    //implementamos un metodo para el insert de registro
    public function insertar($IdFamilia,$NmFamilia,$IdSegmento)
    {
        // $IdFamilia = "SELECT MAX(IdFamilia)+1 AS ID FROM INV_FAMILIA";
        // $res =  consultarUnaFila($IdFamilia);
        
        $sql="INSERT INTO  INV_FAMILIA (IdFamilia,NmFamilia,IdSegmento) 
        VALUES ('$IdFamilia','$NmFamilia','$IdSegmento')";
        //print_r($sql); die();
        return ejecutarConsulta($sql);
    }

    //Método para editar registros
    public function editar($IdFamilia,$NmFamilia,$IdSegmento)
    {
        $sql="UPDATE INV_FAMILIA 
        SET  NmFamilia='$NmFamilia',IdSegmento='$IdSegmento'
        WHERE IdFamilia='$IdFamilia'";
        return ejecutarConsulta($sql);
    }
    
    public function validaid($IdFamilia)
    { 
        $sql="SELECT * FROM INV_FAMILIA 
        WHERE IdFamilia='$IdFamilia'"; 
        return ejecutarConsulta($sql);               
    } 

    //Método para mostrar los datos de un registro a modificar
    public function mostrar($IdFamilia)
    {
        $sql="SELECT * FROM INV_FAMILIA 
        WHERE IdFamilia='$IdFamilia'"; 
        return consultarUnaFila($sql);
    }
    // where'.$IdFamilia. 
  
    public function eliminar($IdFamilia)
    {
        $sql="DELETE FROM INV_FAMILIA
        WHERE IdFamilia='$IdFamilia'";
        return ejecutarConsulta($sql);
    }

    public function listar(){
        $sql= "SELECT f.IdFamilia,f.NmFamilia,s.NmSegmento FROM INV_FAMILIA as f 
        INNER JOIN INV_SEGMENTO as s on s.IdSegmento=f.IdSegmento";
        return ejecutarConsulta($sql);
    }
    // select * from zona where idciudad= 'id_cuidadq selecciono' 
    
    public function selectSegmento()
    {
        $sql="SELECT * FROM INV_SEGMENTO";
        return ejecutarConsulta($sql);		
    }
}
?>
