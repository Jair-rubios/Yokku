<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>YOKKO STORE</title>

  <!-- Estilos locales -->
  <link rel="stylesheet" href="css/universal.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/carrusel.css" />
  <link rel="stylesheet" href="css/cards.css" />

  <!-- Iconos Font Awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
  />

  <!-- Fuentes de Google -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap"
    rel="stylesheet"
  />
</head>
<body>

  <!-- Navbar -->
  <?php include 'nav.php'; ?>

  <!-- Carrusel -->
  <div class="carousel-container">
    <div class="carousel">
      <div class="carousel-track">

        <div class="carousel-slide">
          <img src="imagenes/banner-stich.jpg" alt="Paisaje montañoso" />
          <div class="slide-content">
            <h2>Nueva colección</h2>
            <p>Escoge tu outfit fantástico</p>
          </div>
          <button class="buy-button">Comprar</button>
        </div>

        <div class="carousel-slide">
          <img src="imagenes/banner-2.webp" alt="Playa tropical" />
          <div class="slide-content">
            <h2>Dragon Ball Z</h2>
            <p>Aumenta tu Ki con los nuevos diseños</p>
          </div>
          <button class="buy-button">Comprar</button>
        </div>

        <div class="carousel-slide">
          <img src="imagenes/Banner-pochita.jpg" alt="Arquitectura moderna" />
          <div class="slide-content">
            <h2>Chainsaw Man</h2>
            <p>Vístete con tus personajes favoritos</p>
          </div>
          <button class="buy-button">Comprar</button>
        </div>

        <div class="carousel-slide">
          <img src="imagenes/banner Star Wars.jpg" alt="Gastronomía gourmet" />
          <div class="slide-content">
            <h2>Star Wars Collection</h2>
            <p>Una Coleccion fuera de esta Galaxia</p>
          </div>
          <button class="buy-button">Comprar</button>
        </div>

      </div>
    </div>

    <!-- Controles del carrusel -->
    <button class="carousel-control prev" aria-label="Anterior">
      <i class="fas fa-chevron-left"></i>
    </button>
    <button class="carousel-control next" aria-label="Siguiente">
      <i class="fas fa-chevron-right"></i>
    </button>

    <!-- Indicadores -->
    <div class="carousel-indicators">
      <button class="indicator active" aria-label="Ir a slide 1"></button>
      <button class="indicator" aria-label="Ir a slide 2"></button>
      <button class="indicator" aria-label="Ir a slide 3"></button>
      <button class="indicator" aria-label="Ir a slide 4"></button>
    </div>
  </div>

  <!-- Productos -->
  <h1>Productos</h1>
  <div class="productos-container" id="productos"></div>

  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <!-- Scripts -->
  <script src="JS/carrusel.js"></script>
  <script src="JS/cards.js"></script>

</body>
</html>
