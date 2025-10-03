<?php
session_start();
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Validar campos obligatorios
    if (
        isset($_POST['nombre'], $_POST['correo'], $_POST['contrasena']) &&
        isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK
    ) {
        $nombre     = $conn->real_escape_string($_POST['nombre']);
        $celular    = $conn->real_escape_string($_POST['celular'] ?? '');
        $correo     = $conn->real_escape_string($_POST['correo']);
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
        $rol        = "usuario"; // Valor por defecto

        // ---- Subida de imagen ----
        $foto = $_FILES['foto'];
        $nombreFoto = uniqid() . "_" . basename($foto['name']);
        $rutaDestino = "uploads/" . $nombreFoto;

        // Crear carpeta si no existe
        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        if (move_uploaded_file($foto['tmp_name'], $rutaDestino)) {
            // Insertar en la base de datos
            $sql = "INSERT INTO Usuarios (Nombre, Celular, Correo, Contrasena, Foto_Imagen, Rol, Fecha_Registro)
                    VALUES ('$nombre', '$celular', '$correo', '$contrasena', '$nombreFoto', '$rol', NOW())";

            if ($conn->query($sql) === TRUE) {
                // ✅ Obtener el ID del nuevo usuario
                $nuevo_id = $conn->insert_id;

                // ✅ Consultar los datos completos para guardarlos en la sesión
                $consulta = "SELECT ID_Usuario, Nombre, Correo, Foto_Imagen FROM Usuarios WHERE ID_Usuario = $nuevo_id";
                $resultado = $conn->query($consulta);

                if ($resultado && $resultado->num_rows === 1) {
                    $usuario = $resultado->fetch_assoc();

                    // ✅ Guardar en sesión
                    $_SESSION['usuario'] = [
                        'id'           => $usuario['ID_Usuario'],
                        'nombre'       => $usuario['Nombre'],
                        'correo'       => $usuario['Correo'],
                        'foto_perfil'  => $usuario['Foto_Imagen']
                    ];

                    // ✅ Redirigir al index
                    header("Location: index.php");
                    exit();
                } else {
                    echo "⚠️ Error al obtener los datos del usuario.";
                }
            } else {
                echo "❌ Error al registrar en BD: " . $conn->error;
            }
        } else {
            echo "❌ Error al subir la imagen al servidor.";
        }
    } else {
        echo "⚠️ Faltan datos obligatorios o error en la imagen.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
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
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<form action="registro.php" method="POST" enctype="multipart/form-data">
    <h2>Registro de Usuario</h2>

    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="tel" name="celular" placeholder="Celular">
    <input type="email" name="correo" placeholder="Correo electrónico" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required minlength="10">

    <label for="foto">Foto de perfil:</label>
    <input type="file" name="foto" accept="image/*" required>

    <button type="submit">Registrarse</button>
</form>

</body>
</html>




