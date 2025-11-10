<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito</title>
   <link rel="stylesheet" href="css/universal.css">
   <link rel="stylesheet" href="css/carrito.css">
   <link rel="stylesheet" href="css/metodoPago.css">
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
  <div class="msg-container" id="msg-container"></div>
  <div class="tarjeta-container" id="tarjeta">
      <div class="tarjeta-form">
        <h3><b>Introduce tu tarjeta para finalizar el pago</b></h3>
        <label for="numTarjeta">Numero de tarjeta</label>
        <input type="text" id="numTarjeta" class="numTarjeta" name="numTarjeta" placeholder="1111-2222-3333-4444" maxlength="16" required>

        <label for="nombreTarjeta">Nombre en la tarjeta</label>
        <input type="text" id="nombreTarjeta" class="nombreTarjeta" name="nombreTarjeta" placeholder="Nombre y apellidos" required >

        
        <label for="fechaVenci">Fecha de vencimiento</label>
        <div class="shortTarjeta">
          <select name="mesVenci" id="mesVenci" class="mesVenci" required>
            <option value="" selected disabled>Mes</option>
            <option value="01">Enero</option>
            <option value="02">Febrero</option>
            <option value="03">Marzo</option>
            <option value="04">Abril</option>
            <option value="05">Mayo</option>
            <option value="06">Junio</option>
            <option value="07">Julio</option>
            <option value="08">Agosto</option>
            <option value="09">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
         </select>
          <input type="text" id="anoVenci" name="anoVenci" placeholder="Año" maxlength="4"/>

          <label for="CVVTarjeta">CVV</label>
          <input type="password" id="CVVTarjeta" class="CVVTarjeta" name="CVVTarjeta" placeholder="123" maxlength="3"/>
        </div>
        <label for="verificarDatos" id="verificarLabel" class="label-verificarDatos">Error al confirmar pago. Verifique sus datos.</label>
      </div>
      <button class="btn-procederPago" id="btn-procederPago" type="button">Proceder con el pago</button>
  </div>
  <div class="overlay" id="overlay"></div>
  <div class="cart-container" id="cart"></div>

  <div class="carrito-total" id="total"></div>

  <div class="carrito-pagar" id="pagar"></div>
  
  <!-- Footer -->
  <?php include 'footer.php'; ?>
  <script src="JS/carrito.js"></script>
</body>
</html>
