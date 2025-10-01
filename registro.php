<?php
session_start();
include "conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre          = $_POST['nombre'];
    $apellido_paterno= $_POST['apellido_paterno'];
    $apellido_materno= $_POST['apellido_materno'];
    $numero_celular  = $_POST['numero_celular'];
    $correo          = $_POST['correo'];
    $contrasena      = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    // Subida de imagen
    $foto = "default.png";
    if (!empty($_FILES['foto_perfil']['name'])) {
        $foto = time() . "_" . basename($_FILES["foto_perfil"]["name"]);
        move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], "uploads/" . $foto);
    }

    $sql = "INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, numero_celular, correo, contrasena, foto_perfil, rol) 
            VALUES ('$nombre','$apellido_paterno','$apellido_materno','$numero_celular','$correo','$contrasena','$foto','usuario')";

    if ($conn->query($sql)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h2>Crear Cuenta</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="nombre" placeholder="Nombre" required><br>
        <input type="text" name="apellido_paterno" placeholder="Apellido Paterno" required><br>
        <input type="text" name="apellido_materno" placeholder="Apellido Materno"><br>
        <input type="tel" name="numero_celular" placeholder="Número de Celular" required><br>
        <input type="email" name="correo" placeholder="Correo" required><br>
        <input type="password" name="contrasena" placeholder="Contraseña" required><br>
        <input type="password" name="confirmar" placeholder="Confirmar Contraseña" required><br>
        <input type="file" name="foto_perfil"><br><br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
