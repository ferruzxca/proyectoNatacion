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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Rehabilitación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #f0f8ff, #dbeafe);
        }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Editar Sesión de Rehabilitación
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Nombre del Paciente</label>
                            <input type="text" name="paciente_nombre" class="form-control" value="<?= htmlspecialchars($s['paciente_nombre']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" name="fecha" class="form-control" value="<?= $s['fecha'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipo de Terapia</label>
                            <input type="text" name="tipo_terapia" class="form-control" value="<?= htmlspecialchars($s['tipo_terapia']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones" class="form-control" rows="3" required><?= htmlspecialchars($s['observaciones']) ?></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="gestionar_rehabilitacion.php" class="btn btn-outline-secondary">← Volver</a>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>