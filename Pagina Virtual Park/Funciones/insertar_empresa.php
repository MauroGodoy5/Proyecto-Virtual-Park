<?php
function InsertarEmpresa($vConexion){
    $SQL_InsertContactos = "INSERT INTO contacto (telefono, email) VALUES ('" . $_POST['telefono'] . "', '" . $_POST['email'] . "')";
    if (!mysqli_query($vConexion, $SQL_InsertContactos)) {
        mysqli_rollback($vConexion);
        // Si surge un error, finaliza la ejecución del script con un mensaje
        die('<h4>Error al intentar insertar el contacto.</h4>');
    }
    $idContacto = mysqli_insert_id($vConexion);

    $SQL_InsertUsuario = "INSERT INTO usuario (nombre_usuario, contrasena, id_tipousuario) VALUES ('" . $_POST['Usuario'] . "', '" . $_POST['contrasena'] . "', 4)";
    if (!mysqli_query($vConexion, $SQL_InsertUsuario)) {
        mysqli_rollback($vConexion);
        // Si surge un error, finaliza la ejecución del script con un mensaje
        die('<h4>Error al intentar insertar el usuario.</h4>');
    }
    $idUsuario = mysqli_insert_id($vConexion);

    $SQL_InsertEmpresa = "INSERT INTO empresa (nombre_empresa, id_tipoempresa, id_contacto, id_usuario) VALUES ('" . $_POST['RazonSocial'] . "', '" . $_POST['tipoempresa'] . "', $idContacto, $idUsuario)";
    if (!mysqli_query($vConexion, $SQL_InsertEmpresa)) {
        mysqli_rollback($vConexion);
        // Si surge un error, finaliza la ejecución del script con un mensaje
        die('<h4>Error al intentar insertar el usuario.</h4>');
    }
    
    return true;


}

?>