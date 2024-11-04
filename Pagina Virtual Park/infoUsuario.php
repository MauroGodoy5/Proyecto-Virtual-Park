<?php 
session_start();

//si tengo vacio mi elemento de sesion me tiene q redireccionar al login.. 
//al cerrarsesion para que mate todo de la sesion y el se encarga de ubicar en el login
if (empty($_SESSION['Usuario_Nombre']) ) {
    header('Location: cerrarsesion.php');
    exit;
}

require_once 'Funciones/conexion.php';
$MiConexion = ConexionBD();

require_once 'Funciones/seleccionar_informacion.php';

$informaciones = seleccionarInformacion($MiConexion);

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<link rel="stylesheet" href="../Pagina Virtual Park/css/estilos.css" type="text/css">
	<link rel="stylesheet" href="../Pagina Virtual Park/css/infousuario.css" type="text/css">
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="Virtual Park - Organización de eventos de gaming y esports">
	<meta name="keywords" content="Virtual Park, gaming, esports, eventos, stands, entradas">
	<meta name="author" content="Virtual Park">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<title>Informacion-VirtualPark</title>
</head>

<body>
	<?php
	require_once 'Seccionado/encabezado-menu.php';
	?>


<div class="contenido">
    <section class="contInfo">
        <?php foreach ($informaciones as $informacion): ?>
            <div class="notificacion-box">
                <h2>S&Eacute PARTICIPE DE NUESTRA PR&OacuteXIMA EDICI&OacuteN</h2> <p><?php echo $informacion['fecha_carga']; ?></p>
                <h3>
                    <p>A partir del dia : <?php echo $informacion['fecha']; ?></p>
                    <p> A las : <?php echo $informacion['hora']; ?></p>
                    <p> en este lugar : <?php echo $informacion['lugar']; ?></p>
                </h3>
                <p class="desc-info"><?php echo $informacion['descInfo']; ?></p>
            </div>
        <?php endforeach; ?>
    </section>
</div>


	<?php
	require_once 'Seccionado/footer.php';

	?>

</body>

</html>