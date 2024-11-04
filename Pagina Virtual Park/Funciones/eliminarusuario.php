<?php
function EliminarUsuario($vConexion, $idUsuario)
{

    // Obtener el ID de domicilio y contacto asociado al usuario que se eliminará
    $SQL_GetIDs = "SELECT id_domicilio, id_contacto FROM personas WHERE id_usuario = $idUsuario";
    $result = mysqli_query($vConexion, $SQL_GetIDs);
    $data = mysqli_fetch_assoc($result);
    
    $idDomicilio = $data['id_domicilio'];
    $idContacto = $data['id_contacto'];

    // Eliminar la persona
    $SQL_DeletePersona = "DELETE FROM personas WHERE id_usuario = $idUsuario";
    if (!mysqli_query($vConexion, $SQL_DeletePersona)) {
        mysqli_rollback($vConexion);
        die('<h4>Error al intentar eliminar la persona.</h4>');
    }

    // Eliminar el domicilio asociado al usuario
    $SQL_DeleteDomicilio = "DELETE FROM domicilio WHERE id_domicilio = $idDomicilio";
    if (!mysqli_query($vConexion, $SQL_DeleteDomicilio)) {
        mysqli_rollback($vConexion);
        die('<h4>Error al intentar eliminar el domicilio.</h4>');
    }

    // Eliminar el contacto asociado al usuario
    $SQL_DeleteContacto = "DELETE FROM contacto WHERE id_contacto = $idContacto";
    if (!mysqli_query($vConexion, $SQL_DeleteContacto)) {
        mysqli_rollback($vConexion);
        die('<h4>Error al intentar eliminar el contacto.</h4>');
    }

    // Finalmente, eliminar el usuario
    $SQL_DeleteUsuario = "DELETE FROM usuario WHERE id_usuario = $idUsuario";
    if (!mysqli_query($vConexion, $SQL_DeleteUsuario)) {
        mysqli_rollback($vConexion);
        die('<h4>Error al intentar eliminar el usuario.</h4>');
    }

    return true;
}
