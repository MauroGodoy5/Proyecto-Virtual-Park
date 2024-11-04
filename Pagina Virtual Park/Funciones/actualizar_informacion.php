<?php
function actualizarInformacion($vConexion, $id_informacion, $nombre, $fecha, $hora, $lugar, $titulo, $descripcion)
{
    // Escape de variables para prevenir inyecciones SQL
    $id_informacion = mysqli_real_escape_string($vConexion, $id_informacion);
    $nombre = mysqli_real_escape_string($vConexion, $nombre);
    $fecha = mysqli_real_escape_string($vConexion, $fecha);
    $hora = mysqli_real_escape_string($vConexion, $hora);
	$lugar = mysqli_real_escape_string($vConexion, $lugar);
    $titulo = mysqli_real_escape_string($vConexion, $titulo);
    $descripcion = mysqli_real_escape_string($vConexion, $descripcion);

    // Query para actualizar el producto
    $SQL_UpdateInformacion = "UPDATE informacion SET nombre='$nombre', fecha='$fecha', 
							hora='$hora', lugar='$lugar', tituloInfo='$titulo', descInfo='$descripcion' 
							WHERE id_informacion='$id_informacion'";

    // Ejecutar la query
    if (!mysqli_query($vConexion, $SQL_UpdateInformacion)) {
        // Si hay un error, mostrar un mensaje o manejarlo de acuerdo a tus necesidades
        die('<h4>Error al actualizar la informacion</h4>');
    }

    return true;
}

?>