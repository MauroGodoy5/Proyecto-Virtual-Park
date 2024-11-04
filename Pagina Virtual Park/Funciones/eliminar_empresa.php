<?php
function EliminarEmpresa($vConexion, $idEmpresa)
{
    // Obtener el ID de contacto asociado a la empresa
    $SQL_GetContacto = "SELECT id_contacto FROM empresa WHERE id_empresa = $idEmpresa";
    $resultContacto = mysqli_query($vConexion, $SQL_GetContacto);
    $dataContacto = mysqli_fetch_assoc($resultContacto);
    $idContacto = $dataContacto['id_contacto'];

    $SQL_GetUsuario = "SELECT id_usuario FROM empresa WHERE id_empresa = $idEmpresa";
    $resultUsuario = mysqli_query($vConexion, $SQL_GetUsuario);
    $dataUsuario = mysqli_fetch_assoc($resultUsuario);
    $idUsuario = $dataUsuario['id_usuario'];

    // Eliminar la empresa
    $SQL_DeleteEmpresa = "DELETE FROM empresa WHERE id_empresa = $idEmpresa";
    if (!mysqli_query($vConexion, $SQL_DeleteEmpresa)) {
        mysqli_rollback($vConexion);
        die('<h4>Error al intentar eliminar la empresa.</h4>');
    }

    // Eliminar el contacto asociado a la empresa
    $SQL_DeleteContacto = "DELETE FROM contacto WHERE id_contacto = $idContacto";
    if (!mysqli_query($vConexion, $SQL_DeleteContacto)) {
        mysqli_rollback($vConexion);
        die('<h4>Error al intentar eliminar el contacto asociado a la empresa.</h4>');
    }





    // Eliminar el usuario asociado a la empresa
    $SQL_DeleteUsuario = "DELETE FROM usuario WHERE id_usuario = $idUsuario";
    if (!mysqli_query($vConexion, $SQL_DeleteUsuario)) {
        mysqli_rollback($vConexion);
        die('<h4>Error al intentar eliminar el usuario asociado a la empresa.</h4>');
    }

    return true;
}
