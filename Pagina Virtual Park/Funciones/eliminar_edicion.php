<?php
function eliminarEdicion($conexion, $id_edicion)
{
    // Consulta SQL para eliminar la edición
    $sql_eliminar = "DELETE FROM ediciones WHERE id_edicion=$id_edicion";

    // Ejecutar la consulta
    $resultado_eliminar = mysqli_query($conexion, $sql_eliminar);

    return $resultado_eliminar;
}
?>
