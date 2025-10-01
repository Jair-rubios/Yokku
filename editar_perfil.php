<?php
session_start();
include "conexion.php";

// Verificar sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['usuario']['id'];
$mensaje = ""; // guardará el mensaje a mostrar en el popup

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre           = trim($_POST['nombre']);
    $apellido_paterno = trim($_POST['apellido_paterno']);
    $apellido_materno = trim($_POST['apellido_materno']);
    $numero_celular   = trim($_POST['numero_celular']);

    // Validar que no estén vacíos
    if ($nombre == "" || $apellido_paterno == "" || $numero_celular == "") {
        $mensaje = "Termine de rellenar sus nuevos datos por favor";
    } else {
        // Foto de perfil
        $foto = $_SESSION['usuario']['foto_perfil'];
        if (!empty($_FILES['foto_perfil']['name'])) {
            $foto = time() . "_" . basename($_FILES["foto_perfil"]["name"]);
            move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], "uploads/" . $foto);
        }

        $sql = "UPDATE usuarios 
                SET nombre='$nombre',
                    apellido_paterno='$apellido_paterno',
                    apellido_materno='$apellido_materno',
                    numero_celular='$numero_celular',
                    foto_perfil='$foto'
                WHERE id=$id";

        if ($conn->query($sql)) {
            // actualizar datos en sesión
            $_SESSION['usuario']['nombre']           = $nombre;
            $_SESSION['usuario']['apellido_paterno'] = $apellido_paterno;
            $_SESSION['usuario']['apellido_materno'] = $apellido_materno;
            $_SESSION['usuario']['numero_celular']   = $numero_celular;
            $_SESSION['usuario']['foto_perfil']      = $foto;

            $mensaje = "Se ha logrado cambiar los datos exitosamente";
        } else {
            $mensaje = "Error al actualizar: " . $conn->error;
        }
    }
}

// Traer datos actuales
$sql = "SELECT * FROM usuarios WHERE id=$id LIMIT 1";
$result = $conn->query($sql);
$usuario = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="css/universal.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form { max-width: 400px; margin: auto; display: flex; flex-direction: column; gap: 12px; }
        input, button { padding: 10px; font-size: 14px; }
        img { border-radius: 50%; width: 100px; height: 100px; object-fit: cover; display: block; margin: 10px auto; }
    </style>
</head>
<body>
    
    <h2>Editar Perfil</h2>

    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>

        <label>Apellido Paterno</label>
        <input type="text" name="apellido_paterno" value="<?php echo $usuario['apellido_paterno']; ?>" required>

        <label>Apellido Materno</label>
        <input type="text" name="apellido_materno" value="<?php echo $usuario['apellido_materno']; ?>">

        <label>Número de Celular</label>
        <input type="text" name="numero_celular" value="<?php echo $usuario['numero_celular']; ?>" required>

        <label>Foto de perfil actual:</label>
        <img src="uploads/<?php echo $usuario['foto_perfil']; ?>" alt="Foto de perfil">

        <label>Nueva foto de perfil (opcional)</label>
        <input type="file" name="foto_perfil">

        <button type="submit">Guardar cambios</button>
    </form>

    <?php if ($mensaje != ""): ?>
    <script>
        alert("<?php echo $mensaje; ?>");
    </script>
     <script>
        const mensaje = "<?php echo htmlspecialchars($mensaje); ?>";
        alert(mensaje);

        // Si el mensaje indica éxito, redirige después de 6 segundos
        if (mensaje.includes("exitosamente")) {
            setTimeout(() => {
                window.location.href = "index.php";
            }, 4000); 
        }
    </script>
    <?php endif; ?>
</body>
</html>


