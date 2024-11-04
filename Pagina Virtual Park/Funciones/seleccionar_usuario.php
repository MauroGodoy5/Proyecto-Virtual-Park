<?php
function SeleccionarUsuario($vConexion, $idUsuario)
{
    $Usuario = array();
    
    $SQL = "SELECT p.nombre, p.apellido, u.nombre_usuario, u.contrasena, c.email, c.telefono, d.calle, d.numero, d.piso, d.depto, d.barrio, d.id_ciudad, d.id_provincia
            FROM personas p
            INNER JOIN usuario u ON p.id_usuario = u.id_usuario
            INNER JOIN contacto c ON p.id_contacto = c.id_contacto
            INNER JOIN domicilio d ON p.id_domicilio = d.id_domicilio
            WHERE u.id_usuario = $idUsuario";

    $rs = mysqli_query($vConexion, $SQL);
        
    $data = mysqli_fetch_array($rs);
    if (!empty($data)) {
        $Usuario['Nombre'] = $data['nombre'];
        $Usuario['Apellido'] = $data['apellido'];
        $Usuario['Usuario'] = $data['nombre_usuario'];
        $Usuario['Contraseña'] = $data['contrasena'];
        $Usuario['Email'] = $data['email'];
        $Usuario['Telefono'] = $data['telefono'];
        $Usuario['Calle'] = $data['calle'];
        $Usuario['Numero'] = $data['numero'];
        $Usuario['Piso'] = $data['piso'];
        $Usuario['Depto'] = $data['depto'];
        $Usuario['Barrio'] = $data['barrio'];
        $Usuario['Provincia'] = $data['id_provincia'];
        $Usuario['Ciudad'] = $data['id_ciudad'];
    }
    return $Usuario;
}

function SeleccionarUsuariosTabla($vConexion)
{
    $Usuarios = array();
    
    $SQL = "SELECT p.nombre, p.apellido,u.id_usuario, u.nombre_usuario, u.contrasena, c.email, c.telefono, d.calle, d.numero, d.piso, d.depto, d.barrio, d.id_ciudad, d.id_provincia
            FROM personas p
            INNER JOIN usuario u ON p.id_usuario = u.id_usuario
            INNER JOIN contacto c ON p.id_contacto = c.id_contacto
            INNER JOIN domicilio d ON p.id_domicilio = d.id_domicilio
            WHERE u.id_tipousuario = 3"; // Cambia el 3 por el ID correspondiente al tipo "usuario"

    $rs = mysqli_query($vConexion, $SQL);
        
    while ($data = mysqli_fetch_array($rs)) {
        $Usuario = array();
        $Usuario['id'] = $data['id_usuario'];
        $Usuario['Nombre'] = $data['nombre'];
        $Usuario['Apellido'] = $data['apellido'];
        $Usuario['Usuario'] = $data['nombre_usuario'];
        $Usuario['Contraseña'] = $data['contrasena'];
        $Usuario['Email'] = $data['email'];
        $Usuario['Telefono'] = $data['telefono'];
        $Usuario['Calle'] = $data['calle'];
        $Usuario['Numero'] = $data['numero'];
        $Usuario['Piso'] = $data['piso'];
        $Usuario['Depto'] = $data['depto'];
        $Usuario['Barrio'] = $data['barrio'];
        $Usuario['Provincia'] = $data['id_provincia'];
        $Usuario['Ciudad'] = $data['id_ciudad'];
        
        $Usuarios[] = $Usuario;
    }
    return $Usuarios;
}
?>

