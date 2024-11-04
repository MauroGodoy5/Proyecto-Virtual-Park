<?php
function actualizarEdicion($conexion, $id_edicion, $titulo, $descripcion, $ubicacion,$imagen)
{

     // Procesar la imagen si se ha cargado
     if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_temporal = $_FILES['imagen']['tmp_name'];

        // Mueve la imagen a la carpeta deseada
        $ruta_imagen = "imagenes/" . $imagen_nombre;
        move_uploaded_file($imagen_temporal, $ruta_imagen);
    } else {
        // Si no se cargó una imagen, puedes asignar un valor predeterminado o dejarlo en blanco según tus necesidades
        $ruta_imagen = "";
    }

    // Consulta SQL para actualizar la edición
    $sql_actualizar = "UPDATE ediciones SET titulo='$titulo', descripcion='$descripcion', ubicacion='$ubicacion', foto='$ruta_imagen' WHERE id_edicion=$id_edicion";

    // Ejecutar la consulta
    $resultado_actualizar = mysqli_query($conexion, $sql_actualizar);

    return $resultado_actualizar;
}
?>
