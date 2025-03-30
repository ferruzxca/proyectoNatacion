<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>editar_rehabilitacion.php</title>
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

$id = $_GET['id'];
$sql = $conn->prepare("SELECT * FROM rehabilitacion WHERE id = ?");
$sql->execute([$id]);
$s = $sql->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paciente = $_POST['paciente_nombre'];
    $fecha = $_POST['fecha'];
    $terapia = $_POST['tipo_terapia'];
    $obs = $_POST['observaciones'];

    $stmt = $conn->prepare("UPDATE rehabilitacion SET paciente_nombre=?, fecha=?, tipo_terapia=?, observaciones=? WHERE id=?");
    $stmt->execute([$paciente, $fecha, $terapia, $obs, $id]);

    header("Location: gestionar_rehabilitacion.php");
    exit();
}
include '../includes/navbar.php';

?>

<h2>Editar Sesión de Rehabilitación</h2>
<form method="post">
    <input type="text" name="paciente_nombre" value="<?= $s['paciente_nombre'] ?>" required><br>
    <input type="date" name="fecha" value="<?= $s['fecha'] ?>" required><br>
    <input type="text" name="tipo_terapia" value="<?= $s['tipo_terapia'] ?>" required><br>
    <textarea name="observaciones" required><?= $s['observaciones'] ?></textarea><br>
    <button type="submit">Actualizar</button>
</form>
<a href="gestionar_rehabilitacion.php">← Volver</a>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
