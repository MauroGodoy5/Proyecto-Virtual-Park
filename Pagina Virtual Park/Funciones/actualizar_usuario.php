<?php
function ActualizarUsuario($vConexion, $idusuario_empresa, $nombre, $apellido, $usuario, $contrasena, $email, $telefono, $calle, $numero, $piso, $depto, $barrio, $idCiudad, $idProvincia)
{
    $nombre = mysqli_real_escape_string($vConexion, $nombre);
    $apellido = mysqli_real_escape_string($vConexion, $apellido);
    $usuario = mysqli_real_escape_string($vConexion, $usuario);
    $contrasena = mysqli_real_escape_string($vConexion, $contrasena);
    $email = mysqli_real_escape_string($vConexion, $email);
    $telefono = mysqli_real_escape_string($vConexion, $telefono);
    $calle = mysqli_real_escape_string($vConexion, $calle);
    $numero = mysqli_real_escape_string($vConexion, $numero);
    $piso = mysqli_real_escape_string($vConexion, $piso);
    $depto = mysqli_real_escape_string($vConexion, $depto);
    $barrio = mysqli_real_escape_string($vConexion, $barrio);

    $query = "UPDATE personas p
              INNER JOIN usuario u ON p.id_usuario = u.id_usuario
              INNER JOIN contacto c ON p.id_contacto = c.id_contacto
              INNER JOIN domicilio d ON p.id_domicilio = d.id_domicilio
              SET p.nombre = '$nombre', 
                  p.apellido = '$apellido', 
                  u.nombre_usuario = '$usuario', 
                  u.contrasena = '$contrasena', 
                  c.email = '$email', 
                  c.telefono = '$telefono', 
                  d.calle = '$calle', 
                  d.numero = '$numero', 
                  d.piso = '$piso', 
                  d.depto = '$depto', 
                  d.barrio = '$barrio', 
                  d.id_ciudad = $idCiudad, 
                  d.id_provincia = $idProvincia
              WHERE u.id_usuario = $idusuario_empresa";

    if (mysqli_query($vConexion, $query)) {
        return true; // La actualización fue exitosa
    } else {
        return false; // La actualización falló
    }
}
