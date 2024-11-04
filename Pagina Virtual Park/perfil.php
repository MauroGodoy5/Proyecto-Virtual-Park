<?php
session_start();
//si tengo vacio mi elemento de sesion me tiene q redireccionar al login.. 
//al cerrarsesion para que mate todo de la sesion y el se encarga de ubicar en el login
if (empty($_SESSION['Usuario_Nombre'])) {
    header('Location: cerrarsesion.php');
    exit;
}


require_once 'Funciones/conexion.php';
require_once 'Funciones/login.php';
require_once 'Funciones/insertar_usuario.php';
require_once 'Funciones/insertar_empresa.php';
require_once 'Funciones/seleccionar_empresa.php';
require_once 'Funciones/seleccionar_usuario.php';
$Miconexion = ConexionBD();

$Sqlprovincias = ("SELECT * FROM provincia");

$Dataprovinciasselect = mysqli_query($Miconexion, $Sqlprovincias);

$Sqlciudades = ("SELECT * FROM ciudad");

$Dataciudadesselect = mysqli_query($Miconexion, $Sqlciudades);





$sqltipoempresas = ("SELECT * FROM tipoempresa");
$datatipoempresaselect = mysqli_query($Miconexion, $sqltipoempresas);


$idusuario_empresa = $_SESSION['ID'];
$datosEmpresa = SeleccionarEmpresaPorUsuario($Miconexion, $idusuario_empresa);
$Usuario = SeleccionarUsuario($Miconexion, $idusuario_empresa);




if (isset($_POST['actualizar'])) {
    // Obtener el ID del usuario a actualizar

    // Obtener los nuevos datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $piso = $_POST['piso'];
    $depto = $_POST['depto'];
    $barrio = $_POST['barrio'];
    $idCiudad = $_POST['ciudad'];
    $idProvincia = $_POST['Provincia'];

    // Validar que el nombre de usuario no esté ya registrado
    $consultaUsuario = "SELECT * FROM usuario WHERE nombre_usuario = '$usuario'";
    $resultadoUsuario = mysqli_query($Miconexion, $consultaUsuario);

    if (mysqli_num_rows($resultadoUsuario) > 0) {
        $mensaje_error = "El nombre de usuario ya está en uso.";
    }

    // Validar que el correo electrónico no esté ya registrado
    $consultaEmail = "SELECT * FROM contacto WHERE email = '$email'";
    $resultadoEmail = mysqli_query($Miconexion, $consultaEmail);

    if (mysqli_num_rows($resultadoEmail) > 0) {
        $mensaje_error = "El correo electrónico ya está registrado.";
    }

    if (empty($mensaje_error)) {
        // Aquí deberías llamar a la función que actualiza los datos del usuario
        // La lógica para actualizar el usuario debe estar implementada en esa función
        require_once 'Funciones/actualizar_usuario.php';
        $actualizacionExitosa = ActualizarUsuario($Miconexion, $idusuario_empresa, $nombre, $apellido, $usuario, $contrasena, $email, $telefono, $calle, $numero, $piso, $depto, $barrio, $idCiudad, $idProvincia);

        if ($actualizacionExitosa) {
            $mensaje_exito = "Los datos han sido modificados correctamente.";
        } else {
            // Manejar errores si la actualización falla
            // ...
        }
    }
}

if (isset($_POST['actualizarEmpresa'])) {
    // Obtener los nuevos datos del formulario
    
    $tipoEmpresa = $_POST['tipoEmpresa'];
    
    $telefono = $_POST['telefono'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Añade var_dump para verificar los datos
    $razonSocial = mysqli_real_escape_string($Miconexion, $_POST['razonSocial']);
    $email = mysqli_real_escape_string($Miconexion, $_POST['email']);

    // Validar que la razón social no esté ya registrada
    $consultaRazonSocial = "SELECT * FROM empresa WHERE nombre_empresa = '$razonSocial'";
    $resultadoRazonSocial = mysqli_query($Miconexion, $consultaRazonSocial);

    // Añade var_dump para verificar la consulta SQL y el resultado
    

    // Validar que el correo electrónico no esté ya registrado
    $consultaEmail = "SELECT * FROM contacto WHERE email = '$email'";
    $resultadoEmail = mysqli_query($Miconexion, $consultaEmail);

    // Añade var_dump para verificar la consulta SQL y el resultado
    

    if (mysqli_num_rows($resultadoRazonSocial) > 0) {
        $mensaje_error = "La razón social ya está registrada.";
    } elseif (mysqli_num_rows($resultadoEmail) > 0) {
        $mensaje_error = "El correo electrónico ya está registrado.";
    } else {
        // Llamar a la función para actualizar la empresa
        require_once 'Funciones/actualizar_empresa.php'; // Asegúrate de tener el archivo correcto
        $actualizacionExitosa = ActualizarEmpresa($Miconexion, $idusuario_empresa, $razonSocial, $tipoEmpresa, $email, $telefono, $usuario, $contrasena);

        // Añade var_dump para verificar si la actualización fue exitosa
        

        if ($actualizacionExitosa) {
            $mensaje_exito = "Los datos han sido modificados correctamente.";
        } 
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Pagina Virtual Park/css/estilos.css" type="text/css">
    <link rel="stylesheet" href="../Pagina Virtual Park/css/perfil.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="Virtual Park - Organización de eventos de gaming y esports">
    <meta name="keywords" content="Virtual Park, gaming, esports, eventos, stands, entradas">
    <meta name="author" content="Virtual Park">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <?php
    require_once 'Seccionado/encabezado-menu.php';
    ?>
    <main>
    <div id="mensaje-error" class="mensaje-error <?php if ($mensaje_error != "") echo 'mostrar'; ?>">
    <?php
    // Muestra el mensaje de error si hay alguno
    if ($mensaje_error != "") {
        echo $mensaje_error;
    }
    ?>
</div>
<div id="mensaje-exito" class="mensaje-exito <?php if ($actualizacionExitosa) echo 'mostrar'; ?>">
    <?php
    // Muestra el mensaje de éxito si la actualización fue exitosa
    if ($actualizacionExitosa) {
        echo $mensaje_exito;
    }
    ?>
</div>
        <?php if (!empty($_SESSION['Usuario_Nivel'] == 3)) { ?>

            <form method="POST" class="formulario">
                <br>
                <h1>Datos del Usuario</h1>
                <div class="contenedor1">
                    <div class="contenedor-input">
                        <input type="hidden" name="idUsuario" value="<?php echo $idusuario_empresa; ?>">
                    </div>

                </div>

                <div class="contenedor1">
                    <div class="contenedor-input">
                        <label for="">Nombre: </label>
                        <input type="text" name="nombre" id="" value="<?php echo $Usuario['Nombre']; ?>">
                    </div>

                </div>

                <div class="contenedor1">
                    <div class="contenedor-input">
                        <label for="">Apellido: </label>
                        <input type="text" name="apellido" id="" value="<?php echo $Usuario['Apellido']; ?>">
                    </div>

                </div>
                <div class="contenedor1">
                    <div class="contenedor-input">
                        <label for="">Usuario: </label>
                        <input type="text" name="usuario" id="" value="<?php echo $Usuario['Usuario']; ?>">
                    </div>

                </div>
                <div class="contenedor1">
                    <div class="contenedor-input">
                        <label for="">Contraseña: </label>
                        <input type="text" name="contrasena" id="" value="<?php echo $Usuario['Contraseña']; ?>">
                    </div>

                </div>
                <div class="contenedor1">
                    <div class="contenedor-input">
                        <label for="">Email: </label>
                        <input type="text" name="email" value="<?php echo $Usuario['Email']; ?>">
                    </div>

                </div>
                <div class="contenedor1">
                    <div class="contenedor-input">
                        <label for="">Telefono: </label>
                        <input type="text" name="telefono" id="" value="<?php echo $Usuario['Telefono']; ?>">
                    </div>

                </div>
                <div class="contenedor1">
                    <div class="contenedor-input">
                        <label for="">Provincia: </label>
                        <select name="Provincia" id="Provincia">
                            <!-- Opciones del select -->
                            <?php
                            while ($Dataselect = mysqli_fetch_array($Dataprovinciasselect)) {
                                $selected = ($Dataselect["id_provincia"] == $Usuario['Provincia']) ? "selected" : "";
                                echo "<option value='{$Dataselect["id_provincia"]}' $selected>" . utf8_encode($Dataselect["nombre"]) . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="contenedor1">
                    <div class="contenedor-input">
                        <label for="">Ciudad: </label>
                        <select name="ciudad" id="ciudad">
                            <!-- Opciones del select -->
                            <?php
                            while ($Dataselect = mysqli_fetch_array($Dataciudadesselect)) {
                                $selected = ($Dataselect["id_ciudad"] == $Usuario['Ciudad']) ? "selected" : "";
                                echo "<option value='{$Dataselect["id_ciudad"]}' $selected>" . utf8_encode($Dataselect["nombre_ciudad"]) . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="contenedor1">
                        <div class="contenedor-input">
                            <label for="">Calle: </label>
                            <input type="text" name="calle" id="" value="<?php echo $Usuario['Calle']; ?>">
                        </div>
                        <div class="contenedor1">
                            <div class="contenedor-input">
                                <label for="">Numero: </label>
                                <input type="text" name="numero" id="" value="<?php echo $Usuario['Numero']; ?>">
                            </div>
                            <div class="contenedor1">
                                <div class="contenedor-input">
                                    <label for="">Piso: </label>
                                    <input type="text" name="piso" id="" value="<?php echo $Usuario['Piso']; ?>">
                                </div>
                                <div class="contenedor1">
                                    <div class="contenedor-input">
                                        <label for="">Departamento: </label>
                                        <input type="text" name="depto" id="" value="<?php echo $Usuario['Depto']; ?>">
                                    </div>
                                    <div class="contenedor1">
                                        <div class="contenedor-input">
                                            <label for="">Barrio: </label>
                                            <input type="text" name="barrio" id="" value="<?php echo $Usuario['Barrio']; ?>">
                                        </div>

                                    </div>

                                    <div class="button-container">
                                        <button class="buttonform" type="submit" name="actualizar">Modificar</button>
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
<?php }   ?>


<?php if (!empty($_SESSION['Usuario_Nivel'] == 4)) {  ?>

    <form method="POST" class="formulario">
        <br>
        <h1>Datos de la Empresa</h1>
        <div class="contenedor1">
            <div class="contenedor-input">
                <label for="">Razon Social: </label>
                <input type="text" name="razonSocial" value="<?php echo $datosEmpresa['nombre_empresa']; ?>">
            </div>
        </div>

        <div class="contenedor1">
            <div class="contenedor-input">
                <label for="">Tipo de Empresa: </label>
                <select name="tipoEmpresa">
                    <!-- Opciones del select -->
                    <?php
                    while ($Dataselect = mysqli_fetch_array($datatipoempresaselect)) {
                        $selected = ($Dataselect["id_tipoempresa"] == $datosEmpresa['id_tipoempresa']) ? "selected" : "";
                        echo "<option value='{$Dataselect["id_tipoempresa"]}' $selected>" . utf8_encode($Dataselect["descripcion"]) . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="contenedor1">
            <div class="contenedor-input">
                <label for="">Email: </label>
                <input type="email" name="email" value="<?php echo $datosEmpresa['email']; ?>">
            </div>
        </div>
        <div class="contenedor1">
            <div class="contenedor-input">
                <label for="">Telefono: </label>
                <input type="text" name="telefono" value="<?php echo $datosEmpresa['telefono']; ?>">
            </div>
        </div>
        <div class="contenedor1">
            <div class="contenedor-input">
                <label for="">Usuario: </label>
                <input type="text" name="usuario" value="<?php echo $datosEmpresa['nombre_usuario']; ?>">
            </div>
        </div>
        <div class="contenedor1">
            <div class="contenedor-input">
                <label for="">Contraseña: </label>
                <input type="text" name="contrasena" value="<?php echo $datosEmpresa['contrasena']; ?>">
            </div>
        </div>
        <div class="button-container">
            <button class="buttonform" type="submit" name="actualizarEmpresa">Modificar</button>
        </div>
    </form>

    </main>

<?php } ?>

<?php
require_once 'Seccionado/footer.php';

?>
</body>

</html>