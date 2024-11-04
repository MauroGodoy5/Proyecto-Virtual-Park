<?php 
session_start();

require_once 'Funciones/conexion.php';
$MiConexion = ConexionBD();

$Mensaje = '';
if (!empty($_POST['BotonLogin'])) {
    require_once 'Funciones/login.php';
    $UsuarioLogueado = DatosLogin($_POST['usuario'], $_POST['password'], $MiConexion);

    if (!empty($UsuarioLogueado)) {
        $_SESSION['ID'] = $UsuarioLogueado['ID'];
        $_SESSION['Usuario_Nombre'] = $UsuarioLogueado['NOMBRE'];
        $_SESSION['Usuario_contraseña'] = $UsuarioLogueado['CONTRASEÑA'];
        $_SESSION['Usuario_Nivel'] = $UsuarioLogueado['NIVEL'];
        $_SESSION['Usuario_Nombre_Nivel'] = $UsuarioLogueado['NOMBRE_NIVEL'];

        if ($UsuarioLogueado['NIVEL'] == 2 || $UsuarioLogueado['NIVEL'] == 1) {
            header('Location: index.php');
            exit;
        } else if ($UsuarioLogueado['NIVEL'] == 3 || $UsuarioLogueado['NIVEL'] == 4) {
            header('Location: index.php');
            exit;
        } else {
            header('Location: index.php');
            exit;
        }
    } else {
        $Mensajeerror = 'Datos incorrectos, ingresa nuevamente.';
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Virtual Park</title>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <link rel="stylesheet" type="text/css" href="../Pagina Virtual Park/css/login.css" >

    <link
        href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


</head>


<body>
    <h1>Virtual Park</h1>
    <div class=" w3l-login-form">
        <h2>Iniciar Sesion</h2>
        <div id="mensaje" class="mensaje-error <?php if (isset($Mensajeerror)) echo 'mostrar'; ?>">
				<?php
				// Muestra el mensaje si está definido
				if (isset($Mensajeerror)) {
					echo $Mensajeerror;
				}
				?>
			</div>
        <form role="form" method="POST">

            <div class=" w3l-form-group">
                <label>Usuario:</label>
                <div class="group">

                    <input type="text" class="form-control" placeholder="Nombre de usuario" required="required"
                        name="usuario" />
                </div>
            </div>
            <div class=" w3l-form-group">
                <label>Contraseña:</label>
                <div class="group">

                    <input type="password" class="form-control" placeholder="Contraseña" required="required"
                        name="password" />
                </div>
            </div>
            <div class="forgot">
                <a href="#">Olvidaste tu contraseña?</a>
            </div>
            <button type="submit" value="Login" name="BotonLogin">Ingresar</button>
        </form>
        <p class=" w3l-register-p">Todavia no te registraste?</p>
        <a href="preregistro.html"><button type="submit">Registrar</button></a>
    </div>
    <footer>
        <p class="copyright-agileinfo"> &copy; 2023 Todos los derechos Reservados</p>
    </footer>

</body>

</html>