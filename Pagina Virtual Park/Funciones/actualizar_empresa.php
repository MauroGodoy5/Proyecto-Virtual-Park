<?php

function ActualizarEmpresa($vConexion, $idusuario_empresa, $razonSocial, $tipoEmpresa, $email, $telefono, $usuario, $contrasena)
{
    $razonSocial = mysqli_real_escape_string($vConexion, $razonSocial);
    $email = mysqli_real_escape_string($vConexion, $email);
    $telefono = mysqli_real_escape_string($vConexion, $telefono);
    $usuario = mysqli_real_escape_string($vConexion, $usuario);
    $contrasena = mysqli_real_escape_string($vConexion, $contrasena);

    $query = "UPDATE empresa e
              INNER JOIN contacto c ON e.id_contacto = c.id_contacto
              INNER JOIN usuario u ON e.id_usuario = u.id_usuario
              SET e.nombre_empresa = '$razonSocial',
                  e.id_tipoempresa = $tipoEmpresa,
                  c.email = '$email',
                  c.telefono = '$telefono',
                  u.nombre_usuario = '$usuario',
                  u.contrasena = '$contrasena'
              WHERE u.id_usuario = $idusuario_empresa";

    if (mysqli_query($vConexion, $query)) {
        return true; // La actualización fue exitosa
    } else {
        return false; // La actualización falló
    }
}
