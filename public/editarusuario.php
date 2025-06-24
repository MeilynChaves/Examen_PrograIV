<?php
include '../includes/auth.php';
include '../includes/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$user = getUserById($id);

if (!$user) {
    echo "Usuario no encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $estado = $_POST['estado'];
    $tipo = $_POST['tipo'];

    updateUser($id, $usuario, $nombre, $apellido, $correo, $contrasena, $tipo, $estado);

    header('Location: Panel.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Usuario</title>
<link rel="stylesheet" href="../assets/css/style.css?v=2025">
</head>
<body>
 
    <h1>✏️ Editar Usuario</h1>
<a href="Panel.php" class="btn-volver">⬅️ Volver al panel</a>
 
    <form method="POST" class="formulario">
        Usuario:
<input type="text" name="usuario" value="<?= htmlspecialchars($user['usuario']) ?>" required>
 
        Nombre:
<input type="text" name="nombre" value="<?= htmlspecialchars($user['nombre']) ?>" required>
 
        Apellido:
<input type="text" name="apellido" value="<?= htmlspecialchars($user['apellido']) ?>" required>
 
        Correo:
<input type="email" name="correo" value="<?= htmlspecialchars($user['correo']) ?>" required>
 
        Contraseña:
<input type="password" name="contrasena" placeholder="Nueva contraseña" required>
 
        Tipo:
<select name="tipo" required>
<option value="admin" <?= $user['tipo'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
<option value="usuario" <?= $user['tipo'] === 'usuario' ? 'selected' : '' ?>>Usuario</option>
</select>
 
        Estado:
<select name="estado" required>
<option value="1" <?= $user['estado'] == 1 ? 'selected' : '' ?>>Activo</option>
<option value="0" <?= $user['estado'] == 0 ? 'selected' : '' ?>>Inactivo</option>
</select>
 
        <button type="submit">Actualizar usuario</button>
</form>
 
</body>
</html>