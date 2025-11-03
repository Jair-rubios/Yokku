<?php
session_start();
include "../conexion.php"; // conexión a la base de datos

// Verifica si el usuario logueado es admin
if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['rol'] ?? '') !== 'admin') {
    header("Location: ../index.php");
    exit();
}


// Buscar usuarios por nombre o correo
$busqueda = "";
if (isset($_GET['buscar']) && !empty(trim($_GET['buscar']))) {
    $busqueda = trim($_GET['buscar']);
    $sql = "SELECT ID_Usuario, Nombre, Correo, Rol, Foto_Imagen
            FROM usuarios 
            WHERE Nombre LIKE ? OR Correo LIKE ?
            ORDER BY ID_Usuario DESC";
    $stmt = $conn->prepare($sql);
    $like = "%$busqueda%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT ID_Usuario, Nombre, Correo, Rol, Foto_Imagen FROM usuarios ORDER BY ID_Usuario DESC");
}

// Cambiar rol desde botón
if (isset($_GET['accion']) && isset($_GET['ID_Usuario'])) {
    $id = intval($_GET['ID_Usuario']);
    $accion = $_GET['accion'];

    if ($accion === "hacer_admin") {
        $sql = "UPDATE usuarios SET rol = 'admin' WHERE ID_Usuario = ?";
    } elseif ($accion === "quitar_admin") {
        $sql = "UPDATE usuarios SET rol = 'usuario' WHERE ID_Usuario = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Usuarios</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="icon" type="image/x-icon" href="../imagenes/Logo YOKKU.png">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Comfortaa", sans-serif;
            margin: 0;
            background: #f3f3f3;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 230px;
            background: #222;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 22px;
            color: #ffcc00;
        }

        .sidebar nav a {
            color: #ddd;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: 0.3s;
        }

        .sidebar nav a:hover, .sidebar nav a.activo {
            background: #ffcc00;
            color: #222;
            font-weight: bold;
        }

        /* Contenido */
        .contenido {
            flex: 1;
            padding: 30px;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        /* Buscador */
        .buscador {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }

        .buscador input {
            flex: 1;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        .buscador button {
            background: #ffcc00;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .buscador button:hover {
            background: #ffb300;
        }

        /* Tabla */
        .tabla-admin {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .tabla-admin th, .tabla-admin td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .tabla-admin th {
            background: #333;
            color: #fff;
        }

        .mini-foto {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn-asignar, .btn-quitar {
            padding: 6px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .btn-asignar {
            background: #28a745;
        }

        .btn-asignar:hover {
            background: #218838;
        }

        .btn-quitar {
            background: #dc3545;
        }

        .btn-quitar:hover {
            background: #c82333;
        }

        .no-resultados {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="admin-wrapper">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Panel Admin</h2>
        <nav>
            <a href="panel_admin.php">🏠 Inicio</a>
            <a href="productos.php">🍱 Productos</a>
            <a href="usuarios.php" class="activo">👥 Usuarios</a>
            <a href="../logout.php">🚪 Cerrar sesión</a>
        </nav>
    </aside>

    <!-- Contenido principal -->
    <main class="contenido">
        <h1>👥 Gestión de Usuarios</h1>

        <form class="buscador" method="GET" action="usuarios.php">
            <input type="text" name="buscar" placeholder="Buscar por nombre o correo..." value="<?= htmlspecialchars($busqueda) ?>">
            <button type="submit">🔍 Buscar</button>
        </form>

        <?php if ($result && $result->num_rows > 0): ?>
        <table class="tabla-admin">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php if (!empty($row['Foto_Imagen'])): ?>
                            <img src="../<?= htmlspecialchars($row['Foto_Imagen']); ?>" alt="Foto" class="mini-foto">
                        <?php else: ?>
                            <img src="../uploads" alt="Sin foto" class="mini-foto">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['Nombre']); ?></td>
                    <td><?= htmlspecialchars($row['Correo']); ?></td>
                    <td><?= htmlspecialchars($row['Rol']); ?></td>
                    <td>
                        <?php if ($row['Rol'] === 'admin'): ?>
                            <a href="?accion=quitar_admin&ID_Usuario=<?= $row['ID_Usuario']; ?>" class="btn-quitar">Quitar admin</a>
                        <?php else: ?>
                            <a href="?accion=hacer_admin&ID_Usuario=<?= $row['ID_Usuario']; ?>" class="btn-asignar">Hacer admin</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
            <div class="no-resultados">No se encontraron usuarios con admin.</div>
        <?php endif; ?>
    </main>
</div>
</body>
</html>