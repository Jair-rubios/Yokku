<?php
session_start();
include "conexion.php";

$login_exitoso = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Es mucho mejor usar sentencias preparadas (mysqli_stmt) para seguridad,
    // pero por ahora mantendremos el código lo más parecido al tuyo.
    $correo     = $conn->real_escape_string($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    // 1. La consulta ahora INCLUYE la columna 'Rol'
    $sql = "SELECT ID_Usuario, Nombre, Correo, Contrasena, Foto_Imagen, Rol  
            FROM Usuarios 
            WHERE Correo = '$correo' 
            LIMIT 1";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($contrasena, $usuario['Contrasena'])) {
            
            // 2. Se incluye la clave 'rol' en la sesión (¡en minúsculas!)
            $_SESSION['usuario'] = [
                'id'            => $usuario['ID_Usuario'],
                'nombre'        => $usuario['Nombre'],
                'correo'        => $usuario['Correo'],
                'foto_perfil'   => $usuario['Foto_Imagen'],
                'rol'           => $usuario['Rol'] // CLAVE: Aquí se guarda el rol
            ];
            
            // 3. Redirección condicional inmediata por PHP
            if ($_SESSION['usuario']['rol'] === 'admin') {
                // Si es admin, va al panel de administración (ajusta la ruta si es necesario)
                header("Location: admin/panel_admin.php");
            } else {
                // Si es usuario normal, va al index
                header("Location: index.php");
            }
            exit(); // ¡CRUCIAL! Detiene la ejecución para que se aplique la redirección
            
        } else {
            $error = "❌ Contraseña incorrecta.";
        }
    } else {
        $error = "⚠️ No se encontró una cuenta con ese correo.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Iniciar Sesión</title>
<link rel="icon" type="image/x-icon" href="imagenes/Logo YOKKU.png">
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: "Comfortaa", sans-serif;
        background: linear-gradient(135deg, #e0f7ff, #ffffff);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    form {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        width: 320px;
        text-align: center;
        position: relative;
    }

    h2 {
        color: #00b7ff;
        margin-bottom: 20px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        transition: 0.3s;
    }

    input:focus {
        border-color: #00b7ff;
        box-shadow: 0 0 6px #00b7ff60;
        outline: none;
    }

    button {
        background: #00b7ff;
        color: white;
        border: none;
        padding: 10px;
        width: 100%;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    button:hover {
        background: #0095d6;
        box-shadow: 0 0 10px #00b7ff70;
    }

    .error {
        color: red;
        margin-bottom: 10px;
        text-align: center;
    }

    .link {
        text-align: center;
        margin-top: 10px;
    }

    .link a {
        color: #00b7ff;
        text-decoration: none;
        font-weight: bold;
    }

    .link a:hover {
        text-decoration: underline;
    }

    /* Spinner de carga */
    .spinner {
        display: none;
        margin: 15px auto;
        width: 40px;
        height: 40px;
        border: 4px solid #00b7ff50;
        border-top: 4px solid #00b7ff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Animación de éxito */
    .success-animation {
        display: none;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        color: #00b7ff;
    }

    .checkmark {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: block;
        stroke-width: 3;
        stroke: #00b7ff;
        stroke-miterlimit: 10;
        box-shadow: inset 0px 0px 0px #00b7ff;
        animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
        margin: 10px auto;
    }

    .checkmark__circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 2;
        stroke-miterlimit: 10;
        stroke: #00b7ff;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }

    .checkmark__check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }

    @keyframes stroke { 100% { stroke-dashoffset: 0; } }
    @keyframes scale {
        0%, 100% { transform: none; }
        50% { transform: scale3d(1.1, 1.1, 1); }
    }
    @keyframes fill { 100% { box-shadow: inset 0px 0px 0px 30px #00b7ff; } }
</style>
</head>
<body>

<form id="loginForm" method="POST">
    <h2>Iniciar Sesión</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <input type="email" name="correo" placeholder="Correo electrónico" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>

    <button type="submit">Entrar</button>
    <div class="spinner" id="spinner"></div>

    <div class="link">
        ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
    </div>
</form>

<!-- Animación de éxito -->
<div class="success-animation" id="successAnimation">
    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
        <path class="checkmark__check" fill="none" d="M14 27l7 7 16-16"/>
    </svg>
    <h3>¡Inicio de sesión exitoso!</h3>
</div>

<script>
    const form = document.getElementById("loginForm");
    const spinner = document.getElementById("spinner");
    const success = document.getElementById("successAnimation");

    form.addEventListener("submit", (e) => {
        spinner.style.display = "block";
    });
</script>

<?php if ($login_exitoso): ?>
<script>
    document.querySelector("form").style.display = "none";
    spinner.style.display = "none";
    success.style.display = "flex";

    setTimeout(() => {
        window.location.href = "index.php";
    }, 2000);
</script>
<?php endif; ?>

</body>
</html>


