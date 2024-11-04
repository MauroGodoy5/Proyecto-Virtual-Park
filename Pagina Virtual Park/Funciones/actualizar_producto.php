<?php
function actualizarProducto($vConexion, $id_producto, $titulo, $descripcion, $id_empresa, $imagen)
{
    // Escape de variables para prevenir inyecciones SQL
    $id_producto = mysqli_real_escape_string($vConexion, $id_producto);
    $titulo = mysqli_real_escape_string($vConexion, $titulo);
    $descripcion = mysqli_real_escape_string($vConexion, $descripcion);
    $id_empresa = mysqli_real_escape_string($vConexion, $id_empresa);

    // Directorio donde se guardan las imágenes
     // Manejar la imagen
     $nombre_archivo = $_FILES['imagen']['name'];
     $ruta_temporal = $_FILES['imagen']['tmp_name'];
     $carpeta_destino = 'imagenes/';  // Cambia 'uploads/' según tu estructura de carpetas
 

    // Mueve la imagen a la carpeta de destino
    move_uploaded_file($ruta_temporal, $carpeta_destino . $nombre_archivo);
    $ruta_imagen = $carpeta_destino . $nombre_archivo;

    // Query para actualizar el producto
    $SQL_UpdateProducto = "UPDATE productos SET titulo='$titulo', descripcion='$descripcion', id_empresa='$id_empresa', ruta_imagen='$ruta_imagen' WHERE id_producto='$id_producto'";

    // Ejecutar la query
    if (!mysqli_query($vConexion, $SQL_UpdateProducto)) {
        // Si hay un error, mostrar un mensaje o manejarlo de acuerdo a tus necesidades
        die('<h4>Error al actualizar el producto</h4>');
    }

    return true;
}
?>