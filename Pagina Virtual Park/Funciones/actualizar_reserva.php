<?php
function actualizarReserva($vConexion) {
    if (isset($_POST['ModificarReserva'])) {
        $id_reserva = $_POST['id_reserva'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $fecha = $_POST['fecha'];
        $cupos = $_POST['cupos'];

        $SQL_UpdateReserva = "UPDATE reservas SET titulo = '$titulo', descripcion = '$descripcion', precio = '$precio', fecha = '$fecha', cupos = '$cupos' WHERE id_reserva = $id_reserva";

        if (mysqli_query($vConexion, $SQL_UpdateReserva)) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}
