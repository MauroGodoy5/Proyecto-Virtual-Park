<?php

    function SeleccionarEmpresaPorUsuario($vConexion, $idUsuario) {
        $SQL_SelectEmpresa = "SELECT e.id_empresa, e.nombre_empresa, e.id_tipoempresa, c.telefono, c.email, u.nombre_usuario, u.contrasena 
                              FROM empresa e
                              INNER JOIN contacto c ON e.id_contacto = c.id_contacto
                              INNER JOIN usuario u ON e.id_usuario = u.id_usuario
                              WHERE u.id_usuario = $idUsuario";
    
        $result = mysqli_query($vConexion, $SQL_SelectEmpresa);
    
        if (!$result) {
            return null;
        }
    
        return mysqli_fetch_assoc($result);
    }

    function SeleccionarEmpresaTabla($vConexion) {
        $SQL_SelectEmpresas = "SELECT e.id_empresa, e.id_usuario AS id_usuario_empresa, e.nombre_empresa, e.id_tipoempresa, c.telefono, c.email, u.id_usuario, u.nombre_usuario, u.contrasena 
                        FROM empresa e
                        INNER JOIN contacto c ON e.id_contacto = c.id_contacto
                        INNER JOIN usuario u ON e.id_usuario = u.id_usuario";

        $result = mysqli_query($vConexion, $SQL_SelectEmpresas);
    
        if (!$result) {
            return null;
        }
    
        $usuariosEmpresa = array();
    
        while ($row = mysqli_fetch_assoc($result)) {
            $usuariosEmpresa[] = $row;
        }
        return $usuariosEmpresa;
    }

?>