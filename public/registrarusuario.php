<?php
include '../includes/auth.php';
include '../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $correo = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];

    // Validación simple
    if (!$usuario || !$nombre || !$apellido || !$correo || !$contrasena) {
        echo "❌ Por favor llena todos los campos.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "❌ Correo electrónico no válido.";
    } else {
        try {
            createUser($usuario, $nombre, $apellido, $correo, $contrasena, $tipo, $estado);
            header('Location: Panel.php');
            exit;
        } catch (PDOException $e) {
            echo "❌ Error al registrar: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Registro de Usuario</title>
<link rel="stylesheet" href="../assets/css/style.css?v=2025">
</head>
<body class="form-dark">
<div class="registro-container">
<h2 class="titulo-form">📝 Registro de Usuario</h2>
 
        <form method="POST" class="formulario-dark">
<label>Usuario:</label>
<input type="text" name="usuario" required>
 
            <label>Nombre:</label>
<input type="text" name="nombre" required>
 
            <label>Apellidos:</label>
<input type="text" name="apellido" required>
 
            <label>Correo:</label>
<input type="email" name="correo" required>
 
            <label>Contraseña:</label>
<input type="password" name="contrasena" required>
 
            <label>Tipo:</label>
<select name="tipo">
<option value="admin">Administrador</option>
<option value="usuario" selected>Usuario</option>
</select>
 
            <label>Estado:</label>
<select name="estado">
<option value="0">Inactivo</option>
<option value="1" selected>Activo</option>
</select>
 
            <input type="submit" value="Registrar" class="btn-neon">
<a href="login.php" class="btn-secundario">Iniciar con Cuenta</a>
</form>
</div>
</body>
</html>






