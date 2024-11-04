<?php
function obtenerReservasEmpresa($conexion) {
    $query = "SELECT re.*, e.nombre_empresa, r.titulo AS titulo_reserva, c.telefono 
          FROM reservas_empresa re 
          INNER JOIN empresa e ON re.id_empresa = e.id_empresa
          INNER JOIN reservas r ON re.id_reserva = r.id_reserva
          INNER JOIN contacto c ON e.id_contacto = c.id_contacto";

    $result = mysqli_query($conexion, $query);

    $reservasempresas = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $reservasempresas[] = $row;
        }
        mysqli_free_result($result);
    }

    return $reservasempresas;
}


?>