

    <nav>
    <h3 class="usuario">Bienvenido/a, <?php echo $_SESSION['Usuario_Nombre'] . ' (' . $_SESSION['Usuario_Nombre_Nivel'] . ')'; ?></h3>
        <ul class="menu">
          <li class="logo"><a href="index.php"><img class="Logo" src="img/logo5.png"></a></li>
          <li class="item"><a href="index.php">Inicio</a></li>
          <li class="item"><a href="infoUsuario.php">Informacion</a></li>
          <li class="item"><a href="ediciones.php">Ediciones</a></li>
          <li class="item"><a href="entradas.php">Entradas</a></li>
          <li class="item"><a href="productos.php">Productos</a></li>
          <li class="item" <?php echo ($_SESSION['Usuario_Nivel'] == 4) ? '' : 'style="display: none;"'; ?>>
    <a href="servicios.php">Servicios</a>
</li>
<li class="item button" <?php echo ($_SESSION['Usuario_Nivel'] == 3 || $_SESSION['Usuario_Nivel'] == 4) ? '' : 'style="display: none;"'; ?>>
    <a href="perfil.php">Mi Perfil</a>
</li>
          <li class="item button secondary" <?php echo ($_SESSION['Usuario_Nivel'] == 1) ? '' : 'style="display: none;"'; ?>>
    <a href="panelAdmin.php">Configuracion</a>
</li>
          <li class="item button secondary"><a href="cerrarsesion.php">Cerrar Sesion</a></li>
          <li class="toggle"><a href="#"><i class="fas fa-bars"></i></a></li>
        </ul>
      </nav>
      <script src="js/code.jquery.com_jquery-3.7.1.min.js"></script>
      <script>
        $(function() {
    $(".toggle").on("click", function() {
        if ($(".item").hasClass("active")) {
            $(".item").removeClass("active");
            $(this).find("a").html("<i class='fas fa-bars'></i>");
        } else {
            $(".item").addClass("active");
            $(this).find("a").html("<i class='fas fa-times'></i>");
        }
    });
});
      </script>

