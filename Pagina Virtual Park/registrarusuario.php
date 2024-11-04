<?php
require_once 'Funciones/conexion.php';
require_once 'Funciones/insertar_usuario.php';
$Miconexion = ConexionBD();

$Sqlprovincias = ("SELECT * FROM provincia");

$Dataprovinciasselect = mysqli_query($Miconexion, $Sqlprovincias);

$Sqlciudades = ("SELECT * FROM ciudad ");

$Dataciudadesselect = mysqli_query($Miconexion, $Sqlciudades);


if (isset($_POST['Registrar'])) {
    // Validar que la contraseña y su repetición sean iguales
    if ($_POST['contrasena'] !== $_POST['Rcontrasena']) {
        $mensaje = "Las contraseñas no coinciden.";
        $mensaje_tipo = 'error'; // Configurar mensaje tipo error
    } else {
        // Validar que el nombre de usuario y el correo electrónico no estén ya registrados
        $nombreUsuario = mysqli_real_escape_string($Miconexion, $_POST['Usuario']);
        $email = mysqli_real_escape_string($Miconexion, $_POST['email']);

        $consultaUsuario = "SELECT * FROM usuario WHERE nombre_usuario = '$nombreUsuario'";
        $resultadoUsuario = mysqli_query($Miconexion, $consultaUsuario);

        $consultaEmail = "SELECT * FROM contacto WHERE email = '$email'";
        $resultadoEmail = mysqli_query($Miconexion, $consultaEmail);

        if (mysqli_num_rows($resultadoUsuario) > 0) {
            $mensaje = "El nombre de usuario ya está registrado.";
            $mensaje_tipo = 'error'; // Configurar mensaje tipo error
        } elseif (mysqli_num_rows($resultadoEmail) > 0) {
            $mensaje = "El correo electrónico ya está registrado.";
            $mensaje_tipo = 'error'; // Configurar mensaje tipo error
        } else {
            // Si las validaciones son exitosas, procede con la inserción de datos en la base de datos
            if (InsertarUsuarios($Miconexion)) {
                $mensaje = "Se ha registrado correctamente. Vuelva al login.";
                $mensaje_tipo = 'exito'; // Configurar mensaje tipo éxito
            }
        }
    }
}



?>
<!DOCTYPE html>
<html lang="es">

<head>
	<link rel="stylesheet" type="text/css" href="../Pagina Virtual Park/css/Registrousuarios.css">
	<meta charset="utf-8" />
	<link href='http://fonts.googleapis.com/css?family=Julius+Sans+One' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Registro Usuarios-VirtualPark</title>
</head>

<body>
	<script src="./js/code.jquery.com_jquery-3.7.1.min.js"></script>
	<main class="Resp">
		<p>
		<h3>Registro para Usuarios</h3>
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
		<form name="RegEsp" method="POST">
		<h2 class="aclaracion">Campos Requeridos(*)</h2>
			<div>
				<label> * Nombre: </label><br><br>
				<input type="text" name="Nombre" required><br><br>

				<label> * Apellido: </label><br><br>
				<input type="text" name="Apellido" required><br><br>

				<label> * Usuario: </label><br><br>
				<input type="text" name="Usuario" required><br><br>

				<label> * Contrase&ntildea: </label><br><br>
				<input type="password" name="contrasena" required><br><br>

				<label> * Repetir contrase&ntildea: </label><br><br>
				<input type="password" name="Rcontrasena" required><br><br>

				<label> * Email:</label><br><br>
				<input type="Email" name="email" required><br><br>
				
				<label> Telefono: </label><br><br>
				<input type="text" name="telefono" required><br><br>

			</div>
			<div>
				<label> * Provincia: </label><br><br>
				<select name="Provincias" id="Provincia">
					<option value="">Seleccione una provincia</option>
					<?php
					while ($Dataselect = mysqli_fetch_array($Dataprovinciasselect)) {
						echo "<option value='{$Dataselect["id_provincia"]}'>" . utf8_encode($Dataselect["nombre"]) . "</option>";
					}
					?>
				</select><br><br>


				<label> * Ciudad: </label><br><br>
				<select name="ciudades" id="ciudad">
					<option value="">Seleccione una Ciudad</option>
				</select><br><br>
				<label> Calle: </label><br><br>
				<input type="text" name="Calle" required><br><br>
				<label> Numero: </label><br><br>
				<input type="text" name="numero" required><br><br>
				<label> Piso </label><br><br>
				<input type="text" name="Piso"><br><br>
				<label> Departamento: </label><br><br>
				<input type="text" name="Depto"><br><br>
				<label> Barrio: </label><br><br>
				<input type="text" name="barrio" required><br><br>
				
			</div>
			<div class="botones-container">
        <button class="botones" type="submit" name="Registrar">Registrar</button>
        <button class="botones"><a href="preregistro.html"> volver </a></button>
		<button class="botones"><a href="login.php"> Login </a></button>
    </div>
		</form>

	</main>
	<script>
		$(document).ready(function() {
			$('#Provincia').change(function() {
				var provinciaId = $(this).val();

				// Realizar una solicitud AJAX para obtener las ciudades de la provincia seleccionada
				$.ajax({
					url: "obtener_ciudades.php", // Ruta al script que obtiene las ciudades
					type: "POST",
					data: {
						provincia_id: provinciaId
					},
					dataType: "json",
					success: function(data) {
						console.log("Datos recibidos:", data);
						var ciudadSelect = $("#ciudad");
						ciudadSelect.empty(); // Limpiar las opciones actuales

						if (data.length > 0) {
							// Agregar las nuevas opciones de ciudad
							$.each(data, function(index, ciudad) {
								ciudadSelect.append("<option value='" + ciudad.id_ciudad + "'>" + ciudad.nombre_ciudad + "</option>");
							});
						} else {
							ciudadSelect.append("<option value=''>No hay ciudades disponibles</option>");
						}
					}
				});
			});
		});
	</script>
</body>

</html>