<?php
function eliminarProducto($vConexion, $id_producto)
{
    // Escape de variables para prevenir inyecciones SQL
    $id_producto = mysqli_real_escape_string($vConexion, $id_producto);

    // Query para eliminar el producto
    $SQL_DeleteProducto = "DELETE FROM productos WHERE id_producto='$id_producto'";

    // Ejecutar la query
    if (!mysqli_query($vConexion, $SQL_DeleteProducto)) {
        // Si hay un error, mostrar un mensaje o manejarlo de acuerdo a tus necesidades
        die('<h4>Error al eliminar el producto</h4>');
    }

    return true;
}