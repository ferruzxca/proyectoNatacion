<?php
session_start();
require_once '../database/conexion.php';

// Validación de sesión
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] !== 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

// Validar ID
if (!isset($_GET['id'])) {
    echo "<script>alert('ID no especificado.'); window.location.href='gestionar_usuarios.php';</script>";
    exit();
}

$id = $_GET['id'];

// Inhabilitar usuario
$stmt = $conn->prepare("UPDATE usuarios SET estado = 0 WHERE id = ?");
if ($stmt->execute([$id])) {
    header("Location: gestionar_usuarios.php");
    exit();
} else {
    echo "<script>alert('Error al inhabilitar el usuario.'); window.location.href='gestionar_usuarios.php';</script>";
    exit();
}
