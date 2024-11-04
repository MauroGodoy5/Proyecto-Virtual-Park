<?php
function obtenerCuposDisponibles($vConexion, $id_reserva) {
    $query = "SELECT cupos FROM reservas WHERE id_reserva = $id_reserva";
    $resultado = mysqli_query($vConexion, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['cupos'];
    }

    return 0; // Por defecto, si no hay reservas encontradas o un problema en la consulta
}
?>