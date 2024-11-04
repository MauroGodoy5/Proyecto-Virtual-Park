<?php
function seleccionarInformacion($vConexion)
{
    $Informacion = array();

    // Realiza la consulta para seleccionar la info
    $consulta = "SELECT id_informacion, nombre, fecha, hora, lugar, tituloInfo, descInfo, fecha_carga FROM informacion";
    $resultado = mysqli_query($vConexion, $consulta);

    if ($resultado) {
        // Recorre los resultados y almacena la info en un array
        while ($fila = mysqli_fetch_assoc($resultado)) {
            // Modificar el formato de la fecha a DD/MM/AAAA
            $fila['fecha'] = date('d/m/Y', strtotime($fila['fecha']));

            $Informacion[] = $fila;
        }

        // Libera el resultado
        mysqli_free_result($resultado);
    } else {
        // Maneja el error según tus necesidades
        die('<h4>Error al seleccionar informacion</h4>');
    }

    return $Informacion;
}
?>