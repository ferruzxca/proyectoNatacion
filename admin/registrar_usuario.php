<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>registrar_usuario.php</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f0f8ff, #dbeafe);
        }
        header, footer {
            background-color: #0077b6;
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
        nav a {
            margin: 10px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        section {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-4 mb-5">
<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $password = hash('sha256', $_POST['password']);
    $nivel = $_POST['nivel'];

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, usuario, password, nivel) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $usuario, $password, $nivel]);

    header("Location: gestionar_usuarios.php");
    exit();
}
?>

<h2>Registrar Nuevo Usuario</h2>
<form method="post">
    <input type="text" name="nombre" placeholder="Nombre completo" required><br>
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="password" placeholder="Contraseña" required><br>
    <select name="nivel" required>
        <option value="">-- Selecciona Nivel --</option>
        <option value="Administrador">Administrador</option>
        <option value="Vendedor">Vendedor</option>
        <option value="Cliente">Cliente</option>
    </select><br>
    <button type="submit">Registrar</button>
</form>
<a href="gestionar_usuarios.php">← Volver</a>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
