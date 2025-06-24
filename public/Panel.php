<?php
include '../includes/auth.php';
include '../includes/functions.php';
include '../includes/functions_productos.php';

// Si no ha iniciado sesión, redirige al login
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}
 
// Redirige según el tipo de usuario
if (isAdmin()) {
// Continúa con el panel de administración
    $users = getAllUsers();
} elseif (isUsuario()) {
    header('Location: crear_productos.php');
    exit;
}
 
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel de Administración</title>
<link rel="stylesheet" href="../assets/css/style.css?v=2025">
</head>
<body class="admin-body">
<div class="admin-panel">
<div class="admin-encabezado">
<h1 class="admin-titulo">🛠️ Bienvenido, Administrador</h1>
<div class="admin-controles">
<a href="registrarusuario.php" class="btn-verde">➕ Crear nuevo usuario</a>
<a href="cerrarsesion.php" class="btn-morado">🔓 Cerrar sesión</a>
</div>
</div>
 
        <table class="tabla-admin">
<thead>
<tr>
<th>ID</th>
<th>Usuario</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Correo</th>
<th>Tipo</th>
<th>Estado</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<?php foreach ($users as $user): ?>
<tr>
<td><?= $user['id'] ?></td>
<td><?= htmlspecialchars($user['usuario']) ?></td>
<td><?= htmlspecialchars($user['nombre']) ?></td>
<td><?= htmlspecialchars($user['apellido']) ?></td>
<td><?= htmlspecialchars($user['correo']) ?></td>
<td><?= htmlspecialchars($user['tipo']) ?></td>
<td>
<?= $user['estado'] == 1 ? '<span class="estado activo">🟢 Activo</span>' : '<span class="estado inactivo">🔴 Inactivo</span>' ?>
</td>
<td>
<a href="editarusuario.php?id=<?= (int)$user['id'] ?>" class="btn-editar">✏️</a>
<a href="borrarusuario.php?id=<?= (int)$user['id'] ?>" class="btn-eliminar" onclick="return confirm('¿Eliminar este usuario?');">🗑️</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</body>
</html>
