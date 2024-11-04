<?php 
session_start();

//si tengo vacio mi elemento de sesion me tiene q redireccionar al login.. 
//al cerrarsesion para que mate todo de la sesion y el se encarga de ubicar en el login
if (empty($_SESSION['Usuario_Nombre']) ) {
    header('Location: cerrarsesion.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<link rel="stylesheet" href="../Pagina Virtual Park/css/estilos.css" type="text/css">
	<link rel="stylesheet" href="../Pagina Virtual Park/css/ediciones.css" type="text/css">
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="Virtual Park - Organización de eventos de gaming y esports">
	<meta name="keywords" content="Virtual Park, gaming, esports, eventos, stands, entradas">
	<meta name="author" content="Virtual Park">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<title>Index-VirtualPark</title>
</head>

<body>
	<?php
	require_once 'Seccionado/encabezado-menu.php';
	?>
<div class="edicion-container">
    <?php
    // Obtener las ediciones
    require_once 'Funciones/seleccionar_edicion.php';
	require_once 'Funciones/conexion.php';
	$Miconexion = ConexionBD();
    $ediciones = seleccionarEdiciones($Miconexion);
	 // Invertir el orden de las ediciones
	 $ediciones = array_reverse($ediciones);
    // Mostrar las ediciones
    foreach ($ediciones as $edicion) {
        echo '<div class="edicion-box">';
        echo '<img src="' . $edicion['foto'] . '" alt="' . $edicion['titulo'] . '">';
        echo '<h2>' . $edicion['titulo'] . '</h2>';
        echo '<p>' . $edicion['descripcion'] . '</p>';
		echo '<p class="fecha">Fecha Publicacion: ' . $edicion['fecha_hora_formato'] . '</p>'; // Mostrar la fecha y hora de carga formateada
        echo '<p class="ubicacion">' . $edicion['ubicacion'] . '</p>';
        echo '</div>';
    }
    ?>
</div>

	
	

	<?php
	require_once 'Seccionado/footer.php';

	?>

</body>

</html>