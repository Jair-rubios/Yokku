<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/universal.css">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Document</title>
</head>
<body>
     <?php session_start(); ?>
<nav class="navbar">
    <div class="hamburger-menu">
        <i class="fas fa-bars"></i>
    </div>

    <div class="navbar-left mobile-nav-links">
        <a href="hombres.php">Hombre</a>
        <a href="mujer.php">Mujer</a>
        <a href="#">Niño</a>
        <a href="#">Niña</a>
        <a href="#">Licencias</a>
    </div>
    
    <div class="navbar-center">
        <a href="index.php">
            <img src="imagenes/Logo YOKKU.png" alt="Logo de la tienda" class="logo">
        </a>
    </div>
    
    <div class="navbar-right">
        <a href="ubicacion.php" class="desktop-link">Ubicación</a>
        <a href="wishlist.php" class="icon-link">
            <i class="fas fa-heart heart-icon"></i>
        </a>
        <a href="#" class="icon-link">
            <i class="fas fa-shopping-cart"></i>
        </a>

        <?php if(isset($_SESSION['usuario'])): ?>
            <div class="menu-perfil">
                <img src="uploads/<?php echo $_SESSION['usuario']['foto_perfil']; ?>" 
                     alt="Perfil" class="perfil">
                <ul class="submenu">
                    <li><a href="editar_perfil.php">Editar datos</a></li>
                    <li><a href="historial.php">Historial de pedidos</a></li>
                    <li><a href="logout.php">Cerrar sesión</a></li>
                </ul>
            </div>
        <?php else: ?>
            <a href="login.php" class="desktop-link">Iniciar Sesión</a>
            <a href="registro.php" class="desktop-link">Crear Cuenta</a>
        <?php endif; ?>
    </div>
</nav>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const perfil = document.querySelector(".menu-perfil img.perfil");
    if(perfil){
        perfil.addEventListener("click", () => {
            perfil.parentElement.classList.toggle("active");
        });
    }
});
</script>

</body>
</html>