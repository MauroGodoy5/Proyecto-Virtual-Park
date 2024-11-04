<?php
session_start();

if (empty($_SESSION['Usuario_Nombre'])) {
  header('Location: cerrarsesion.php');
  exit;
}

require_once 'Funciones/conexion.php';
$Miconexion = ConexionBD();



require_once 'Funciones/insertar_informacion.php';
if (isset($_POST['CargarInfo'])) {
  // Aquí deberías realizar las validaciones y la inserción de datos en la base de datos

  // Si la inserción fue exitosa, muestra el mensaje de registro exitoso
  if (insertar_informacion($Miconexion)) {
    $mensajeI = "La informacion se cargo correctamente";
  }
}
require_once 'Funciones/seleccionar_informacion.php';
$SelectInformacion = seleccionarInformacion($Miconexion);
if (isset($_POST['seleccionarInfo'])) {
  $id_info_seleccionada = $_POST['id_informacion'];

  $SQL_SelectInfo = "SELECT * FROM informacion WHERE id_informacion = $id_info_seleccionada";
  $resultado = mysqli_query($Miconexion, $SQL_SelectInfo);

  if ($resultado && mysqli_num_rows($resultado) > 0) {
    $detalles_info = mysqli_fetch_assoc($resultado);

    // Mostrar los detalles del producto seleccionado en el formulario

    mysqli_free_result($resultado);
  }
}
require_once 'Funciones/actualizar_informacion.php';
if (isset($_POST['ModificarInfo'])) {
  // Obtener los datos del formulario
  $id_informacion = $_POST['id_informacion'];
  $nombre = $_POST['nombre'];
  $fecha = $_POST['fecha'];
  $hora = $_POST['hora'];
  $lugar = $_POST['lugar'];
  $titulo = $_POST['tituloInfo'];
  $descripcion = $_POST['descInfo'];

  // Llamar a la función para actualizar el producto
  if (actualizarInformacion($Miconexion, $id_informacion, $nombre, $fecha, $hora, $lugar, $titulo, $descripcion)) {
    $mensajeMI = "La información se Modifico correctamente";
  } else {
    $mensajeMI = "Error al Modificar la información";
  }

  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}
require_once 'Funciones/eliminar_informacion.php';
if (isset($_POST['eliminarInfo'])) {
  // Obtener el ID del producto a eliminar
  $id_informacion_eliminar = $_POST['id_informacion'];

  // Llamar a la función para eliminar el producto
  eliminarInformacion($Miconexion, $id_informacion_eliminar);

  // Puedes agregar un mensaje de éxito si lo necesitas
  $mensajeEI = "Informacion eliminada exitosamente.";

  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}













require_once 'Funciones/seleccionar_usuario.php';
$usuarios = SeleccionarUsuariosTabla($Miconexion);

require_once 'Funciones/seleccionar_reservas.php';
$reservas = seleccionarReservasTabla($Miconexion);

require_once 'Funciones/seleccionar_empresa.php';
$empresas = SeleccionarEmpresaTabla($Miconexion);

if (isset($_POST['eliminar'])) {
  // Obtener el ID del usuario a eliminar
  $idUsuario = $_POST['idUsuario'];

  // Llamar a la función EliminarUsuario
  require_once './Funciones/eliminarusuario.php';
  EliminarUsuario($Miconexion, $idUsuario);

  // Redirigir de vuelta a la misma página después de eliminar
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit(); // Asegura que se detenga la ejecución del código después de la redirección
}
if (isset($_POST['eliminar2'])) {
  // Obtener el ID del usuario a eliminar
  $idEmpresa = $_POST['idEmpresa'];

  // Llamar a la función EliminarUsuario
  require_once 'Funciones/eliminar_empresa.php';
  EliminarEmpresa($Miconexion, $idEmpresa);

  // Redirigir de vuelta a la misma página después de eliminar
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit(); // Asegura que se detenga la ejecución del código después de la redirección
}
require_once 'Funciones/insertar_reserva.php';
if (isset($_POST['CargarReserva'])) {
  // Aquí deberías realizar las validaciones y la inserción de datos en la base de datos para la reserva

  // Llama a la función insertarReserva y verifica si se insertó correctamente
  if (insertarReserva($Miconexion)) {
    $mensajeR = "La reserva se cargó correctamente";
  } else {
    $mensajeR = "Hubo un error al cargar la reserva";
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}

if (isset($_POST['seleccionarreserva'])) {
  // Obtener el ID de la reserva seleccionada
  $id_reserva_seleccionada = $_POST['id_reserva'];

  // Realizar la lógica para recuperar los detalles de la reserva seleccionada de la base de datos
  // Supongamos que tienes una conexión a la base de datos llamada $vConexion

  // Consulta para obtener los detalles de la reserva seleccionada
  $SQL_SelectReserva = "SELECT * FROM reservas WHERE id_reserva = $id_reserva_seleccionada";
  $resultado = mysqli_query($Miconexion, $SQL_SelectReserva);

  // Verificar si la consulta fue exitosa y obtener los detalles de la reserva
  if ($resultado && mysqli_num_rows($resultado) > 0) {
    $detalles_reserva = mysqli_fetch_assoc($resultado);

    // Mostrar los detalles de la reserva seleccionada en el formulario


    mysqli_free_result($resultado);
  } else {
    echo '<p>No se encontraron detalles para la reserva seleccionada.</p>';
  }
}

require_once 'Funciones/actualizar_reserva.php';
if (isset($_POST['ModificarReserva'])) {
  if (actualizarReserva($Miconexion)) {
    $mensajeModR = "La reserva se Modifico correctamente";
  } else {
    $mensajeModR = "Error al actualizar la reserva";
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}

require_once 'Funciones/eliminar_reserva.php';
if (isset($_POST['eliminarReserva'])) {
  // Obtener el ID de la reserva seleccionada para eliminar
  $id_reserva_eliminar = $_POST['id_reserva'];

  // Realizar la lógica para eliminar la reserva
  if (eliminarReserva($Miconexion, $id_reserva_eliminar)) {
    $mensajeD = "La reserva se eliminó correctamente";
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}
require_once 'Funciones/seleccionar_reserva_empresa.php';
$reservasempresas = obtenerReservasEmpresa($Miconexion);


if (isset($_POST['eliminarreservaempresa'])) {
  $id_reserva_empresa = $_POST['id_reserva_empresa'];
  function obtenerInformacionReservaEmpresa($conexion, $id_reserva_empresa)
  {
    $query = "SELECT * FROM reservas_empresa WHERE id_reserva_empresa = $id_reserva_empresa";
    $result = mysqli_query($conexion, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      $reserva_empresa_info = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $reserva_empresa_info;
    }

    return null;
  }

  // Función para eliminar la reserva de la empresa
  function eliminarReservaEmpresa($conexion, $id_reserva_empresa)
  {
    $query = "DELETE FROM reservas_empresa WHERE id_reserva_empresa = $id_reserva_empresa";
    return mysqli_query($conexion, $query);
  }

  // Función para incrementar el cupo de la reserva en la tabla 'reservas'
  function incrementarCupoReserva($conexion, $id_reserva)
  {
    $query = "UPDATE reservas SET cupos = cupos + 1 WHERE id_reserva = $id_reserva";
    return mysqli_query($conexion, $query);
  }

  // Obtener la información de la reserva de la empresa para liberar el cupo
  $reserva_empresa_info = obtenerInformacionReservaEmpresa($Miconexion, $id_reserva_empresa);
  $id_reserva = $reserva_empresa_info['id_reserva'];

  // Eliminar la reserva de la empresa
  if (eliminarReservaEmpresa($Miconexion, $id_reserva_empresa)) {
    // Incrementar el cupo de la reserva en la tabla 'reservas'
    incrementarCupoReserva($Miconexion, $id_reserva);
    // Redireccionar o realizar alguna acción después de eliminar
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  } else {
    echo "Error al eliminar la reserva";
  }
}


if (isset($_POST['CargarProducto'])) {
  require_once 'Funciones/insertar_producto.php';

  // Llama a la función para insertar el producto
  if (insertarProducto($Miconexion)) {
    $mensajeP = "El producto se cargó correctamente";
  } else {
    $mensajeP = "Error al cargar el producto";
  }
}

require_once 'Funciones/seleccionar_producto.php';
$productos = seleccionarProductos($Miconexion);

if (isset($_POST['seleccionarproducto'])) {
  // Obtener el ID del producto seleccionado
  $id_producto_seleccionado = $_POST['id_producto'];

  // Realizar la lógica para recuperar los detalles del producto seleccionado de la base de datos

  // Consulta para obtener los detalles del producto seleccionado
  $SQL_SelectProducto = "SELECT * FROM productos WHERE id_producto = $id_producto_seleccionado";
  $resultado = mysqli_query($Miconexion, $SQL_SelectProducto);

  // Verificar si la consulta fue exitosa y obtener los detalles del producto
  if ($resultado && mysqli_num_rows($resultado) > 0) {
    $detalles_producto = mysqli_fetch_assoc($resultado);

    // Mostrar los detalles del producto seleccionado en el formulario

    mysqli_free_result($resultado);
  } else {
    echo '<p>No se encontraron detalles para el producto seleccionado.</p>';
  }
}
require_once 'Funciones/actualizar_producto.php';
if (isset($_POST['ModificarProducto'])) {
  // Obtener los datos del formulario
  $id_producto = $_POST['id_producto'];
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $id_empresa = $_POST['id_empresa'];
  $imagen = $_FILES['imagen']['name'];

  // Llamar a la función para actualizar el producto
  if (actualizarProducto($Miconexion, $id_producto, $titulo, $descripcion, $id_empresa, $imagen)) {
    $mensajeMP = "El producto se Modifico correctamente";
  } else {
    $mensajeMP = "Error al Modificar el producto";
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}

require_once 'Funciones/eliminar_producto.php';
if (isset($_POST['eliminarproducto'])) {
  // Obtener el ID del producto a eliminar
  $id_producto_eliminar = $_POST['id_producto'];

  // Llamar a la función para eliminar el producto
  eliminarProducto($Miconexion, $id_producto_eliminar);

  // Puedes agregar un mensaje de éxito si lo necesitas
  $mensaje_eliminar = "Producto eliminado exitosamente.";
}

if (isset($_POST['CargarEdicion'])) {
  require_once 'Funciones/insertar_edicion.php';

  // Llama a la función para insertar la edición
  if (insertarEdicion($Miconexion)) {
    $mensajeE = "La edición se cargó correctamente";
  } else {
    $mensajeE = "Error al cargar la edición";
  }
}

require_once 'Funciones/seleccionar_edicion.php';
$ediciones = seleccionarEdiciones($Miconexion);

if (isset($_POST['seleccionaredicion'])) {
  // Obtener el ID de la edición seleccionada
  $id_edicion_seleccionada = $_POST['id_edicion'];

  // Realizar la lógica para recuperar los detalles de la edición seleccionada de la base de datos

  // Consulta para obtener los detalles de la edición seleccionada
  $SQL_SelectEdicion = "SELECT * FROM ediciones WHERE id_edicion = $id_edicion_seleccionada";
  $resultado_edicion = mysqli_query($Miconexion, $SQL_SelectEdicion);

  // Verificar si la consulta fue exitosa y obtener los detalles de la edición
  if ($resultado_edicion && mysqli_num_rows($resultado_edicion) > 0) {
    $detalles_edicion = mysqli_fetch_assoc($resultado_edicion);

    // Mostrar los detalles de la edición seleccionada en el formulario

    mysqli_free_result($resultado_edicion);
  } else {
    echo '<p>No se encontraron detalles para la edición seleccionada.</p>';
  }
}

require_once 'Funciones/actualizar_edicion.php';
if (isset($_POST['ModificarEdicion'])) {
  // Obtener los datos del formulario
  $id_edicion = $_POST['id_edicion'];
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $ubicacion = $_POST['ubicacion'];
  $imagen = $_FILES['imagen']['name'];

  // Llamar a la función para actualizar la edición
  if (actualizarEdicion($Miconexion, $id_edicion, $titulo, $descripcion, $ubicacion, $imagen)) {
    $mensajeME = "La edición se modificó correctamente";
  } else {
    $mensajeME = "Error al modificar la edición";
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}

require_once 'Funciones/eliminar_edicion.php';
if (isset($_POST['eliminaredicion'])) {
  // Obtener el ID de la edición a eliminar
  $id_edicion_eliminar = $_POST['id_edicion'];

  // Llamar a la función para eliminar la edición
  eliminarEdicion($Miconexion, $id_edicion_eliminar);

  // Puedes agregar un mensaje de éxito si lo necesitas
  $mensaje_eliminar_edicion = "Edición eliminada exitosamente.";
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}
// Contar el número total de usuarios registrados
$sqlTotalUsuarios = "SELECT COUNT(*) as totalUsuarios FROM usuario";
$resultadoTotalUsuarios = mysqli_query($Miconexion, $sqlTotalUsuarios);
$totalUsuarios = mysqli_fetch_assoc($resultadoTotalUsuarios)['totalUsuarios'];

// Contar el número de usuarios comunes
$sqlUsuariosComunes = "SELECT COUNT(*) as totalComunes FROM usuario WHERE id_tipousuario = 3"; // Suponiendo que 3 es el ID para usuarios comunes
$resultadoUsuariosComunes = mysqli_query($Miconexion, $sqlUsuariosComunes);
$totalComunes = mysqli_fetch_assoc($resultadoUsuariosComunes)['totalComunes'];

// Contar el número de usuarios de empresas
$sqlUsuariosEmpresas = "SELECT COUNT(*) as totalEmpresas FROM usuario WHERE id_tipousuario = 4"; // Suponiendo que 4 es el ID para usuarios de empresas
$resultadoUsuariosEmpresas = mysqli_query($Miconexion, $sqlUsuariosEmpresas);
$totalEmpresas = mysqli_fetch_assoc($resultadoUsuariosEmpresas)['totalEmpresas'];

// Sumar el número total de cupos
$sqlTotalCupones = "SELECT SUM(cupos) AS total_cupones FROM reservas";
$resultadoTotalCupones = mysqli_query($Miconexion, $sqlTotalCupones);
$totalCupones = mysqli_fetch_assoc($resultadoTotalCupones)['total_cupones'];

// Contar el número total de reservas
$sqlTotalReservas = "SELECT COUNT(*) as totalReservas FROM reservas";
$resultadoTotalReservas = mysqli_query($Miconexion, $sqlTotalReservas);
$totalReservas = mysqli_fetch_assoc($resultadoTotalReservas)['totalReservas'];
?>



<!DOCTYPE html>
<html lang="es">

<head>
  <link rel="stylesheet" href="../Pagina Virtual Park/css/estilos.css" type="text/css">
  <link rel="stylesheet" href="css/paneladmin.css" type="text/css">
  <meta charset="utf-8" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="description" content="Virtual Park - Organización de eventos de gaming y esports">
  <meta name="keywords" content="Virtual Park, gaming, esports, eventos, stands, entradas">
  <meta name="author" content="Virtual Park">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Index-VirtualPark</title>
  <script>
    function confirmarEliminacion() {
        return confirm('¿Estás seguro de que deseas eliminar esta información?');
    }
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('reservaForm').addEventListener('submit', function (event) {
      const fechaInput = document.getElementById('fecha');
      const fecha = new Date(fechaInput.value);
      const hoy = new Date();
      hoy.setHours(0, 0, 0, 0);

      if (fecha < hoy) {
        alert('La fecha de la reserva debe ser en el futuro.');
        event.preventDefault(); // Evita que el formulario se envíe
      }
    });
  });
</script>
</head>

<body>
  <?php
  require_once 'Seccionado/encabezado-menu.php';
  ?>
  <div class="indicadores">
        <h2>Indicadores</h2>
        <ul>
            <li>Total de usuarios registrados: <?php echo $totalUsuarios; ?></li>
            <li>Usuarios comunes: <?php echo $totalComunes; ?></li>
            <li>Usuarios de empresas: <?php echo $totalEmpresas; ?></li>
            <li>Total de cupones: <?php echo $totalCupones; ?></li>
            <li>Total de reservas (Stands): <?php echo $totalReservas; ?></li>
        </ul>
    </div>
  <div class="accordion-section">
    <div class="accordion-title">Detalles del Evento</div>
    <div class="accordion-content">


      <div class="containerI">
        <section class="form-section">
          <div id="mensaje" class="mensaje-exito <?php if (isset($mensajeI)) echo 'mostrar'; ?>">
            <?php
            // Muestra el mensaje si está definido
            if (isset($mensajeI)) {
              echo $mensajeI;
            }
            ?>
          </div>
          <form name="RegInfo" method="POST" class="formInfo">
            <div class="form-group">
              <h2 class="tituloI">Información del Evento</h2>
              <label>Nombre del Evento:</label>
              <input type="text" name="descEvento" placeholder="VirtualPark">
              <label>Fecha de inicio del Evento:</label>
              <input type="date" name="fechaEvento" required>
              <label>Hora de Inicio del Evento:</label>
              <input type="time" name="horaEvento" required>
              <label>Lugar del Evento:</label>
              <input type="text" name="lugarEvento" required>

              <h2 class="tituloI">Informacion sobre Reservas y/o Entradas</h2>
              <label>Título:</label>
              <input type="text" name="titInfo" placeholder="Reservas y Entradas">
              <label>Detalles:</label>
              <textarea rows="5" cols="60" name="descInfo" required></textarea>
              <button class="botones" type="submit" name="CargarInfo">Cargar Informacion</button>
            </div>
          </form>

          <?php if (isset($detalles_info) && is_array($detalles_info) && !empty($detalles_info)) : ?>
            <h1>Modificar Informacion</h1>
            <div id="mensajeMI" class="mensaje-exito <?php if (isset($mensajeMI)) echo 'mostrar'; ?>">
              <?php
              // Muestra el mensaje si está definido
              if (isset($mensajeMI)) {
                echo $mensajeMI;
              }
              ?>
            </div>
            <form id="modificarInfoForm" method="POST" enctype="multipart/form-data" action="">
              <input type="hidden" name="id_informacion" value="<?php echo $detalles_info['id_informacion']; ?>">
              <div class="form-group">
                <label for="nombre">Nombre del Evento:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $detalles_info['nombre']; ?>" required>
              </div>
              <div class="form-group">
                <label for="fecha">Fecha de inicio del Evento:</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo $detalles_info['fecha']; ?>" required>
              </div>
              <div class="form-group">
                <label for="hora">Hora de inicio del Evento:</label>
                <input type="time" id="hora" name="hora" value="<?php echo $detalles_info['hora']; ?>" required>
              </div>
              <div class="form-group">
                <label for="lugar">Hora de inicio del Evento:</label>
                <input type="text" id="lugar" name="lugar" value="<?php echo $detalles_info['lugar']; ?>" required>
              </div>
              <div class="form-group">
                <label for="tituloInfo">Titulo informacion adicional del Evento:</label>
                <input type="text" id="tituloInfo" name="tituloInfo" value="<?php echo $detalles_info['tituloInfo']; ?>" required>
              </div>
              <div class="form-group">
                <label for="descInfo">Informacion adicional del Evento:</label>
                <textarea rows="5" cols="60" name="descInfo" required><?php echo $detalles_info['descInfo']; ?></textarea>
              </div>
              <!-- Agrega más campos según sea necesario -->
              <button type="submit" name="ModificarInfo">Modificar Informacion</button>
            </form>
          <?php endif; ?>

          <div>
            <table id="reservasTable">
              <thead>
                <tr>
                  <th>Evento</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Lugar</th>
                  <th>Tituo</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($SelectInformacion as $SelectInfo) : ?>
                  <tr>
                    <td><?php echo $SelectInfo['nombre']; ?></td>
                    <td><?php echo $SelectInfo['fecha']; ?></td>
                    <td><?php echo $SelectInfo['hora']; ?></td>
                    <td><?php echo $SelectInfo['lugar']; ?></td>
                    <td><?php echo $SelectInfo['tituloInfo']; ?></td>
                    <!-- Agrega más columnas con datos relevantes -->

                    <!-- Columna para la acción (Eliminar) -->
                    <td>
                      <form method="POST">
                        <input type="hidden" name="id_informacion" value="<?php echo $SelectInfo['id_informacion']; ?>">
                        <button type="submit" name="seleccionarInfo" value="seleccionarInfo">Seleccionar</button>
                        <button type="submit" name="eliminarInfo" class="eliminar" onclick="return confirmarEliminacion()">Eliminar</button>
                      </form>
                    </td>
                  </tr>
                  <!-- Puedes agregar más filas según sea necesario -->
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

        </section>
      </div>

    </div>
  </div>


  <div class="accordion-section">
    <div class="accordion-title">Boton Entradas</div>
    <div class="accordion-content">

      <div class="section">
        <h2>Carga URL Boton</h2>
        <form action="procesar.php" method="post">
          <label for="urlInput" class="titulourl">Ingresa la URL:</label>
          <input type="text" id="urlInput" name="urlInput" required>
          <button type="submit">Actualizar URL</button>
        </form>
      </div>

    </div>

  </div>
  </div>


  <div class="accordion-section">
    <div class="accordion-title">Crear Reserva</div>
    <div class="accordion-content">

      <main class="containerR">

        <h1>Crear Reserva</h1>
        <div id="mensaje" class="mensaje-exito <?php if (isset($mensajeR)) echo 'mostrar'; ?>">
          <?php
          // Muestra el mensaje si está definido
          if (isset($mensajeR)) {
            echo $mensajeR;
          }
          ?>
        </div>
        <form id="reservaForm" method="POST">
          <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
          </div>
          <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
          </div>
          <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required>
          </div>
          <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>
          </div>
          <div class="form-group">
            <label for="cupos">Cupos:</label>
            <input type="number" id="cupos" name="cupos" required>
          </div>
          <button type="submit" name="CargarReserva">Crear Reserva</button>
        </form>
        <br> <br>

        <div id="mensaje" class="mensaje-exito <?php if (isset($mensajeModR)) echo 'mostrar'; ?>">
          <?php
          // Muestra el mensaje si está definido
          if (isset($mensajeModR)) {
            echo $mensajeModR;
          }
          ?>
        </div>
        <?php if (isset($detalles_reserva) && is_array($detalles_reserva) && !empty($detalles_reserva)) : ?>
          <h1>Seleccionar y modificar Reserva</h1>
          <form id="reservaForm" method="POST">
            <input type="hidden" name="id_reserva" value="<?php echo $detalles_reserva['id_reserva']; ?>">
            <div class="form-group">
              <label for="titulo">Título:</label>
              <input type="text" id="titulo" name="titulo" value="<?php echo $detalles_reserva['titulo']; ?>" required>
            </div>
            <div class="form-group">
              <label for="descripcion">Descripción:</label>
              <textarea id="descripcion" name="descripcion" required><?php echo $detalles_reserva['descripcion']; ?></textarea>
            </div>
            <div class="form-group">
              <label for="precio">Precio:</label>
              <input type="number" id="precio" name="precio" step="0.01" value="<?php echo $detalles_reserva['precio']; ?>" required>
            </div>
            <div class="form-group">
              <label for="fecha">Fecha:</label>
              <input type="date" id="fecha" name="fecha" value="<?php echo $detalles_reserva['fecha']; ?>" required>
            </div>
            <div class="form-group">
              <label for="cupos">Cupos:</label>
              <input type="number" id="cupos" name="cupos" value="<?php echo $detalles_reserva['cupos']; ?>" required>
            </div>
            <button type="submit" name="ModificarReserva">Modificar Reserva</button>
          </form>
        <?php endif; ?>
        <table id="reservasTable">
          <div id="mensaje" class="mensaje-exito <?php if (isset($mensajeD)) echo 'mostrar'; ?>">
            <?php
            // Muestra el mensaje si está definido
            if (isset($mensajeD)) {
              echo $mensajeD;
            }
            ?>
          </div>
          <thead>
            <tr>
              <th>Título</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Fecha</th>
              <th>Cupos</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($reservas as $reserva) : ?>
              <tr>
                <td><?php echo $reserva['titulo']; ?></td>
                <td><?php echo $reserva['descripcion']; ?></td>
                <td><?php echo $reserva['precio']; ?></td>
                <td><?php echo $reserva['fecha']; ?></td>
                <td><?php echo $reserva['cupos']; ?></td>
                <td>
                  <form method="POST">
                    <input type="hidden" name="id_reserva" value="<?php echo $reserva['id_reserva']; ?>">
                    <button type="submit" name="seleccionarreserva" value="seleccionarreserva">Seleccionar</button>
                    <button name="eliminarReserva" class="eliminar" onclick="return confirmarEliminacion()">Eliminar</button>
                  </form>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </main>
      <div class="table-wrapper">
        <table>
          <caption>Reservas de Empresas</caption>
          <thead>
            <tr>
              <th>ID Reserva</th>
              <th>Nombre Empresa</th>
              <th>Telefono</th>
              <th>Título de la Reserva</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($reservasempresas as $reservaempresa) : ?>
              <tr>
                <td><?php echo $reservaempresa['id_reserva']; ?></td>
                <td><?php echo $reservaempresa['nombre_empresa']; ?></td>
                <td><?php echo $reservaempresa['telefono']; ?></td>
                <td><?php echo $reservaempresa['titulo_reserva']; ?></td>
                <!-- Agrega más columnas con datos relevantes -->

                <!-- Columna para la acción (Eliminar) -->
                <td>
                  <form method="POST" onsubmit="return confirmarEliminacion();">
                    <input type="hidden" name="id_reserva_empresa" value="<?php echo $reservaempresa['id_reserva_empresa']; ?>">
                    <button type="submit" name="eliminarreservaempresa" class="eliminar">Eliminar</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>


  <div class="accordion-section">
    <div class="accordion-title">Crear Producto</div>
    <div class="accordion-content">

      <main class="containerR">
        <h1>Crear Producto</h1>
        <div id="mensaje" class="mensaje-exito <?php if (isset($mensajeP)) echo 'mostrar'; ?>">
          <?php
          // Muestra el mensaje si está definido
          if (isset($mensajeP)) {
            echo $mensajeP;
          }
          ?>
        </div>
        <form id="productoForm" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
          </div>
          <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
          </div>
          <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>
          </div>
          <div class="form-group">
            <label for="empresa">Empresa:</label>
            <select id="empresa" name="id_empresa" required>
              <?php foreach ($empresas as $empresa) : ?>
                <option value="<?php echo $empresa['id_empresa']; ?>"><?php echo $empresa['nombre_empresa']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" name="CargarProducto">Crear Producto</button>
        </form>
        <?php if (isset($detalles_producto) && is_array($detalles_producto) && !empty($detalles_producto)) : ?>
          <h1>Modificar Producto Seleccionado</h1>
          <div id="mensaje" class="mensaje-exito <?php if (isset($mensajeMP)) echo 'mostrar'; ?>">
            <?php
            // Muestra el mensaje si está definido
            if (isset($mensajeMP)) {
              echo $mensajeMP;
            }
            ?>
          </div>
          <form id="modificarProductoForm" method="POST" enctype="multipart/form-data" action="">
            <input type="hidden" name="id_producto" value="<?php echo $detalles_producto['id_producto']; ?>">
            <div class="form-group">
              <label for="titulo">Título:</label>
              <input type="text" id="titulo" name="titulo" value="<?php echo $detalles_producto['titulo']; ?>" required>
            </div>
            <div class="form-group">
              <label for="descripcion">Descripción:</label>
              <textarea id="descripcion" name="descripcion" required><?php echo $detalles_producto['descripcion']; ?></textarea>
            </div>
            <div class="form-group">
              <label for="imagen">Imagen:</label>
              <input type="file" id="imagen" name="imagen" accept="image/*">
            </div>
            <div class="form-group">
              <label for="empresa">Empresa:</label>
              <select id="empresa" name="id_empresa" required>
                <?php foreach ($empresas as $empresa) : ?>
                  <option value="<?php echo $empresa['id_empresa']; ?>" <?php echo ($detalles_producto['id_empresa'] == $empresa['id_empresa']) ? 'selected' : ''; ?>><?php echo $empresa['nombre_empresa']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <!-- Agrega más campos según sea necesario -->
            <button type="submit" name="ModificarProducto">Modificar Producto</button>
          </form>
        <?php endif; ?>

        <table id="productosTable">
          <thead>
            <tr>
              <th>Título</th>
              <th>Descripción</th>
              <th>Empresa</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($productos as $producto) : ?>
              <tr>
                <td><?php echo $producto['titulo']; ?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td><?php echo obtenerNombreEmpresa($Miconexion, $producto['id_empresa']) ?></td>
                <!-- Agrega más columnas con datos relevantes -->

                <!-- Columna para la acción (Eliminar) -->
                <td>
                  <form method="POST">
                    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                    <button type="submit" name="seleccionarproducto" value="seleccionarproducto">Seleccionar</button>
                    <button type="submit" name="eliminarproducto" class="eliminar" onclick="return confirmarEliminacion()">Eliminar</button>
                  </form>
                </td>
              </tr>
              <!-- Puedes agregar más filas según sea necesario -->
            <?php endforeach; ?>
          </tbody>
        </table>
        <br> <br>
      </main>
    </div>
  </div>


  <div class="accordion-section">
    <div class="accordion-title">Lista de Usuarios</div>
    <div class="accordion-content">
      <div class="table-wrapper">
        <table>
          <caption>Lista de Usuarios</caption>
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Usuario</th>
              <th>Contraseña</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
              <tr>
                <td><?php echo $usuario['Nombre']; ?></td>
                <td><?php echo $usuario['Apellido']; ?></td>
                <td><?php echo $usuario['Usuario']; ?></td>
                <td><?php echo $usuario['Contraseña']; ?></td>
                <td>
                  <form method="post" onsubmit="return confirmarEliminacion();">
                    <input type="hidden" name="idUsuario" value="<?php echo $usuario['id']; ?>">
                    <button type="submit" name="eliminar" class="eliminar">Eliminar</button>
                  </form>
                </td>
                <!-- Agrega más celdas según los datos que deseas mostrar -->
              </tr>
            <?php endforeach; ?>

            <!-- Agrega más filas según sea necesario -->
          </tbody>
        </table>
      </div>

    </div>
  </div>


  <div class="accordion-section">
    <div class="accordion-title">Lista de Empresas</div>
    <div class="accordion-content">

      <div class="table-wrapper">
        <table>
          <caption>Lista de Empresas</caption>
          <thead>
            <tr>
              <th>Nombre de la Empresa</th>
              <th>Nombre de la Empresa</th>
              <th>Usuario</th>
              <th>Telefono</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($empresas as $empresa) : ?>
              <tr>
                <td><?php echo $empresa['nombre_empresa']; ?></td>
                <td><?php echo $empresa['email']; ?></td>
                <td><?php echo $empresa['nombre_usuario']; ?></td>
                <td><?php echo $empresa['telefono']; ?></td>
                <td>
                  <form method="post" onsubmit="return confirmarEliminacion();">
                    <input type="hidden" name="idEmpresa" value="<?php echo $empresa['id_empresa']; ?>">
                    <button type="submit" name="eliminar2" class="eliminar">Eliminar</button>
                  </form>
                </td>
                <!-- Agrega más celdas según los datos que deseas mostrar -->
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="accordion-section">
    <div class="accordion-title">Crear Edición</div>
    <div class="accordion-content">
      <main class="containerR">
        <h1>Crear Edición</h1>
        <div id="mensaje" class="mensaje-exito <?php if (isset($mensajeE)) echo 'mostrar'; ?>">
          <?php
          // Muestra el mensaje si está definido
          if (isset($mensajeE)) {
            echo $mensajeE;
          }
          ?>
        </div>
        <form id="edicionForm" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
          </div>
          <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
          </div>
          <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>
          </div>
          <div class="form-group">
            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" required>
          </div>
          <button type="submit" name="CargarEdicion">Crear Edición</button>
        </form>
        <?php if (isset($detalles_edicion) && is_array($detalles_edicion) && !empty($detalles_edicion)) : ?>
          <h1>Modificar Edición Seleccionada</h1>
          <div id="mensaje" class="mensaje-exito <?php if (isset($mensajeME)) echo 'mostrar'; ?>">
            <?php
            // Muestra el mensaje si está definido
            if (isset($mensajeME)) {
              echo $mensajeME;
            }
            ?>
          </div>
          <form id="modificarEdicionForm" method="POST" enctype="multipart/form-data" action="">
            <input type="hidden" name="id_edicion" value="<?php echo $detalles_edicion['id_edicion']; ?>">
            <div class="form-group">
              <label for="titulo">Título:</label>
              <input type="text" id="titulo" name="titulo" value="<?php echo $detalles_edicion['titulo']; ?>" required>
            </div>
            <div class="form-group">
              <label for="descripcion">Descripción:</label>
              <textarea id="descripcion" name="descripcion" required><?php echo $detalles_edicion['descripcion']; ?></textarea>
            </div>
            <div class="form-group">
              <label for="imagen">Imagen:</label>
              <input type="file" id="imagen" name="imagen" accept="image/*">
            </div>
            <div class="form-group">
              <label for="ubicacion">Ubicación:</label>
              <input type="text" id="ubicacion" name="ubicacion" value="<?php echo $detalles_edicion['ubicacion']; ?>" required>
            </div>
            <button type="submit" name="ModificarEdicion">Modificar Edición</button>
          </form>
        <?php endif; ?>

        <table id="edicionesTable">
          <thead>
            <tr>
              <th>Título</th>
              <th>Descripción</th>
              <th>Ubicación</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($ediciones as $edicion) : ?>
              <tr>
                <td><?php echo $edicion['titulo']; ?></td>
                <td><?php echo $edicion['descripcion']; ?></td>
                <td><?php echo $edicion['ubicacion']; ?></td>
                <!-- Agrega más columnas con datos relevantes -->

                <!-- Columna para la acción (Eliminar) -->
                <td>
                  <form method="POST">
                    <input type="hidden" name="id_edicion" value="<?php echo $edicion['id_edicion']; ?>">
                    <button type="submit" name="seleccionaredicion" value="seleccionaredicion">Seleccionar</button>
                    <button type="submit" name="eliminaredicion" class="eliminar" onclick="return confirmarEliminacion()">Eliminar</button>
                  </form>
                </td>
              </tr>
              <!-- Puedes agregar más filas según sea necesario -->
            <?php endforeach; ?>
          </tbody>
        </table>
        <br> <br>
      </main>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var accordionTitles = document.querySelectorAll('.accordion-title');

      accordionTitles.forEach(function(title) {
        title.addEventListener('click', function() {
          var section = this.parentNode;
          section.classList.toggle('active');

          var content = section.querySelector('.accordion-content');
          if (section.classList.contains('active')) {
            content.style.display = 'block';
          } else {
            content.style.display = 'none';
          }
        });
      });
    });
  </script>
  <?php
  require_once 'Seccionado/footer.php';
  ?>


</body>

</html>