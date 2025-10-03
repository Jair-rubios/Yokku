<?php
session_start();
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo     = $conn->real_escape_string($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    // Buscar usuario por correo
    $sql = "SELECT ID_Usuario, Nombre, Correo, Contrasena, Foto_Imagen 
            FROM Usuarios 
            WHERE Correo = '$correo' 
            LIMIT 1";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar contraseña
        if (password_verify($contrasena, $usuario['Contrasena'])) {
            // Iniciar sesión
            $_SESSION['usuario'] = [
                'id'           => $usuario['ID_Usuario'],
                'nombre'       => $usuario['Nombre'],
                'correo'       => $usuario['Correo'],
                'foto_perfil'  => $usuario['Foto_Imagen']
            ];

            header("Location: index.php");
            exit();
        } else {
            $error = "❌ Contraseña incorrecta.";
        }
    } else {
        $error = "⚠️ No se encontró una cuenta con ese correo.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 300px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #0056b3;
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
            color: #007bff;
            text-decoration: none;
        }
        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<form action="login.php" method="POST">
    <h2>Iniciar Sesión</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <input type="email" name="correo" placeholder="Correo electrónico" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>

    <button type="submit">Entrar</button>

    <div class="link">
        ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
    </div>
</form>

</body>
</html>

