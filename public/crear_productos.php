<?php
require_once '../includes/auth.php';
require_once '../includes/functions_productos.php';
require '../includes/sql/pdo_conexion.php';
 
 $mensaje = "";
 
// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $foto = $_POST['foto']; // imagen seleccionada del stock
 
    // Validar y mover imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $directorio = 'uploads/';
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }
 
        $nombreArchivo = uniqid() . '_' . basename($_FILES['foto']['name']);
        $rutaDestino = $directorio . $nombreArchivo;
 
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
            $foto = $nombreArchivo;
        }
    }
 
    // Guardar en la base de datos
    try {
        $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, cantidad, precio, foto)
                                VALUES (:nombre, :descripcion, :cantidad, :precio, :foto)");
        $stmt->execute([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'foto' => $foto
        ]);
        header("Location: productos.php");
        exit;
    } catch (PDOException $e) {
        $mensaje = "❌ Error al guardar el producto: " . $e->getMessage();
    }
}
?>
 <!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agregar Producto</title>
<link rel="stylesheet" href="../assets/css/style.css?v=2025">
</head>
<body class="body-agregar">
<div class="contenedor-agregar">
<h2 class="titulo">🏋️‍♂️ Agregar Producto</h2>
 
        <?php if ($mensaje): ?>
<p class="mensaje-error"><?= $mensaje ?></p>
<?php endif; ?>
 
        <form method="POST" enctype="multipart/form-data" class="formulario-producto">
<label>Nombre:</label>
<input type="text" name="nombre" required>
 
            <label>Descripción:</label>
<textarea name="descripcion" required></textarea>
 
            <label>Cantidad:</label>
<input type="number" name="cantidad" required>
 
            <label>Precio:</label>
<input type="number" name="precio" step="0.01" required>
 
            <h4 class="subtitulo">📸 Seleccionar imagen del producto:</h4>
 
            <div class="galeria-fotos">
<label class="opcion-foto">
<input type="radio" name="foto" value="banca.png" required>
<img src="uploads/banca.png" alt="Banca de Press">
<span>Banca de Press</span>
</label>
 
                <label class="opcion-foto">
<input type="radio" name="foto" value="gluteo.png">
<img src="uploads/gluteo.png" alt="Tobillera para gluteos">
<span>Tobillera</span>
</label>
 
                <label class="opcion-foto">
<input type="radio" name="foto" value="ligas.png">
<img src="uploads/ligas.png" alt="Bandas elásticas">
<span>Bandas</span>
</label>
 
                <label class="opcion-foto">
<input type="radio" name="foto" value="mancuernas.png">
<img src="uploads/mancuernas.png" alt="Mancuernas">
<span>Mancuernas</span>
</label>
 
                <label class="opcion-foto">
<input type="radio" name="foto" value="maquina.png">
<img src="uploads/maquina.png" alt="Máquina Funcional">
<span>Máquina</span>
</label>
</div>
 
            <input type="submit" value="Guardar" class="btn-guardar">
</form>
 
        <a href="productos.php" class="btn-volver">← Volver a productos</a>
</div>
</body>
</html>

 