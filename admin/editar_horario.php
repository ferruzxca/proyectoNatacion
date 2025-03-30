<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

include '../includes/navbar.php';

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID de horario no proporcionado.</div>";
    exit();
}

$id = $_GET['id'];

$sql = $conn->prepare("SELECT * FROM horarios WHERE id = ?");
$sql->execute([$id]);
$horario = $sql->fetch(PDO::FETCH_ASSOC);

if (!$horario) {
    echo "<div class='alert alert-warning'>Horario no encontrado.</div>";
    exit();
}

// Si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dia = $_POST['dia'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $actividad = $_POST['actividad'];

    $update = $conn->prepare("UPDATE horarios SET dia=?, hora_inicio=?, hora_fin=?, actividad=? WHERE id=?");
    $update->execute([$dia, $hora_inicio, $hora_fin, $actividad, $id]);

    header("Location: gestionar_horarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Horario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #f0f8ff, #dbeafe);
        }
        .card {
            margin-top: 50px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4 mx-auto" style="max-width: 600px;">
        <h3 class="text-center mb-4"><i class="bi bi-calendar-check"></i> Editar Horario</h3>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Día</label>
                <input type="text" name="dia" class="form-control" value="<?= htmlspecialchars($horario['dia']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Hora de Inicio</label>
                <input type="time" name="hora_inicio" class="form-control" value="<?= $horario['hora_inicio'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Hora de Fin</label>
                <input type="time" name="hora_fin" class="form-control" value="<?= $horario['hora_fin'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Actividad</label>
                <input type="text" name="actividad" class="form-control" value="<?= htmlspecialchars($horario['actividad']) ?>" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill"></i> Guardar Cambios</button>
                <a href="gestionar_horarios.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Volver</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
