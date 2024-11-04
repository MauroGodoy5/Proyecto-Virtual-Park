<?php
session_start();

//si tengo vacio mi elemento de sesion me tiene q redireccionar al login.. 
//al cerrarsesion para que mate todo de la sesion y el se encarga de ubicar en el login
if (empty($_SESSION['Usuario_Nombre'])) {
    header('Location: cerrarsesion.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../Pagina Virtual Park/css/estilos.css" type="text/css">
    <link rel="stylesheet" href="../Pagina Virtual Park/css/entradas.css" type="text/css">
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
<div class="section">
        <h2>ENTRADAS</h2>

        <section id="entradas">
    <h2>Cómo comprar una entrada para VP</h2>
    <p>Sigue estos pasos:</p>
    <ul>
        <li><strong>Info: </strong> El siguiente boton contiene una Url que te reedijira a la pagina para comprar tus entradas</li>
        <li><strong>Paso 1:</strong> Darle click al boton Entradas</li>
        <li><strong>Paso 2:</strong> Completa el formulario de comprar para adquirri tus entradas.</li>
        <li><strong>Paso 3:</strong> Una vez completado el formulario, haz clic en "Confirmar Compra".</li>
        <li><strong>Paso 4:</strong> Recibirás una confirmación de tu Compra de las entradas por correo electrónico.</li>
    </ul>
    <p>¡Listo! Ahora seras parte de la proxima edicion de Virtual Park!!</p>

    </section>
        <?php
            // Mostrar el botón con la última URL almacenada
            $usuarioActual = $_SESSION['Usuario_Nombre'];
            $urls = file("urls.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            // Buscar la última URL para el usuario actual
            $url = '';
            foreach ($urls as $line) {
                list($usuario, $url) = explode('|', $line);
                if ($usuario == $usuarioActual) {
                    $url = trim($url);
                }
            }

            if (!empty($url)) {
                echo "<a href='$url' target='_blank'><button>Ir a la URL</button></a>";
            }
        ?>
    </div>

    

    <?php
    require_once 'Seccionado/footer.php';

    ?>

</body>

</html>