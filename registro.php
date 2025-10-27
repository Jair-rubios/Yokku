<?php
session_start();
include "conexion.php";

$registrado = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre     = $conn->real_escape_string($_POST['nombre']);
    $celular    = $conn->real_escape_string($_POST['celular']);
    $correo     = $conn->real_escape_string($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    // Hashear contraseña
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Manejo de foto
    $nombreFoto = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['foto'];
        $nombreFoto = uniqid() . "_" . basename($foto['name']);
        $rutaDestino = "uploads/" . $nombreFoto;

        if (!is_dir("uploads")) mkdir("uploads", 0777, true);
        move_uploaded_file($foto['tmp_name'], $rutaDestino);
    }

    $sql = "INSERT INTO Usuarios (Nombre, Celular, Correo, Contrasena, Foto_Imagen)
            VALUES ('$nombre', '$celular', '$correo', '$hash', '$nombreFoto')";

    if ($conn->query($sql) === TRUE) {
        $registrado = true;
    } else {
        $error = "❌ Error al registrar: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro de Usuario</title>
<link rel="icon" type="image/x-icon" href="imagenes/Logo YOKKU.png">
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
<style>
body {
    font-family: "Comfortaa", sans-serif;
    background: linear-gradient(135deg, #e0f7ff, #ffffff);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

form {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    width: 340px;
    text-align: center;
    position: relative;
}

h2 {
    color: #00b7ff;
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    text-align: left;
    margin: 5px 0;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    margin-bottom: 12px;
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
}

button:hover {
    background: #0095d6;
    box-shadow: 0 0 10px #00b7ff70;
}

.error {
    color: red;
    margin-bottom: 10px;
}

.password-strength {
    height: 8px;
    border-radius: 4px;
    background: #ccc;
    margin-top: -5px;
    margin-bottom: 5px;
    overflow: hidden;
}

.password-strength span {
    display: block;
    height: 100%;
    width: 0;
    background: red;
    transition: width 0.4s, background 0.4s;
}

#strength-text {
    text-align: right;
    font-size: 0.9em;
    margin-bottom: 10px;
    color: #555;
}

/* Animación de éxito */
.success-box {
    display: none;
    flex-direction: column;
    align-items: center;
    color: #00b7ff;
}

.checkmark {
    width: 70px;
    height: 70px;
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
@keyframes scale { 0%, 100% { transform: none; } 50% { transform: scale3d(1.1, 1.1, 1); } }
@keyframes fill { 100% { box-shadow: inset 0px 0px 0px 30px #00b7ff; } }
</style>
</head>
<body>

<form id="registroForm" method="POST" enctype="multipart/form-data">
    <h2>Registro de Usuario</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="tel" name="celular" placeholder="Celular">
    <input type="email" name="correo" placeholder="Correo electrónico" required>
    
    <input type="password" name="contrasena" id="password" placeholder="Contraseña" required minlength="8">
    <div class="password-strength"><span id="strength-bar"></span></div>
    <div id="strength-text"></div>

    <label>Foto de perfil:</label>
    <input type="file" name="foto" accept="image/*" required>

    <button type="submit">Registrarse</button>

    <div class="link" style="margin-top:10px;">
        ¿Ya estás registrado? <a href="login.php" style="color:#00b7ff;">Inicia sesión aquí</a>
    </div>
</form>

<div class="success-box" id="successBox">
    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
        <path class="checkmark__check" fill="none" d="M14 27l7 7 16-16"/>
    </svg>
    <h3>¡Registro exitoso!</h3>
</div>

<script>
const password = document.getElementById("password");
const strengthBar = document.getElementById("strength-bar");
const strengthText = document.getElementById("strength-text");

password.addEventListener("input", () => {
    const val = password.value;
    let strength = 0;
    if (val.match(/[a-z]+/)) strength += 1;
    if (val.match(/[A-Z]+/)) strength += 1;
    if (val.match(/[0-9]+/)) strength += 1;
    if (val.length >= 8) strength += 1;

    switch(strength) {
        case 0:
            strengthBar.style.width = "0%";
            strengthText.textContent = "";
            break;
        case 1:
            strengthBar.style.width = "25%";
            strengthBar.style.background = "red";
            strengthText.textContent = "Débil";
            strengthText.style.color = "red";
            break;
        case 2:
            strengthBar.style.width = "50%";
            strengthBar.style.background = "orange";
            strengthText.textContent = "Media";
            strengthText.style.color = "orange";
            break;
        case 3:
            strengthBar.style.width = "75%";
            strengthBar.style.background = "#ffcc00";
            strengthText.textContent = "Fuerte";
            strengthText.style.color = "#ffcc00";
            break;
        case 4:
            strengthBar.style.width = "100%";
            strengthBar.style.background = "#00b7ff";
            strengthText.textContent = "Excelente";
            strengthText.style.color = "#00b7ff";
            break;
    }
});
</script>

<?php if ($registrado): ?>
<script>
document.getElementById("registroForm").style.display = "none";
const success = document.getElementById("successBox");
success.style.display = "flex";
setTimeout(() => {
    window.location.href = "login.php";
}, 2000);
</script>
<?php endif; ?>

</body>
</html>





