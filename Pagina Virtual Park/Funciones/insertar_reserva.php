<?php
function insertarReserva($vConexion) {
    // Obtiene el ID del usuario logeado desde la sesión
    $id_usuario = $_SESSION['ID']  ?? null;

    // Verifica si se obtuvo el ID del usuario logeado
    if (!$id_usuario) {
        // Si no se tiene el ID del usuario, muestra un mensaje de error o toma alguna acción apropiada
        die('<h4>Error: No se ha iniciado sesión</h4>');
    }

    // Prepara la consulta para insertar la reserva con el ID del usuario logeado
    $SQL_InsertReserva = "INSERT INTO reservas (titulo, descripcion, precio, fecha, cupos, id_usuario) 
                          VALUES ('" . $_POST['titulo'] . "', '" . $_POST['descripcion'] . "',
                                  '" . $_POST['precio'] . "', '" . $_POST['fecha'] . "',
                                  '" . $_POST['cupos'] . "', $id_usuario)";
                                  
    // Ejecuta la consulta
    if (!mysqli_query($vConexion, $SQL_InsertReserva)) {
        mysqli_rollback($vConexion);
        // Si hay un error, termina la ejecución con un mensaje
        die('<h4>Error al insertar la reserva</h4>');
    }
    return true;
}

?>