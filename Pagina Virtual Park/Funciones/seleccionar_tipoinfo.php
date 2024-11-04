<?php
function mostrarTipoInfo($vConexion) 
{
    $SQL_SelectTipoInfo = "SELECT * FROM tipoinfo";
    $resultado_mostrarTipoInfo = mysqli_query($vConexion, $SQL_SelectTipoInfo);

    $TipoInfo = [];

    if ($resultado_mostrarTipoInfo && mysqli_num_rows($resultado_mostrarTipoInfo) > 0) 
	{
        while ($fila = mysqli_fetch_assoc($resultado_mostrarTipoInfo)) 
		{
            $TipoInfo[] = $fila;
        }
        mysqli_free_result($resultado_mostrarTipoInfo);
    }

    return $TipoInfo;
}
function obtenerTipoInfo($vConexion, $id_tipoinfo)
{
	$consulta_TipoInfo = "SELECT descrpcion FROM tipoinfo WHERE id_tipoinfo = $id_tipoinfo";
    $resultado_obtenerTipoInfo = mysqli_query($vConexion, $consulta_TipoInfo);

    if ($resultado_obtenerTipoInfo && $fila = mysqli_fetch_assoc($resultado_obtenerTipoInfo)) 
	{
        return $fila['descripcion'];
    } 
}
?>