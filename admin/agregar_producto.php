<?php
session_start();
require_once __DIR__ . '/../conexion.php';
if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['rol'] ?? '') !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $coleccion = $conn->real_escape_string($_POST['coleccion']);
    $precio = floatval($_POST['precio']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);

    // manejar imagen
    if (!is_dir(__DIR__ . '/../uploads_productos')) mkdir(__DIR__ . '/../uploads_productos', 0777, true);

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nombreArchivo = uniqid('prod_') . '.' . $ext;
        $dest = __DIR__ . '/../uploads_productos/' . $nombreArchivo;
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $dest)) {
            $ruta_db = 'uploads_productos/' . $nombreArchivo;

            $stmt = $conn->prepare("INSERT INTO productos (Nombre_Producto, Precio, Imagen, Coleccion, Descripcion) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sdsss", $nombre, $precio, $ruta_db, $coleccion, $descripcion);
            if ($stmt->execute()) {
                header("Location: panel_admin.php?ok=1");
                exit();
            } else {
                $mensaje = "Error al guardar: " . $conn->error;
            }
        } else {
            $mensaje = "Error al subir la imagen.";
        }
    } else {
        $mensaje = "Selecciona una imagen.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Agregar Producto</title>
<link rel="stylesheet" href="admin.css">
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
<div class="admin-shell">
  <aside class="sidebar card">
    <div class="brand"><img src="../imagenes/Logo YOKKU.png"><h3>YOKKU Admin</h3></div>
    <a class="nav-link" href="panel_admin.php">📦 Productos</a>
    <a class="nav-link active" href="agregar_producto.php">➕ Agregar producto</a>
    <a class="nav-link" href="logout.php">🚪 Cerrar sesión</a>
  </aside>

  <main class="main">
    <div class="header"><h1>Agregar producto</h1></div>

    <div class="card">
      <?php if($mensaje): ?><div style="color:red;margin-bottom:12px;"><?=htmlspecialchars($mensaje)?></div><?php endif; ?>
      <form method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col"><label>Nombre</label><input type="text" name="nombre" required></div>
          <div class="col"><label>Colección</label><input type="text" name="coleccion"></div>
        </div>

        <label>Precio</label><input type="number" step="0.01" name="precio" required>

        <label>Descripción</label><textarea name="descripcion"></textarea>

        <label>Imagen</label><input type="file" name="imagen" accept="image/*" required>

        <div style="margin-top:12px;">
          <button class="btn btn-primary" type="submit">Guardar producto</button>
          <a class="btn btn-warning" href="panel_admin.php" style="background:#64748b;">Cancelar</a>
        </div>
      </form>
    </div>
  </main>
</div>

<!-- toast -->
<div id="toast" class="toast" style="display:none"></div>
<script>
function showToast(msg){ const t=document.getElementById('toast'); t.textContent=msg; t.style.display='block'; setTimeout(()=>t.classList.add('show'),20); setTimeout(()=>{ t.classList.remove('show'); setTimeout(()=>t.style.display='none',300);},2500);}
</script>
</body>
</html>
