<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YOKKO STORE</title>
    <link rel="stylesheet" href="css/universal.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/carrusel.css">
    <link rel="stylesheet" href="css/cards.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    
<?php include 'nav.php';  ?>
   
 <div class="carousel-container">
    <div class="carousel">
        <div class="carousel-track">
            <div class="carousel-slide">
                <img
                  src="imagenes/banner-1.webp"
                  alt="Paisaje montañoso"
                />
                <div class="slide-content">
                    <h2>Nueva coleccion</h2>
                    <p>Escoje tu Outfit Fantastico</p>
                </div>
                <button class="buy-button">Comprar</button>
            </div>
            <div class="carousel-slide">
                <img
                  src="imagenes/banner-2.webp"
                  alt="Playa tropical"
                />
                <div class="slide-content">
                    <h2>Dragon Ball Z</h2>
                    <p>Aumenta tu Ki con los nuevos Diseños</p>
                </div>
                <button class="buy-button">Comprar</button>
            </div>
            <div class="carousel-slide">
                <img
                  src="imagenes/banner-3.jpg"
                  alt="Arquitectura moderna"
                />
                <div class="slide-content">
                    <h2>Chain saw Man</h2>
                    <p>Vistete con tus personajes Favoritos</p>
                </div>
                <button class="buy-button">Comprar</button>
            </div>
            <div class="carousel-slide">
                <img
                  src="imagenes/capitan.png"
                  alt="Gastronomía gourmet"
                />
                <div class="slide-content">
                    <h2>Marvel Collection</h2>
                    <p>Vistete como un Heroe</p>
                </div>
                <button class="buy-button">Comprar</button>
            </div>
        </div>
    </div>
    <button class="carousel-control prev" aria-label="Anterior">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button class="carousel-control next" aria-label="Siguiente">
        <i class="fas fa-chevron-right"></i>
    </button>
    <div class="carousel-indicators">
        <button class="indicator active" aria-label="Ir a slide 1"></button>
        <button class="indicator" aria-label="Ir a slide 2"></button>
        <button class="indicator" aria-label="Ir a slide 3"></button>
        <button class="indicator" aria-label="Ir a slide 4"></button>
    </div>
</div>
    </div>
    <h1>Productos</h1>
  <div class="productos-container" id="productos"></div>
  
    <script src="JS/carrusel.js"></script>
    <script src="JS/cards.js"></script>
</body>
</html>