<?php 
    //incluir la conexion a la base datos 
    require "../conexionDB/Conexion.php";

    Class Producto
    {
        //implementamos nuestro constructor
        public function __construct()
        {
        }     
        
 // mostrar id autoincremental según:  familia, segmento, clase      
public function mostrarid($IdClase){

            try {   
            //idfamilia pertenece al id clase
                $IDFamilia= "SELECT IDFamilia        
                FROM INV_CLASE 
                WHERE IdClase = '$IdClase'";
                $IDFamilia = consultarUnaFila($IDFamilia); 
                $IDFamilia = $IDFamilia['IDFamilia'];           
                
            //id segmento que pertenece al id familia   
                $IdSegmento = "SELECT IdSegmento        
                FROM INV_FAMILIA 
                WHERE IdFamilia = '$IDFamilia'";
                $IdSegmento = consultarUnaFila($IdSegmento); 
                $IdSegmento = $IdSegmento['IdSegmento'];  
                
            //seleccionar idproducto
                $IdProducto = "SELECT IdProducto FROM INV_PRODUCTO";
                $Idproducto =  consultarUnaFila($IdProducto);
                $Idproducto = $Idproducto['IdProducto'];      
                            
            //si no hay registros id producto inicia en 1
                if ( $Idproducto === null) {              
                    $Idproducto= $IdSegmento . $IDFamilia . $IdClase . '00001';
                    return ($Idproducto);
                } else {
               //si hay registros seleccione idproducto y aumente en 1 
                    $IdProducto = "SELECT MAX(SUBSTRING(IdProducto, 6, 5))+1 AS ID FROM INV_PRODUCTO";
                    $res =  consultarUnaFila($IdProducto); 
                    //agregar nro de ceros correspondiente a la izquerda
                    $IdProducto = str_pad($res['ID'], 5, '0', STR_PAD_LEFT);
                    // concatenar idsegmento,idfamili,idclase,idproducto para Código final
                    $Idproducto= $IdSegmento . $IDFamilia . $IdClase . $IdProducto;
                    return ($Idproducto);
                    
                }
                } 
                catch (Exception $e) {
                    $e->errorMessage();
                    print_r($e);
                  }
}   

                
  //método para el insert de registros
        public function insertar(
        $IdProducto,
        $IdClase,
        $NmProducto,
        $Descripcion,
        $CodigoBarras,
        $ImagenProducto,
        $IdMarca,
        $IdLinea,
        $IdUnidadMedida,
        $IdLocalizacion,
        // $NuExistenciaFisica,
        // $NuExistenciaEnTransito,
        $NuStockMin,
        $NuStockMax,
        $GravadoIVA,
        $PorcentajeIVA
        // $VlCostoPromedio,
        // $IdEstadoProducto
        ) {            
        
            $sql="INSERT INTO  INV_PRODUCTO (
             IdProducto,
             IdClase,
             NmProducto,
             Descripcion,
             CodigoBarras,
             ImagenProducto,
             IdMarca,
             IdLinea,
             IdUnidadMedida,
             IdLocalizacion,
             NuExistenciaFisica,
             NuStockMin,
             NuStockMax,
             GravadoIVA,
             PorcentajeIVA,
             VlCostoPromedio,
             IdEstadoProducto) 
            VALUES (
            '$IdProducto',
            '$IdClase',
            '$NmProducto',
            '$Descripcion',
            '$CodigoBarras',
            '$ImagenProducto',
            '$IdMarca',
            '$IdLinea',
            '$IdUnidadMedida',
            '$IdLocalizacion',
            '0',
            '$NuStockMin',
            '$NuStockMax',
            '$GravadoIVA',
            '$PorcentajeIVA',
            '0',
            '1'
            )";
            return ejecutarConsulta($sql);
        }

 //Método para editar registros
        public function editar(
        $IdProducto,
        $IdClase,
        $NmProducto,
        $Descripcion,
        $CodigoBarras,
        $ImagenProducto,
        $IdMarca,
        $IdLinea,
        $IdUnidadMedida,
        $IdLocalizacion,
        $NuStockMin,
        $NuStockMax
        )
        {
            $sql="UPDATE INV_PRODUCTO 
            SET 
             IdClase='$IdClase',
             NmProducto='$NmProducto',
             Descripcion='$Descripcion',
             CodigoBarras='$CodigoBarras',
             ImagenProducto='$ImagenProducto',
             IdMarca='$IdMarca',
             IdLinea='$IdLinea',
             IdUnidadMedida='$IdUnidadMedida',
             IdLocalizacion='$IdLocalizacion',
             NuStockMin='$NuStockMin',
             NuStockMax='$NuStockMax'
            WHERE IdProducto='$IdProducto'";
            return ejecutarConsulta($sql);           
            
        }
  
  //selecciona los registros según el id
        public function validaid($IdProducto)
        { 
            $sql = "SELECT * FROM INV_PRODUCTO 
            WHERE IdProducto='$IdProducto'";
            return ejecutarConsulta($sql);               
        } 

  
        //Método para mostrar los datos de un registro a modificar
        public function mostrar($IdProducto)
        {       
            // $sql="SELECT IdProducto, IdClase, NmProducto, Descripcion, CodigoBarras, ImagenProducto, IdMarca, IdLinea, IdUnidadMedida,
            // IdLocalizacion, NuExistenciaFisica, NuExistenciaEnTransito, NuStockMin, NuStockMax, convert(varchar,cast(VlCostoPromedio as money),1) as VlCostoPromedio,
            // convert(varchar,cast(PrecioVentaEf as money),1) as PrecioVentaEf, convert(varchar,cast(PrecioVentaCr as money),1) as PrecioVentaCr , IdEstadoProducto          
            $sql="SELECT * FROM INV_PRODUCTO 
            WHERE IdProducto='$IdProducto'"; 
            return consultarUnaFila($sql);
        }
      
        public function eliminar($IdProducto)
        {
            $sql="DELETE FROM INV_PRODUCTO
            WHERE IdProducto='$IdProducto'";
            return ejecutarConsulta($sql);
        }
        

        public function listar()
        {    
           $sql= "SELECT p.IdProducto, c.NmClase, p.NmProducto, p.Descripcion, p.CodigoBarras, p.ImagenProducto, m.NmMarca, l.NmLinea,
           u.NmUnidadMedida, b.NmBodega, p.NuExistenciaFisica, p.NuStockMin, p.NuStockMax, 
           convert(varchar,cast(p.VlCostoPromedio as money),1) as 'VlCostoPromedio', p.GravadoIVA, p.PorcentajeIVA, e.NmEstadoProducto          
           FROM INV_PRODUCTO as p
           INNER JOIN INV_CLASE as c on c.IdClase=p.IdClase
           INNER JOIN INV_MARCA as m on m.IdMarca=p.IdMarca
           INNER JOIN INV_LINEA as l on l.IdLinea=p.IdLinea
           INNER JOIN INV_UNIDAD_MEDIDA as u on u.IdUnidadMedida=p.IdUnidadMedida
           INNER JOIN INV_BODEGA as b on b.IdBodega=p.IdLocalizacion
           INNER JOIN INV_ESTADO_PRODUCTO as e on e.IdEstadoProducto=p.IdEstadoProducto"; 
           return ejecutarConsulta($sql);
        }
        

        public function selectClase()
        {
            $sql="SELECT * FROM INV_CLASE"; 
            return ejecutarConsulta($sql);		
        }
        
        public function selectMarca()
        {
            $sql="SELECT * FROM INV_MARCA";
            return ejecutarConsulta($sql);		
        }
        
        public function selectLinea()
        {
            $sql="SELECT * FROM INV_LINEA";
            return ejecutarConsulta($sql);		
        }
        
        public function selectUnidad()
        {
            $sql="SELECT * FROM INV_UNIDAD_MEDIDA";
            return ejecutarConsulta($sql);		
        }
        
        public function selectBodega()
        {
            $sql="SELECT * FROM INV_BODEGA";
            return ejecutarConsulta($sql);		
        }
        
        public function selectEstado()
        {
            $sql="SELECT * FROM INV_ESTADO_PRODUCTO"; 
            return ejecutarConsulta($sql);		
        }
    }
?>