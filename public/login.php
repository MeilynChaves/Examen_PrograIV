<?php
include '../includes/auth.php'; // inicia sesión y conexión
$mensaje = "";
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $contrasena = $_POST['contrasena'];
 
    if (login($usuario, $contrasena)) {
        // Redirigir según el tipo de usuario
        if ($_SESSION['tipo'] === 'admin') {
            header("Location: Panel.php");
        } elseif ($_SESSION['tipo'] === 'usuario') {
            header("Location: crear_productos.php");
        } else {
            $mensaje = "⚠️ Tipo de usuario no reconocido.";
        }
        exit;
    } else {
        $mensaje = "❌ Usuario o contraseña incorrectos o cuenta inactiva.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Iniciar Sesión</title>
<link rel="stylesheet" href="../assets/css/style.css?v=2025">
</head>
<body class="login-body">
<div class="login-container">
<h1 class="login-title">🔐 Iniciar Sesión</h1>
 
        <?php if (!empty($mensaje)): ?>
<p class="mensaje-error"><?= htmlspecialchars($mensaje) ?></p>
<?php endif; ?>
 
        <form method="POST" class="login-form">
<label>Usuario:</label>
<input type="text" name="usuario" required>
 
            <label>Contraseña:</label>
<input type="password" name="contrasena" required>
 
            <input type="submit" value="Ingresar" class="btn-login">
</form>
 
        <p class="registro-link">
            ¿No tienes cuenta? <a href="registrarusuario.php">Registrar Nuevo Usuario</a>
</p>
</div>
</body>
</html>



