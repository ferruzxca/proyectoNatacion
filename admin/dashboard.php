<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #dbeafe);
        }
        header, footer {
            background-color: #0077b6;
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.03);
        }
        .card-icon {
            font-size: 2.5rem;
            color: #0077b6;
        }
    </style>
</head>
<body>
<br>

<header class="text-center mb-4">
    <h1>Panel del Administrador</h1>
    <h5>Bienvenido, <?php echo $_SESSION['usuario']; ?></h5>
</header>

<div class="container">
    <div class="row g-4">

        <!-- Usuarios -->
        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-people-fill card-icon"></i>
                <h5 class="mt-3">Usuarios</h5>
                <a href="gestionar_usuarios.php" class="btn btn-primary mt-2">Gestionar</a>
            </div>
        </div>

        <!-- Horarios -->
        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-clock-fill card-icon"></i>
                <h5 class="mt-3">Horarios</h5>
                <a href="gestionar_horarios.php" class="btn btn-primary mt-2">Gestionar</a>
            </div>
        </div>

        <!-- Promociones -->
        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-tags-fill card-icon"></i>
                <h5 class="mt-3">Promociones</h5>
                <a href="gestionar_promociones.php" class="btn btn-primary mt-2">Gestionar</a>
            </div>
        </div>

        <!-- Reglamento -->
        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-file-earmark-text-fill card-icon"></i>
                <h5 class="mt-3">Reglamento</h5>
                <a href="gestionar_reglamento.php" class="btn btn-primary mt-2">Gestionar</a>
            </div>
        </div>

        <!-- Instalaciones -->
        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-building-fill card-icon"></i>
                <h5 class="mt-3">Instalaciones</h5>
                <a href="gestionar_instalaciones.php" class="btn btn-primary mt-2">Gestionar</a>
            </div>
        </div>

        <!-- Competencias -->
        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-trophy-fill card-icon"></i>
                <h5 class="mt-3">Competencias</h5>
                <a href="gestionar_competencias.php" class="btn btn-primary mt-2">Gestionar</a>
            </div>
        </div>

        <!-- Rehabilitación -->
        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-heart-pulse-fill card-icon"></i>
                <h5 class="mt-3">Rehabilitación</h5>
                <a href="gestionar_rehabilitacion.php" class="btn btn-primary mt-2">Gestionar</a>
            </div>
        </div>

        <!-- PDF Reporte -->
        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-filetype-pdf card-icon"></i>
                <h5 class="mt-3">Reporte PDF</h5>
                <a href="../reports/reporte_pdf.php" target="_blank" class="btn btn-danger mt-2">Ver PDF</a>
            </div>
        </div>

        <!-- Gráfica -->
        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-bar-chart-line-fill card-icon"></i>
                <h5 class="mt-3">Gráfica Mensual</h5>
                <a href="../reports/grafica_mes.php" target="_blank" class="btn btn-info mt-2 text-white">Ver Gráfica</a>
            </div>
        </div>

        <!-- Cerrar Sesión -->
        <div class="col-md-12 text-center mt-4">
            <a href="../auth/logout.php" class="btn btn-outline-danger btn-lg"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
        </div>

    </div>
</div>

<footer class="mt-5">
    <p>&copy; 2025 Centro de Natación. Panel del Administrador</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
