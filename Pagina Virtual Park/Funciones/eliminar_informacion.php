<?php
function eliminarInformacion($vConexion, $id_informacion)
{
    // Escape de variables para prevenir inyecciones SQL
    $id_informacion = mysqli_real_escape_string($vConexion, $id_informacion);

    // Query para eliminar el producto
    $SQL_DeleteInformacion = "DELETE FROM informacion WHERE id_informacion='$id_informacion'";

    // Ejecutar la query
    if (!mysqli_query($vConexion, $SQL_DeleteInformacion)) {
        // Si hay un error, mostrar un mensaje o manejarlo de acuerdo a tus necesidades
        die('<h4>Error al eliminar la informacion</h4>');
    }

    return true;
}