<?php
function insertarProducto($vConexion)
{
    $titulo = mysqli_real_escape_string($vConexion, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($vConexion, $_POST['descripcion']);
    $id_empresa = mysqli_real_escape_string($vConexion, $_POST['id_empresa']);

    // Manejar la imagen
    $nombre_archivo = $_FILES['imagen']['name'];
    $ruta_temporal = $_FILES['imagen']['tmp_name'];
    $carpeta_destino = 'imagenes/';  // Cambia 'uploads/' según tu estructura de carpetas

    // Mueve la imagen a la carpeta de destino
    move_uploaded_file($ruta_temporal, $carpeta_destino . $nombre_archivo);

    // La ruta que se almacenará en la base de datos
    $ruta_imagen = $carpeta_destino . $nombre_archivo;

    $SQL_InsertProducto = "INSERT INTO productos (titulo, descripcion, ruta_imagen, id_empresa) 
                            VALUES ('$titulo', '$descripcion', '$ruta_imagen', $id_empresa)";

    if (!mysqli_query($vConexion, $SQL_InsertProducto)) {
        // Si surge un error, puedes manejarlo según tus necesidades
        die('<h4>Error al cargar el producto</h4>');
    }

    return true;
}
