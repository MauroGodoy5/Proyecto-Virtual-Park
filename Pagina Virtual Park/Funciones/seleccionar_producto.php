<?php
function seleccionarProductos($vConexion)
{
    $productos = array();

    // Realiza la consulta para seleccionar los productos
    $consulta = "SELECT id_producto, titulo, descripcion, id_empresa, ruta_imagen FROM productos";
    $resultado = mysqli_query($vConexion, $consulta);

    if ($resultado) {
        // Recorre los resultados y almacena los productos en un array
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $productos[] = $fila;
        }

        // Libera el resultado
        mysqli_free_result($resultado);
    } else {
        // Maneja el error según tus necesidades
        die('<h4>Error al seleccionar productos</h4>');
    }

    return $productos;
}
function obtenerNombreEmpresa($vConexion, $id_empresa)
{
    $consulta = "SELECT nombre_empresa FROM empresa WHERE id_empresa = $id_empresa";
    $resultado = mysqli_query($vConexion, $consulta);

    if ($resultado && $fila = mysqli_fetch_assoc($resultado)) {
        return $fila['nombre_empresa'];
    } else {
        return "Empresa Desconocida";
    }
}
