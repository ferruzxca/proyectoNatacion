<?php
session_start();
require_once '../database/conexion.php';
include '../includes/navbar.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] !== 'Cliente') {
    header("Location: ../auth/login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$cliente_id = $_SESSION['id']; // Asegúrate de guardar el id del cliente al iniciar sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'];
    $terapia = $_POST['tipo_terapia'];
    $observaciones = $_POST['observaciones'];

    $stmt = $conn->prepare("INSERT INTO rehabilitacion (cliente_id, paciente_nombre, fecha, tipo_terapia, observaciones) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$cliente_id, $usuario, $fecha, $terapia, $observaciones]);

    $success = true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar Rehabilitación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(120deg, #f0f8ff, #dbeafe); }
        .card { box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 10px; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card p-4">
        <h3 class="text-center mb-4">🩺 Agendar Rehabilitación</h3>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">Cita agendada exitosamente ✅</div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Fecha:</label>
                <input type="date" name="fecha" class="form-control" required min="<?= date('Y-m-d') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de Terapia:</label>
                <select name="tipo_terapia" class="form-select" required>
                    <option value="">-- Selecciona --</option>
                    <option>Electroterapia</option>
                    <option>Hidroterapia</option>
                    <option>Ultrasonido terapéutico</option>
                    <option>Masoterapia</option>
                    <option>Ejercicios terapéuticos</option>
                    <option>Reeducación postural</option>
                    <option>Termoterapia</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Observaciones:</label>
                <textarea name="observaciones" class="form-control" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-success w-100"><i class="bi bi-calendar-check"></i> Agendar Cita</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
