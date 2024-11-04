<?php
session_start();

if (empty($_SESSION['Usuario_Nombre'])) {
    header('Location: cerrarsesion.php');
    exit;
}

require_once 'Funciones/conexion.php';
$Miconexion = ConexionBD();
require_once 'Funciones/seleccionar_reservas.php';
require_once 'Funciones/seleccionar_empresa.php';
require_once 'Funciones/validar_cupos.php';
$id_usuario = $_SESSION['ID'];
$id_empresa = SeleccionarEmpresaPorUsuario($Miconexion, $id_usuario);
$_SESSION['id_empresa'] = $id_empresa['id_empresa'];

$mensaje = '';

if (isset($_POST['reservar'])) {
    $id_reserva = $_POST['id_reserva']; // Obtener el ID de la reserva desde el formulario
    $cupos_disponibles = obtenerCuposDisponibles($Miconexion, $id_reserva);

    if ($cupos_disponibles > 0) {
        // La reserva tiene cupos disponibles
        // Verifica si la cantidad de cupos que se desea reservar no excede los disponibles
        $cantidad_reserva = 1; // Cambia esto según cómo manejes la cantidad a reservar

        if ($cantidad_reserva <= $cupos_disponibles) {
            // Realizar la reserva
            $query_insert_reserva = "INSERT INTO reservas_empresa (id_empresa, id_reserva) VALUES ('$_SESSION[id_empresa]', '$id_reserva')";

            if (mysqli_query($Miconexion, $query_insert_reserva)) {
                // Actualizar la cantidad de cupos disponibles restando la cantidad reservada
                $query_update_cupos = "UPDATE reservas SET cupos = cupos - $cantidad_reserva WHERE id_reserva = '$id_reserva'";
                mysqli_query($Miconexion, $query_update_cupos);

                $_SESSION['reserva_exitosa'] = true;
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Error al realizar la reserva: " . mysqli_error($Miconexion);
            }
        } else {
            echo "La cantidad de cupos que deseas reservar excede los disponibles.";
        }
    } else {
        $mensajeerror= "No hay cupos disponibles para esta reserva.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Pagina Virtual Park/css/estilos.css" type="text/css">
    <link rel="stylesheet" href="../Pagina Virtual Park/css/servicios.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
    <script>
    function confirmarReserva() {
        return confirm('¿Estás seguro de que deseas hacer una reserva?');
    }
</script>
</head>
<body>
<?php require_once 'Seccionado/encabezado-menu.php'; ?>
	
	
    <section id="como-reservar">
    <h2>Cómo reservar un stand o servicio</h2>
    <p>Reservar un stand o servicio en nuestra página es fácil y rápido. Sigue estos pasos:</p>
    <ol>
        <li><strong>Paso 1:</strong> Explora los stands y servicios disponibles en nuestra página de servicios.</li>
        <li><strong>Paso 2:</strong> Haz clic en el botón "Reservar" del stand o servicio que te interese.</li>
        <li><strong>Paso 3:</strong> Una vez que hagas click en el stando espacio de tu preferecia se guardaran los datos para ponernos en contacto contigo en las proximas 48hrs.</li>
        <li><strong>Paso 4:</strong> Luego se coordinara formas de pago y fehca del mismo.</li>
        <li><strong>Paso 5:</strong> por ultimo una vez reservado el stand te pediremos los productos que quieras publicitar en la pagina para cargarlos.</li>
    </ol>
    <p>¡Listo! Ahora estarás reservando un stand o espacio en nuestra página. Si necesitas ayuda adicional, no dudes en contactarnos.</p>

    </section>

    <div class="contenedor-cuadros">
    <?php
    // Llamar a la función para obtener las reservas
    $reservas = seleccionarReservasTabla($Miconexion);

    // Mostrar las reservas en los cuadros
    foreach ($reservas as $reserva):
    ?>
        <article class="cuadro-reserva <?php echo ($reserva['cupos'] == 0) ? 'sin-cupos' : ''; ?>">
            <!-- Aquí está el input con el ID de la empresa -->
            <input type="hidden" name="id_empresa" value="<?php echo $id_empresa['id_empresa']; ?>">

            <h2><?php echo $reserva['titulo']; ?></h2>
            <p>Descripcion: <?php echo $reserva['descripcion']; ?></p>
            <p>Disponibilidad: <?php echo $reserva['cupos']; ?></p>
            <p>Precio: $<?php echo $reserva['precio']; ?></p>
            <!-- Otros detalles de la reserva -->

            <form method="POST" >
                <!-- Se ha añadido el input con el ID de la reserva -->
                <input type="hidden" name="id_reserva" value="<?php echo $reserva['id_reserva']; ?>">
                <!-- Se ha corregido el name del botón para identificarlo -->
                <button type="submit" name="reservar"onclick="return confirmarReserva()">Reservar</button>
            </form>
        </article>
    <?php endforeach; ?>
</div>
</div>
<div id="mensaje" class="mensaje-exito <?php if (isset($_SESSION['reserva_exitosa']) && $_SESSION['reserva_exitosa'] === true) echo 'mostrar'; ?>">
    <?php
    // Muestra el mensaje si está definido y es exitoso
    if (isset($_SESSION['reserva_exitosa']) && $_SESSION['reserva_exitosa'] === true) {
        echo "Reserva realizada con éxito para la empresa!";
        // Desactiva la indicación de reserva exitosa
        $_SESSION['reserva_exitosa'] = false;
    }
    ?>
</div>

<div id="mensajeerror" class="mensaje-error <?php if (isset($mensajeerror)) echo 'mostrar'; ?>">
				<?php
				// Muestra el mensaje si está definido
				if (isset($mensajeerror)) {
					echo $mensajeerror;
				}
				?>
		</div>

                
<?php
	require_once 'Seccionado/footer.php';
	?>


</body>
</html>