<?php
function insertarEdicion($conexion)
{
    if (isset($_POST['CargarEdicion'])) {
        $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
        $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
        $ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);

        // Obtener la fecha y hora actual
        $fecha_hora_actual = date('Y-m-d');

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

        // Consulta SQL para insertar la edición
        $sql_insertar = "INSERT INTO ediciones (titulo, descripcion, foto, ubicacion, fecha_hora) VALUES ('$titulo', '$descripcion', '$ruta_imagen', '$ubicacion', '$fecha_hora_actual')";

        // Ejecutar la consulta
        $resultado_insertar = mysqli_query($conexion, $sql_insertar);

        return $resultado_insertar;
    }
    return false;
}

?>
