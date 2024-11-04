<?php



function InsertarUsuarios($vConexion)
{
    $SQL_InsertContactos = "INSERT INTO contacto (telefono, email) VALUES ('" . $_POST['telefono'] . "', '" . $_POST['email'] . "')";
    if (!mysqli_query($vConexion, $SQL_InsertContactos)) {
        mysqli_rollback($vConexion);
        // Si surge un error, finaliza la ejecución del script con un mensaje
        die('<h4>Error al intentar insertar el contacto.</h4>');
    }
    $idContacto = mysqli_insert_id($vConexion);

    $SQL_InsertUsuario = "INSERT INTO usuario (nombre_usuario, contrasena, id_tipousuario) VALUES ('" . $_POST['Usuario'] . "', '" . $_POST['contrasena'] . "', 3)";
    if (!mysqli_query($vConexion, $SQL_InsertUsuario)) {
        mysqli_rollback($vConexion);
        // Si surge un error, finaliza la ejecución del script con un mensaje
        die('<h4>Error al intentar insertar el usuario.</h4>');
    }
    $idUsuario = mysqli_insert_id($vConexion);

    $SQL_InsertDomicilio = "INSERT INTO domicilio (calle, numero, piso, depto, barrio, id_ciudad, id_provincia) VALUES ('" . $_POST['Calle'] . "', '" . $_POST['numero'] . "', '" . $_POST['Piso'] . "', '" . $_POST['Depto'] . "', '" . $_POST['barrio'] . "', '" . $_POST['ciudades'] . "', '" . $_POST['Provincias'] . "')";
    if (!mysqli_query($vConexion, $SQL_InsertDomicilio)) {
        mysqli_rollback($vConexion);
        // Si surge un error, finaliza la ejecución del script con un mensaje
        die('<h4>Error al intentar insertar el Domicilio.</h4>');
    }
    $idDomicilio = mysqli_insert_id($vConexion);

    $SQL_InsertPersona = "INSERT INTO personas (nombre, apellido, id_usuario, id_domicilio, id_contacto) VALUES ('" . $_POST['Nombre'] . "', '" . $_POST['Apellido'] . "', $idUsuario, $idDomicilio, $idContacto)";
    if (!mysqli_query($vConexion, $SQL_InsertPersona)) {
        mysqli_rollback($vConexion);
        // Si surge un error, finaliza la ejecución del script con un mensaje
        die('<h4>Error al intentar insertar la persona.</h4>');
    }

    return true;
}


?>