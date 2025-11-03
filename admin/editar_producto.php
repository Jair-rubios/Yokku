<?php
session_start();
require_once __DIR__ . '/../conexion.php';
if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['rol'] ?? '') !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$id = intval($_GET['id'] ?? 0);
$res = $conn->query("SELECT * FROM productos WHERE ID_Producto = $id");
if (!$res || $res->num_rows !== 1) {
    header("Location: panel_admin.php");
    exit();
}
$prod = $res->fetch_assoc();
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $coleccion = $conn->real_escape_string($_POST['coleccion']);
    $precio = floatval($_POST['precio']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $ruta_db = $prod['Imagen'];

    if (!is_dir(__DIR__ . '/../uploads_productos')) mkdir(__DIR__ . '/../uploads_productos', 0777, true);

    if (!empty($_FILES['imagen']['name']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nombreArchivo = uniqid('prod_') . '.' . $ext;
        $dest = __DIR__ . '/../uploads_productos/' . $nombreArchivo;
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $dest)) {
            // borrar anterior si existe
            if (!empty($ruta_db) && file_exists(__DIR__ . '/../' . $ruta_db)) {
                @unlink(__DIR__ . '/../' . $ruta_db);
            }
            $ruta_db = 'uploads_productos/' . $nombreArchivo;
        }
    }

    $stmt = $conn->prepare("UPDATE productos SET Nombre_Producto=?, Precio=?, Imagen=?, Coleccion=?, Descripcion=? WHERE ID_Producto=?");
    $stmt->bind_param("sdsssi", $nombre, $precio, $ruta_db, $coleccion, $descripcion, $id);
    if ($stmt->execute()) {
        header("Location: panel_admin.php?ok=1");
        exit();
    } else {
        $mensaje = "Error al actualizar: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Editar Producto</title>
<link rel="stylesheet" href="admin.css">
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
<div class="admin-shell">
  <aside class="sidebar card">
    <div class="brand"><img src="../imagenes/Logo YOKKU.png"><h3>YOKKU Admin</h3></div>
    <a class="nav-link" href="panel_admin.php">📦 Productos</a>
    <a class="nav-link" href="agregar_producto.php">➕ Agregar producto</a>
    <a class="nav-link" href="logout.php">🚪 Cerrar sesión</a>
  </aside>

  <main class="main">
    <div class="header"><h1>Editar producto</h1></div>

    <div class="card">
      <?php if($mensaje): ?><div style="color:red;margin-bottom:12px;"><?=htmlspecialchars($mensaje)?></div><?php endif; ?>
      <form method="POST" enctype="multipart/form-data">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?=htmlspecialchars($prod['Nombre_Producto'])?>" required>

        <div class="form-row">
          <div class="col">
            <label>Colección</label>
            <input type="text" name="coleccion" value="<?=htmlspecialchars($prod['Coleccion'])?>">
          </div>
          <div class="col">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" value="<?=htmlspecialchars($prod['Precio'])?>" required>
          </div>
        </div>

        <label>Descripción</label>
        <textarea name="descripcion"><?=htmlspecialchars($prod['Descripcion'])?></textarea>

        <label>Imagen actual</label><br>
        <?php if(!empty($prod['Imagen'])): ?>
          <img src="../<?=htmlspecialchars($prod['Imagen'])?>" style="width:140px;border-radius:8px;margin-bottom:8px;">
        <?php endif; ?>

        <label>Reemplazar imagen (opcional)</label>
        <input type="file" name="imagen" accept="image/*">

        <div style="margin-top:12px;">
          <button class="btn btn-primary" type="submit">Guardar cambios</button>
          <a href="panel_admin.php" class="btn btn-warning" style="background:#64748b;">Cancelar</a>
        </div>
      </form>
    </div>
  </main>
</div>
</body>
</html>
