<?php
session_start();
require_once '../database/conexion.php';

// Validar sesión de administrador
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] !== 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

// Validar existencia del ID
if (!isset($_GET['id'])) {
    echo "<script>alert('ID no especificado.'); window.location.href='gestionar_usuarios.php';</script>";
    exit();
}

$id = $_GET['id'];

// Actualizar estado a activo (1)
$stmt = $conn->prepare("UPDATE usuarios SET estado = 1 WHERE id = ?");
if ($stmt->execute([$id])) {
    header("Location: gestionar_usuarios.php");
    exit();
} else {
    echo "<script>alert('Error al reactivar el usuario.'); window.location.href='gestionar_usuarios.php';</script>";
    exit();
}
