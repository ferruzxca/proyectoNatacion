<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] !== 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>alert('ID no proporcionado'); window.location.href='gestionar_promociones.php';</script>";
    exit();
}

$id = $_GET['id'];

$delete = $conn->prepare("DELETE FROM promociones WHERE id = ?");
$delete->execute([$id]);

header("Location: gestionar_promociones.php");
exit();
