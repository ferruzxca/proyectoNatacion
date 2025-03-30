<?php
session_start();
require_once '../database/conexion.php';

// Validación de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../includes/navbar.php'; // Navbar dinámica por nivel

// Obtener datos de la base de datos
$sql = $conn->query("SELECT * FROM graficas_mensuales");
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

$meses = array_column($data, 'mes');
$inscritos = array_column($data, 'inscritos');
$rehabs = array_column($data, 'rehabilitaciones');
$comps = array_column($data, 'competencias');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gráfica de Estadísticas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Chart.js -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background: linear-gradient(120deg, #f0f8ff, #dbeafe);
        }
        h2 {
            margin-top: 30px;
        }
        .chart-container {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">📊 Estadísticas Mensuales</h2>

    <div class="mb-3 text-center">
        <a href="../admin/dashboard.php" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left-circle"></i> Volver al Panel
        </a>
    </div>

    <div class="chart-container">
        <canvas id="grafica" height="120"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('grafica').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($meses) ?>,
            datasets: [
                {
                    label: 'Inscritos',
                    data: <?= json_encode($inscritos) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                },
                {
                    label: 'Rehabilitaciones',
                    data: <?= json_encode($rehabs) ?>,
                    backgroundColor: 'rgba(255, 206, 86, 0.6)'
                },
                {
                    label: 'Competencias',
                    data: <?= json_encode($comps) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad'
                    }
                }
            }
        }
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
