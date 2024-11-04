<?php
function seleccionarReservasTabla($vConexion) {
    $SQL_SelectReservas = "SELECT * FROM reservas";
    $resultado_reservas = mysqli_query($vConexion, $SQL_SelectReservas);

    $reservas = [];

    if ($resultado_reservas && mysqli_num_rows($resultado_reservas) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado_reservas)) {
            $reservas[] = $fila;
        }
        mysqli_free_result($resultado_reservas);
    }

    return $reservas;
}

?>