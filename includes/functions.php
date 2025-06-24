<?php
require_once __DIR__ . '../sql/pdo_conexion.php';

function getAllUsers()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM usuarios");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function usuarioExiste($usuario)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = :usuario");
    $stmt->execute(['usuario' => $usuario]);
    return $stmt->fetchColumn() > 0;
}
 

function getUserById($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createUser($usuario, $nombre, $apellido, $correo, $contrasena, $tipo, $estado)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, nombre, apellido, correo, contrasena, tipo, estado)
                           VALUES (:usuario, :nombre, :apellido, :correo, :contrasena, :tipo, :estado)");
    $stmt->execute([
        'usuario' => $usuario,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'correo' => $correo,
        'contrasena' => password_hash($contrasena, PASSWORD_DEFAULT),
        'tipo' => $tipo,
        'estado' => $estado
    ]);
}

function updateUser($id, $usuario, $nombre, $apellido, $correo, $contrasena, $tipo, $estado)
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE usuarios 
                           SET usuario = :usuario, nombre = :nombre, apellido = :apellido, 
                               correo = :correo, contrasena = :contrasena, tipo = :tipo, estado = :estado 
                           WHERE id = :id");
    $stmt->execute([
        'id' => $id,
        'usuario' => $usuario,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'correo' => $correo,
        'contrasena' => password_hash($contrasena, PASSWORD_DEFAULT),
        'tipo' => $tipo,
        'estado' => $estado
    ]);
}

function deleteUser($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->execute(['id' => $id]);
}
?>
