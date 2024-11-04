<?php
require_once 'Funciones/conexion.php';
require_once 'Funciones/insertar_empresa.php';
$Miconexion = ConexionBD();

$sqltipoempresas = ("SELECT * FROM tipoempresa");
$datatipoempresaselect = mysqli_query($Miconexion, $sqltipoempresas);


if (isset($_POST['Registrar'])) {
    // Validar que la contraseña y su repetición sean iguales
    if ($_POST['contrasena'] !== $_POST['Rcontrasena']) {
        $mensaje = "Las contraseñas no coinciden.";
        $mensaje_tipo = 'error';
    } else {
        // Validar que la razón social y el correo electrónico no estén ya registrados
        $razonSocial = mysqli_real_escape_string($Miconexion, $_POST['RazonSocial']);
        $email = mysqli_real_escape_string($Miconexion, $_POST['email']);

        $consultaRazonSocial = "SELECT * FROM empresa WHERE nombre_empresa = '$razonSocial'";
        $resultadoRazonSocial = mysqli_query($Miconexion, $consultaRazonSocial);

        $consultaEmail = "SELECT * FROM contacto WHERE email = '$email'";
        $resultadoEmail = mysqli_query($Miconexion, $consultaEmail);

        if (mysqli_num_rows($resultadoRazonSocial) > 0) {
            $mensaje = "La razón social ya está registrada.";
            $mensaje_tipo = 'error';
        } elseif (mysqli_num_rows($resultadoEmail) > 0) {
            $mensaje = "El correo electrónico ya está registrado.";
            $mensaje_tipo = 'error';
        } else {
            // Si las validaciones son exitosas, procede con la inserción de datos en la base de datos
            if (InsertarEmpresa($Miconexion)) {
                $mensaje = "Se ha registrado correctamente.";
                $mensaje_tipo = 'exito';
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<link rel="stylesheet" href="css/Registroempresa.css" type="text/css">
	<meta charset="utf-8" />
	<link href='http://fonts.googleapis.com/css?family=Julius+Sans+One' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Registro Empresas-VirtualPark</title>
</head>

<body>
	<section class="Resp">
		<p>
		<h3>Registro para Empresas</h3>
		</p>
		<hr><br><br>
		<?php if (isset($mensaje)) {
			// Verifica si el mensaje es un mensaje de éxito o error
			if ($mensaje_tipo === 'exito') {
				echo '<div id="mensaje" class="mensaje-exito mostrar">' . $mensaje . '</div>';
			} elseif ($mensaje_tipo === 'error') {
				echo '<div id="mensaje" class="error-message mostrar">' . $mensaje . '</div>';
			}
		} ?>
		<form name="RegEsp" method="post">
			<h2 class="aclaracion">Campos Requeridos(*)</h2>
			<div>
				<label> * Razon Social:</label><br><br>
				<input type="text" name="RazonSocial" size="40" required><br><br>
				<label> * Tipo de Empresa:</label><br><br>
				<select name="tipoempresa" id="">
					<option value="">Seleccion un tipo de Empresa</option>
					<?php
					while ($Dataselect = mysqli_fetch_array($datatipoempresaselect)) {
						echo "<option value='{$Dataselect["id_tipoempresa"]}'>" . utf8_encode($Dataselect["descripcion"]) . "</option>";
					}
					?>
				</select><br><br>
				<label> * Email:</label><br><br>
				<input type="Email" name="email" size="40" required><br><br>
				<label> Telefono: </label><br><br>
				<input type="text" name="telefono" size="40" required><br><br>

			</div>
			<div>

				<label> * Usuario: </label><br><br>
				<input type="text" name="Usuario" size="40" required><br><br>
				<label> * Contrase&ntildea: </label><br><br>
				<input type="password" name="contrasena" size="40" required><br><br>
				<label> * Repetir contrase&ntildea: </label><br><br>
				<input type="password" name="Rcontrasena" size="40" required><br><br>



			</div>
			<div class="botones-container">
				<button class="botones" type="submit" name="Registrar">Registrar</button>
				<button class="botones"><a href="preregistro.html"> volver </a></button>
				<button class="botones"><a href="login.php"> Login </a></button>
			</div>
		</form>
	</section>
</body>

</html>