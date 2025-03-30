<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

$sql = $conn->query("SELECT * FROM horarios ORDER BY FIELD(dia, 'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo')");
$horarios = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ver_horarios.php</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #caf0f8);
        }
        .titulo {
            text-align: center;
            margin-top: 30px;
        }
        .table thead {
            background-color: #0077b6;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="titulo">Consulta de Horarios</h2>

    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-outline-primary"><i class="bi bi-arrow-left-circle"></i> Volver al Panel</a>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Horarios de Actividades
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($horarios as $h): ?>
                    <tr>
                        <td><?= $h['dia'] ?></td>
                        <td><?= $h['hora_inicio'] ?></td>
                        <td><?= $h['hora_fin'] ?></td>
                        <td><?= $h['actividad'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($horarios)): ?>
                        <tr><td colspan="4" class="text-center text-muted">No hay horarios registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
