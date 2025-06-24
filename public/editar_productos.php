<?php
include '../includes/auth.php';
include '../includes/functions_productos.php';
require '../includes/sql/pdo_conexion.php';

// Solo usuarios normales pueden acceder
if (!isLoggedIn() || !isUsuario()) {
    header('Location: productos.php');
    exit;
}

// Validar ID
$id = $_GET['id'] ?? null;
$productos = getProductoById($id);

if (!$productos) {
    echo "Producto no encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $foto = $productos['foto']; // Por defecto, conservar imagen actual

    // Si seleccionó una imagen del stock
    if (!empty($_POST['foto_stock'])) {
        $foto = $_POST['foto_stock'];
    }

    // Si subió una nueva imagen personalizada
    if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $directorio = 'uploads/';
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        $nombreArchivo = uniqid() . '_' . basename($_FILES['foto']['name']);
        $rutaDestino = $directorio . $nombreArchivo;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
            // Eliminar la imagen anterior si no era del stock
            $imagenesStock = ['banca.png', 'gluteo.png', 'ligas.png', 'mancuernas.png', 'maquina.png'];
            if (!in_array($productos['foto'], $imagenesStock) && file_exists($directorio . $productos['foto'])) {
                unlink($directorio . $productos['foto']);
            }

            $foto = $nombreArchivo;
        }
    }

    // Actualizar producto
    updateProducto($id, $nombre, $descripcion, $cantidad, $precio, $foto);
    header('Location: productos.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Producto</title>
<link rel="stylesheet" href="../assets/css/style.css?v=2025">
</head>
<body>
 
    <div class="contenedor-formulario">
<h1>🛠️ Editar Producto</h1>
<a href="productos.php" class="btn-volver">⬅️ Volver a productos</a>
 
        <form method="POST" enctype="multipart/form-data" class="formulario-producto">
 
            <label>Nombre:</label>
<input type="text" name="nombre" value="<?= htmlspecialchars($productos['nombre']) ?>" required>
 
            <label>Descripción:</label>
<textarea name="descripcion" required><?= htmlspecialchars($productos['descripcion']) ?></textarea>
 
            <label>Cantidad:</label>
<input type="number" name="cantidad" value="<?= $productos['cantidad'] ?>" required>
 
            <label>Precio:</label>
<input type="number" name="precio" step="0.01" value="<?= $productos['precio'] ?>" required>
 
            <h4>📌 Imagen actual:</h4>
<?php if (!empty($productos['foto'])): ?>
<img src="uploads/<?= htmlspecialchars($productos['foto']) ?>" alt="Foto actual" class="imagen-actual">
<?php else: ?>
<p>No disponible</p>
<?php endif; ?>
 
            <h4>🖼️ Seleccionar imagen del stock:</h4>
<div class="galeria-stock">
<?php
                $imagenesStock = ['banca.png', 'gluteo.png', 'ligas.png', 'mancuernas.png', 'maquina.png'];
                foreach ($imagenesStock as $img): ?>
<label class="opcion-foto">
<input type="radio" name="foto_stock" value="<?= $img ?>" <?= ($productos['foto'] === $img) ? 'checked' : '' ?>>
<img src="uploads/<?= $img ?>" alt="<?= $img ?>">
<div><?= ucfirst(str_replace('.png', '', $img)) ?></div>
</label>
<?php endforeach; ?>
</div>
 
            <h4>📤 O subir una nueva imagen personalizada:</h4>
<input type="file" name="foto" accept="image/*">
 
            <br><br>
<button type="submit" class="btn-guardar">💾 Actualizar producto</button>
</form>
</div>
 
</body>
</html>