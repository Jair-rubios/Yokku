<?php
session_start();
require_once __DIR__ . '/../conexion.php';
if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['rol'] ?? '') !== 'admin') {
    header("Location: ../index.php");
    exit();
}
$id = intval($_GET['id'] ?? 0);
if ($id>0) {
    $res = $conn->query("SELECT Imagen FROM productos WHERE ID_Producto = $id LIMIT 1");
    if ($res && $res->num_rows===1) {
        $r = $res->fetch_assoc();
        if (!empty($r['Imagen']) && file_exists(__DIR__ . '/../' . $r['Imagen'])) {
            @unlink(__DIR__ . '/../' . $r['Imagen']);
        }
    }
    $conn->query("DELETE FROM productos WHERE ID_Producto = $id");
}
header("Location: panel_admin.php?ok=1");
exit();
