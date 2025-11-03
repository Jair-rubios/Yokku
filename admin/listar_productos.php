<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de Productos</title>
<style>
table {
  border-collapse: collapse;
  width: 90%;
  margin: auto;
}
th, td {
  border: 1px solid #ccc;
  padding: 10px;
  text-align: center;
}
img {
  width: 80px;
  height: auto;
  border-radius: 8px;
}
a {
  text-decoration: none;
  padding: 5px 10px;
  border-radius: 6px;
  color: white;
}
.editar { background: #007bff; }
.eliminar { background: #dc3545; }
</style>
</head>
<body>
<h2 style="text-align:center;">Lista de Productos</h2>
<a href="agregar_producto.php" style="display:block;text-align:center;margin-bottom:20px;">+ Agregar nuevo producto</a>
<table>
<tr>
  <th>ID</th>
  <th>Imagen</th>
  <th>Nombre</th>
  <th>Colección</th>
  <th>Precio</th>
  <th>Acciones</th>
</tr>

<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$result = $conn->query("SELECT * FROM productos");
while ($row = $result->fetch_assoc()) {
  echo "<tr>
    <td>{$row['ID_Producto']}</td>
    <td><img src='{$row['Imagen']}'></td>
    <td>{$row['Nombre_Producto']}</td>
    <td>{$row['Coleccion']}</td>
    <td>\${$row['Precio']}</td>
    <td>
      <a class='editar' href='editar_producto.php?id={$row['ID_Producto']}'>Editar</a>
      <a class='eliminar' href='eliminar_producto.php?id={$row['ID_Producto']}'>Eliminar</a>
    </td>
  </tr>";
}
?>
</table>
</body>
</html>
