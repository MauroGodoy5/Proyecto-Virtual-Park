<?php
session_start();

if (empty($_SESSION['Usuario_Nombre'])) {
    header('Location: cerrarsesion.php');
    exit;
}

require_once 'Funciones/conexion.php';
$Miconexion = ConexionBD();
require_once 'Funciones/seleccionar_producto.php';
require_once 'Funciones/seleccionar_empresa.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Pagina Virtual Park/css/estilos.css" type="text/css">
    <link rel="stylesheet" href="../Pagina Virtual Park/css/productos.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
</head>
<body>
<?php require_once 'Seccionado/encabezado-menu.php'; ?>

<?php
        // Lógica para obtener la lista de productos (sustituye con tu propia lógica)
        $productos = seleccionarProductos($Miconexion);

        // Mostrar cada producto
         
         foreach ($productos as $producto): ?>
            <div class="producto-card">
                <?php if (!empty($producto['ruta_imagen'])): ?>
                    <img class="imagen-producto" src="<?php echo $producto['ruta_imagen']; ?>" alt="Imagen del Producto">
                <?php else: ?>
                    <img class="imagen-producto" src="imagenes/imagen_articulo_por_defecto.jpg" alt="Imagen por Defecto">
                <?php endif; ?>
        
                <div class="producto-informacion">
                    <h2 class="producto-titulo"><?php echo $producto['titulo']; ?></h2>
                    <p class="producto-descripcion"><?php echo $producto['descripcion']; ?></p>
                    <p class="producto-empresa"><?php echo obtenerNombreEmpresa($Miconexion, $producto['id_empresa']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
                
<?php
	require_once 'Seccionado/footer.php';
	?>


</body>
</html>