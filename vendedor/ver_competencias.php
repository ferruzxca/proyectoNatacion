<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ver_competencias.php</title>
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

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';


$sql = $conn->query("SELECT * FROM competencias ORDER BY fecha DESC");
$competencias = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Competencias Acuáticas</h2>
<a href="dashboard.php">← Volver</a><br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($competencias as $c): ?>
        <tr>
            <td><?= $c['nombre'] ?></td>
            <td><?= $c['fecha'] ?></td>
            <td><?= $c['descripcion'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
