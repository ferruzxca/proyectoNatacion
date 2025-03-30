<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Vendedor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #dbeafe);
        }
        header {
            background-color: #0077b6;
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-top: 20px;
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

<header>
    <h2>Bienvenido, <?= $_SESSION['usuario'] ?> (Vendedor)</h2>
</header>

<div class="container mt-4">
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-person-plus-fill card-icon"></i>
                <h5 class="mt-3">Agregar Usuario de Natación</h5>
                <a href="agregar_usuario_natacion.php" class="btn btn-primary mt-2">Ir</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-clock-fill card-icon"></i>
                <h5 class="mt-3">Consultar Horarios</h5>
                <a href="ver_horarios.php" class="btn btn-primary mt-2">Ir</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-megaphone-fill card-icon"></i>
                <h5 class="mt-3">Crear Promoción</h5>
                <a href="crear_promocion.php" class="btn btn-primary mt-2">Ir</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-file-earmark-text-fill card-icon"></i>
                <h5 class="mt-3">Consultar Reglamento</h5>
                <a href="ver_reglamento.php" class="btn btn-primary mt-2">Ir</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-trophy-fill card-icon"></i>
                <h5 class="mt-3">Ver Competencias</h5>
                <a href="ver_competencias.php" class="btn btn-primary mt-2">Ir</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4">
                <i class="bi bi-plus-square-fill card-icon"></i>
                <h5 class="mt-3">Crear Competencia</h5>
                <a href="crear_competencia.php" class="btn btn-primary mt-2">Ir</a>
            </div>
        </div>

        <div class="col-md-12 text-center mt-4">
            <a href="../auth/logout.php" class="btn btn-outline-danger btn-lg">
                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
            </a>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
