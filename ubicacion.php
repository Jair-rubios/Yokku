<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="imagenes/Logo YOKKU.png">
     <link rel="stylesheet" href="css/universal.css" />
     <link rel="stylesheet" href="css/navbar.css" />
     <link rel="stylesheet" href="css/ubicacion.css" />
     <!-- Fuentes de Google -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap"
    rel="stylesheet"
  />

   <!-- Iconos Font Awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
  />

    <title>Ubicacion</title>
</head>
<body>
    <!-- Navbar -->
  <?php include 'nav.php'; ?>
 <section class="mapa">
    <div class="mapa-contenedor">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9878.118187696604!2d-106.42561098699224!3d31.742682034387297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86ea4359ba3469d5%3A0x5fdab3bc5a4f953c!2sUACJ%20IIT-IADA!5e0!3m2!1ses!2smx!4v1761024641934!5m2!1ses!2smx" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
    <h2>Esta es nuestra ubicación</h2>
    <p>Ven a visitarnos y descubre nuestras instalaciones. Estamos listos para recibirte y mostrarte todo lo que tenemos para ofrecerte. No dudes en acercarte, nuestro equipo estará encantado de atenderte. ¡Te esperamos con los brazos abiertos!</p>
    <a href="https://maps.app.goo.gl/gHhhnETuXsX6fG9T7" target="_blank" class="btn-direccion">Cómo llegar</a>
  </section>


<!-- Footer -->
  <?php include 'footer.php'; ?>
</body>
</html>