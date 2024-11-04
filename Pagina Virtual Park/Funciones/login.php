<?php 


function DatosLogin($vUsuario, $vClave, $vConexion) {
    $Usuario = array();

    $SQL = "SELECT usuario.id_usuario, usuario.nombre_usuario, usuario.contrasena, usuario.id_tipousuario, tipousuario.descripcion as nombre_tipousuario
            FROM usuario 
            JOIN tipousuario ON usuario.id_tipousuario = tipousuario.id_tipousuario
            WHERE usuario.nombre_usuario = '$vUsuario' AND usuario.contrasena = '$vClave'";

    $rs = mysqli_query($vConexion, $SQL);
    $data = mysqli_fetch_array($rs);

    if (!empty($data)) {
        $Usuario['ID'] = $data['id_usuario'];
        $Usuario['NOMBRE'] = $data['nombre_usuario'];
        $Usuario['CONTRASEÑA'] = $data['contrasena'];
        $Usuario['NIVEL'] = $data['id_tipousuario'];
        $Usuario['NOMBRE_NIVEL'] = $data['nombre_tipousuario'];
    }

    return $Usuario;
}


?>