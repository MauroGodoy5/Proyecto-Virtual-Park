<?php
function Listar_info($vConexion) {

    $Listado=array();

    //1) genero la consulta que deseo
    $SQL = "SELECT * FROM informacion
			ORDER BY fecha_carga DESC
			LIMIT 1;";

    //2) a la conexion actual le brindo mi consulta, y el resultado lo entrego a variable $rs
     $rs = mysqli_query($vConexion, $SQL);
        
     //3) el resultado deber� organizarse en una matriz, entonces lo recorro
     $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['ID_EVENTO'] = $data['id_informacion'];
            $Listado[$i]['NOMBRE'] = $data['nombre'];
            $Listado[$i]['FECHA'] = $data['fecha'];
            $Listado[$i]['HORA'] = $data['hora'];
            $Listado[$i]['LUGAR'] = $data['lugar'];
			$Listado[$i]['ID_USUARIO'] = $data['id_usuario'];
            $Listado[$i]['TITULOINFO'] = $data['tituloInfo'];
            $Listado[$i]['DESCINFO'] = $data['descInfo'];
			$Listado[$i]['FECHA_CARGA'] = $data['fecha_carga'];
            $i++;
    }

    //devuelvo el listado generado en el array $Listado. (Podra salir vacio o con datos)..
    return $Listado;
	
}

?>