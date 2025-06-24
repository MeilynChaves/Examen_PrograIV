<?php
 
include '../includes/auth.php';
include '../includes/functions_productos.php';
include '../includes/functions.php';
include '../includes/sql/pdo_conexion.php';
 
 
// Solo permite el acceso a usuarios (no administradores)
if (!isLoggedIn() || !isUsuario()) {

    header("Location: ../public/crear_productos.php"); // O crea una página de acceso denegado
    exit;
}
 
// Obtener productos desde la base de datos
$stmt = $pdo->query("SELECT * FROM productos");
$productos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de Productos</title>
<link rel="stylesheet" href="../assets/css/style.css?v=2025">
</head>
<body class="body-productos">
<div class="contenedor-productos">
<h2 class="titulo">🛍️ Bienvenido</h2>
<h3 class="subtitulo">📦 Listado de Productos</h3>
 
        <p><a href="crear_productos.php" class="btn-agregar">➕ Agregar Nuevo Producto</a></p>
 
        <?php if (count($productos) > 0): ?>
<table class="tabla-productos">
<thead>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Descripción</th>
<th>Cantidad</th>
<th>Precio</th>
<th>Foto</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<?php foreach ($productos as $producto): ?>
<tr>
<td><?= $producto['id']; ?></td>
<td><?= htmlspecialchars($producto['nombre']); ?></td>
<td><?= htmlspecialchars($producto['descripcion']); ?></td>
<td><?= $producto['cantidad']; ?></td>
<td>₡<?= number_format($producto['precio'], 2); ?></td>
<td>
<?php if (!empty($producto['foto'])): ?>
<img src="uploads/<?= htmlspecialchars($producto['foto']); ?>" alt="Foto" class="img-producto">
<?php else: ?>
<span class="sin-foto">No disponible</span>
<?php endif; ?>
</td>
<td>
<a href="editar_productos.php?id=<?= $producto['id']; ?>" class="btn-editar">✏️</a>
<a href="eliminar_productos.php?id=<?= $producto['id']; ?>" class="btn-eliminar" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">🗑️</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php else: ?>
<p class="mensaje-vacio">No hay productos registrados.</p>
<?php endif; ?>
 
        <div class="acciones-finales">
<a href="../public/cerrarsesion.php" class="btn-salir">🚪 Cerrar sesión</a>
</div>
</div>
</body>
</html>