<?php
function seleccionarEdiciones($conexion)
{
    $ediciones = array();

    // Realiza la consulta para seleccionar todas las ediciones
    $sql_seleccionar = "SELECT *, DATE_FORMAT(fecha_hora, '%d/%m/%Y') AS fecha_hora_formato FROM ediciones";
    $resultado_seleccionar = mysqli_query($conexion, $sql_seleccionar);

    if ($resultado_seleccionar) {
        // Recorre los resultados y almacena las ediciones en un array
        while ($fila = mysqli_fetch_assoc($resultado_seleccionar)) {
            // Modificar el formato de la fecha a DD/MM/AAAA HH:MM
            $fila['fecha_hora_formato'] = date('d/m/Y', strtotime($fila['fecha_hora']));

            // Almacenar la fila modificada en el array de ediciones
            $ediciones[] = $fila;
        }

        // Liberar el resultado
        mysqli_free_result($resultado_seleccionar);
    } else {
        // Maneja el error según tus necesidades
        die('<h4>Error al seleccionar ediciones</h4>');
    }

    return $ediciones;
}
?>
