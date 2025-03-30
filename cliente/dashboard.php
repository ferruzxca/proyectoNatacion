<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Cliente') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Cliente - Centro de Natación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #dbeafe);
            font-family: 'Segoe UI', sans-serif;
        }
        .card-option {
            transition: transform 0.2s;
        }
        .card-option:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">👋 Bienvenido, <?= $_SESSION['usuario'] ?> (Cliente)</h2>

    <div class="row g-4 justify-content-center">

        <div class="col-md-4">
            <div class="card card-option shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">🕐 Ver Horarios</h5>
                    <p class="card-text">Consulta los horarios disponibles para las actividades acuáticas.</p>
                    <a href="ver_horarios.php" class="btn btn-primary">Ver Horarios</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-option shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">🏊 Inscribirse en Competencias</h5>
                    <p class="card-text">Explora e inscríbete en competencias disponibles.</p>
                    <a href="inscribirse_competencia.php" class="btn btn-success">Ir a Competencias</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-option shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">🩺 Agendar Rehabilitación</h5>
                    <p class="card-text">Solicita una cita para rehabilitación física en el centro.</p>
                    <a href="agendar_rehabilitacion.php" class="btn btn-warning">Agendar Cita</a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
