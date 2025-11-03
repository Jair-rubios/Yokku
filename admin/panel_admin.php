<?php
session_start();
require_once __DIR__ . '/../conexion.php';

// Protección: solo admin
if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['rol'] ?? '') !== 'admin') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Panel Admin - Productos</title>
  <link rel="stylesheet" href="admin.css">
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
  <style> /* Pequeño override para íconos inline */ .small-muted{ color:#64748b; font-size:13px; }</style>
</head>
<body>
<div class="admin-shell">
  <aside class="sidebar card">
    <div class="brand">
      <img src="../imagenes/Logo YOKKU.png" alt="logo">
      <h3>YOKKU Admin</h3>
    </div>
    <a class="nav-link" href="panel_admin.php">📦 Productos</a>
    <a class="nav-link" href="agregar_producto.php">➕ Agregar producto</a>
    <a class="nav-link" href="usuarios.php">Agregar Admin</a>
    <a class="nav-link" href="logout.php">🚪 Cerrar sesión</a>
  </aside>

  <main class="main">
    <div class="header">
      <h1>Productos</h1>
      <div class="topbar-actions">
        <a href="agregar_producto.php" class="btn btn-primary">➕ Nuevo producto</a>
      </div>
    </div>

    <div class="card">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Colección</th>
            <th>Precio</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $res = $conn->query("SELECT * FROM productos ORDER BY ID_Producto DESC");
            while($r = $res->fetch_assoc()):
          ?>
            <tr>
              <td><?= $r['ID_Producto'] ?></td>
              <td><img src="../<?= htmlspecialchars($r['Imagen']) ?>" alt="" /></td>
              <td><?= htmlspecialchars($r['Nombre_Producto']) ?></td>
              <td><?= htmlspecialchars($r['Coleccion']) ?></td>
              <td>$<?= number_format($r['Precio'],2) ?></td>
              <td class="actions">
                <a class="btn btn-primary" href="editar_producto.php?id=<?= $r['ID_Producto'] ?>">Editar</a>
                <a class="btn btn-danger" href="eliminar_producto.php?id=<?= $r['ID_Producto'] ?>" onclick="return confirm('Eliminar producto?')">Eliminar</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>

<!-- toast container -->
<div id="toast" class="toast" style="display:none"></div>

<script>
function showToast(msg){
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.style.display = 'block';
  setTimeout(()=> t.classList.add('show'), 20);
  setTimeout(()=> { t.classList.remove('show'); setTimeout(()=> t.style.display='none',300); }, 2500);
}
<?php if(isset($_GET['ok']) && $_GET['ok']==='1'): ?>
  showToast('✔️ Operación exitosa');
<?php endif; ?>
</script>
</body>
</html>
