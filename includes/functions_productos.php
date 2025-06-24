<?php
require_once __DIR__ . '../sql/pdo_conexion.php';
//Funcion de los productos
function getAllProducto()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM productos");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
 
function getProductoById($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
 
function createProducto($nombre, $descripcion, $cantidad, $precio, $foto)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, cantidad, precio, foto)
                            VALUES (:nombre, :descripcion, :cantidad, :precio, :foto)");
    $stmt->execute([
        'nombre' => $nombre,
        'descripcion' => $descripcion,
        'cantidad' => $cantidad,
        'precio' => $precio,
        'foto' => $foto
    ]);
}
 
function updateProducto($id, $nombre, $descripcion, $cantidad, $precio, $foto)
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE productos SET
        nombre = :nombre,
        descripcion = :descripcion,
        cantidad = :cantidad,
        precio = :precio,
        foto = :foto
        WHERE id = :id");
    $stmt->execute([
        'id' => $id,
        'nombre' => $nombre,
        'descripcion' => $descripcion,
        'cantidad' => $cantidad,
        'precio' => $precio,
        'foto' => $foto
    ]);
}
 
function deleteProducto($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

?>