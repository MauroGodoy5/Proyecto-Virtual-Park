<?php
function eliminarReserva($vConexion, $id_reserva) {
    $SQL_DeleteReserva = "DELETE FROM reservas WHERE id_reserva = $id_reserva";
    if (!mysqli_query($vConexion, $SQL_DeleteReserva)) {
        mysqli_rollback($vConexion);
        // Si hay un error, termina la ejecución con un mensaje
        die('<h4>Error al eliminar la reserva</h4>');
    }
    return true;
}