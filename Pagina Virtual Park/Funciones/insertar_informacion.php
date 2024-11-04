<?php

function insertar_informacion($vConexion)
{
	
	$SQL_InsertEvento = "INSERT INTO informacion (nombre, fecha, hora, lugar, id_usuario, tituloInfo, descInfo) 
						  VALUES ('" . $_POST['descEvento'] . "', '" . $_POST['fechaEvento'] . "',
									'" . $_POST['horaEvento'] . "','" . $_POST['lugarEvento'] . "', 4,
									'" . $_POST['titInfo'] . "','" . $_POST['descInfo'] . "')";
    if (!mysqli_query($vConexion, $SQL_InsertEvento)) {
        mysqli_rollback($vConexion);
        // Si surge un error, finaliza la ejecución del script con un mensaje
        die('<h4>Error al cargar la informacion</h4>');
    }
    $idUsuario = mysqli_insert_id($vConexion);
    return true;
}


?>