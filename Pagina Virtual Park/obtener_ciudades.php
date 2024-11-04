<?php
require_once 'Funciones/conexion.php';

// Establece la cabecera HTTP para indicar que la respuesta es JSON
header('Content-Type: application/json');

// Verifica si se proporcionó un ID de provincia válido
if (isset($_POST['provincia_id'])) {
    $provinciaId = $_POST['provincia_id'];
    
    // Conecta a la base de datos
    $conexion = ConexionBD();
    mysqli_set_charset($conexion, "utf8");
    // Consulta SQL para obtener las ciudades de la provincia seleccionada
    $sql = "SELECT * FROM ciudad WHERE id_provincia = " . $provinciaId;
    
    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado) {
        $ciudades = array();

        // Recopila los datos de las ciudades
        while ($ciudad = mysqli_fetch_assoc($resultado)) {
            $ciudades[] = $ciudad;
        }
        
        // Devuelve las ciudades como respuesta en formato JSON
        echo json_encode($ciudades);
    } else {
        // Manejo de errores si la consulta falla
        echo json_encode(array('error' => 'Error en la consulta SQL'));
    }
} else {
    // Manejo de errores si no se proporciona un ID de provincia
    echo json_encode(array('error' => 'ID de provincia no válido'));
}


?>