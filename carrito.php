<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito</title>
   <link rel="stylesheet" href="css/universal.css">
   <link rel="stylesheet" href="css/carrito.css">
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
  <h1>Carrito</h1>
  <div class="cart-container" id="cart"></div>

  <div class="carrito-total" id="total"></div>

  <div class="carrito-pagar" id="pagar"></div>

  <!-- Footer -->
  <?php include 'footer.php'; ?>
  <script src="JS/carrito.js"></script>
</body>
</html>
