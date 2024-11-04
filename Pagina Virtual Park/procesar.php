<?php
session_start(); // Continuar la sesión

if (isset($_POST['urlInput'])) {
    $url = $_POST['urlInput'];

    // Almacenar la URL en un archivo (o base de datos)
    $usuarioActual = $_SESSION['Usuario_Nombre'];
    file_put_contents("urls.txt", "$usuarioActual|$url\n", FILE_APPEND);

    $_SESSION['url'] = $url;
}

header("Location: entradas.php"); // Redirigir a entradas.php
exit();
?>