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

    <header>
        <h1>Virtual Park</h1>
        <p>Tu experiencia definitiva en eSports y Videojuegos</p>
    </header>
    <?php
    require_once 'Seccionado/encabezado-menu.php';
    ?>

    <section class="nosotros">
        <div class=“container1”>
            <h2>¿Qué es Virtual Park?</h2>
            <p>Virtual Park es el 1er parque de diversiones tecnológico de Córdoba Capital.
                Trata lo mejor de entretenimiento tecnológico, con un ambiente festivo y de unión.
                Tendremos empresas referentes en el rubro exponiendo para comercializar y contactarse con el público.
                Shows de música y baile en vivo intervenciones a lo largo del predio malabares maquilladores balineras
                etc La ambientación será de otro nivel combinando luces y colores generando la inmersión del público a
                los videojuegos Diferentes sectores de entretenimiento realidad virtual juegos familiares juegos en equipo
                competencia y hasta juegos motrices Wii juegos 4D Existirá un espacio relax pufs y sillones para descansar
                luego continuar la aventura Un sector gastronómico con Food Trucks siguiendo la ambientación La atracción
                más llamativa será la competencia e-Sports presencial contará con una gran producción transmitida en vivo
                con comentaristas y un gran premio para los ganadores Representaciones con muchos muy llamativos Cosplays
                representaciones y disfraces personajes Será un evento único moderno gran valor </p>
        </div>
    </section>


    <section class="actividades">
    <div class="container2">
        <h2>Actividades</h2>
        <p class="descripcionA">Descubre una amplia gama de actividades emocionantes:</p>

        <div class="activities-grid">
            <div class="activity-card">
                <img src="img/imagen2.jpg" alt="Torneos de eSports">
                <div class="card-content">
                    <h3>Torneos de eSports</h3>
                    <p class="descripcionA">Participa o disfruta de los torneos de los videojuegos más populares, con premios increíbles y mucha diversión.</p>
                </div>
            </div>
            
            <div class="activity-card">
                <img src="img/imagen1.jpg" alt="Zonas de juego libre">
                <div class="card-content">
                    <h3>Zonas de juego libre</h3>
                    <p class="descripcionA">Prueba los últimos lanzamientos o los clásicos de siempre, en consolas, PC o realidad virtual, sin límites ni restricciones.</p>
                </div>
            </div>
            
            <div class="activity-card">
                <img src="img/galeria3.jpg" alt="Charlas y paneles">
                <div class="card-content">
                    <h3>Charlas y paneles con expertos</h3>
                    <p class="descripcionA">Aprende de los mejores profesionales del sector, que compartirán sus experiencias, consejos y secretos sobre los eSports y los videojuegos.</p>
                </div>
            </div>
            
            <div class="activity-card">
                <img src="img/galeria2.jpg" alt="Exhibiciones de nuevos lanzamientos">
                <div class="card-content">
                    <h3>Exhibiciones de nuevos lanzamientos</h3>
                    <p class="descripcionA">Descubre las novedades más esperadas del mundo de los videojuegos, con demos exclusivas, tráilers y sorpresas.</p>
                </div>
            </div>

            <div class="activity-card">
                <img src="img/galeria5.jpg" alt="Exhibiciones de nuevos lanzamientos">
                <div class="card-content">
                    <h3>Concurso de Cosplay</h3>
                    <p class="descripcionA">Los mejores disfraces los veras aqui!!.</p>
                </div>
            </div>

            <div class="activity-card">
                <img src="img/galeria6.jpg" alt="Exhibiciones de nuevos lanzamientos">
                <div class="card-content">
                    <h3>Shows en Vivo</h3>
                    <p class="descripcionA">No te pierdas de los inreibles shows en vivo.</p>
                </div>
            </div>
        </div>
    </div>
</section>


    <section class="sponsors">
    <h2>Patrocinadores</h2>
    <div class="sponsor-logos">
      <img src="img/flow.png" alt="Logo del Patrocinador 1">
      <img src="img/cocacola.webp" alt="Logo del Patrocinador 2">
      <img src="img/hyperx.png" alt="Logo del Patrocinador 3">
      <img src="img/reddragon.webp" alt="Logo del Patrocinador 3">
      <img src="img/razer.jpg" alt="Logo del Patrocinador 3">
      <img src="img/nike.jpg" alt="Logo del Patrocinador 3">
      <!-- Agrega más imágenes según sea necesario -->
    </div>
  </section>
  <section class="contacto">
    <div class="container55">
        <h2>Contactanos</h2>
        <p class="descrpform">¡Envíanos un mensaje y estaremos encantados de responderte!</p>

        <form action="mailto:mauro.gdo4@gmail.com" method="post" enctype="text/plain" class="formcontacto">
            <label for="nombre" class="labelform">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email" class="labelform">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="mensaje" class="labelform">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

            <input type="submit" value="Enviar">
        </form>
    </div>
</section>

    <?php
    require_once 'Seccionado/footer.php';

    ?>

</body>

</html>