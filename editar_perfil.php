<?php
session_start();
include "conexion.php";

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$idUsuario = $_SESSION['usuario']['id'];

// Consultar datos actuales del usuario
$sql = "SELECT Nombre, Celular, Correo, Foto_Imagen FROM Usuarios WHERE ID_Usuario = $idUsuario";
$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();
} else {
    echo "⚠️ Error: Usuario no encontrado.";
    exit();
}

// Actualizar datos si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre  = $conn->real_escape_string($_POST['nombre']);
    $celular = $conn->real_escape_string($_POST['celular']);
    $correo  = $conn->real_escape_string($_POST['correo']);

    $nuevaContrasena = $_POST['contrasena'] ?? "";
    $updatePassword = "";
    if (!empty($nuevaContrasena)) {
        $hash = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
        $updatePassword = ", Contrasena = '$hash'";
    }

    // Manejo de nueva imagen si se sube
    $updateFoto = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['foto'];
        $nombreFoto = uniqid() . "_" . basename($foto['name']);
        $rutaDestino = "uploads/" . $nombreFoto;

        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        if (move_uploaded_file($foto['tmp_name'], $rutaDestino)) {
            // Borrar la foto anterior si existe
            if (!empty($usuario['Foto_Imagen']) && file_exists("uploads/" . $usuario['Foto_Imagen'])) {
                unlink("uploads/" . $usuario['Foto_Imagen']);
            }
            $updateFoto = ", Foto_Imagen = '$nombreFoto'";
        }
    }

    // Actualizar en la base de datos
    $sqlUpdate = "UPDATE Usuarios 
                  SET Nombre = '$nombre', Celular = '$celular', Correo = '$correo' 
                      $updatePassword
                      $updateFoto
                  WHERE ID_Usuario = $idUsuario";

    if ($conn->query($sqlUpdate) === TRUE) {
        // Actualizar la sesión para reflejar los cambios en el nav
        $_SESSION['usuario']['nombre'] = $nombre;
        $_SESSION['usuario']['correo'] = $correo;

        if (!empty($updateFoto)) {
            // Obtener el nuevo nombre de la foto (último insertado)
            if (isset($nombreFoto)) {
                $_SESSION['usuario']['foto_perfil'] = $nombreFoto;
            }
        }

        echo "<script>alert('✅ Perfil actualizado correctamente'); window.location='editar_perfil.php';</script>";
        exit();
    } else {
        echo "❌ Error al actualizar: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 320px;
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
        .foto-perfil {
            display: block;
            margin: 0 auto 15px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ccc;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<form action="editar_perfil.php" method="POST" enctype="multipart/form-data">
    <h2>Editar Perfil</h2>

    <img src="uploads/<?php echo htmlspecialchars($usuario['Foto_Imagen']); ?>" 
         alt="Foto de perfil" class="foto-perfil">

    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['Nombre']); ?>" required>

    <label>Celular:</label>
    <input type="tel" name="celular" value="<?php echo htmlspecialchars($usuario['Celular']); ?>">

    <label>Correo electrónico:</label>
    <input type="email" name="correo" value="<?php echo htmlspecialchars($usuario['Correo']); ?>" required>

    <label>Nueva contraseña (opcional):</label>
    <input type="password" name="contrasena" placeholder="Dejar vacío si no se cambia">

    <label>Foto de perfil (opcional):</label>
    <input type="file" name="foto" accept="image/*">

    <button type="submit">Actualizar Perfil</button>
</form>

</body>
</html>



