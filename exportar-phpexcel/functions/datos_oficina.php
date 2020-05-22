<?php 
// function getAllListsAndVideos()
// {
//   $mysqli = getConnexion();
//   $query = 'SELECT L.nombre as lista, V.nombre AS video, V.duracion, V.url 
//   FROM `videos` AS V JOIN `listas_reproduccion` AS L ON V.id_lista = L.id';
//   return $mysqli->query($query);
// }

function datos_oficina()
{
  $sql = 'SELECT  o.NmOficina,o.Direccion,o.Telefono,c.NmCiudad, o.FcApertura
  FROM OFICINA1 o, CIUDAD c
  WHERE c.IdCiudad=o.IdCiudad';
  return ejecutarConsulta($sql);
}

?>