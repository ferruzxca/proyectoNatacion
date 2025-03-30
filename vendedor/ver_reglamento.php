<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

$sql = $conn->query("SELECT * FROM reglamento");
$reglas = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reglamento del Centro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #caf0f8);
        }
        .titulo {
            margin-top: 30px;
            text-align: center;
        }
        .list-group-item {
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="titulo">Reglamento del Centro de Natación</h2>

    <div class="mb-3 text-start">
        <a href="dashboard.php" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-arrow-left-circle"></i> Volver al Panel
        </a>
    </div>

    <?php if (!empty($reglas)): ?>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                Normas y Reglas Vigentes
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <?php foreach ($reglas as $r): ?>
                        <li class="list-group-item">
                            <i class="bi bi-check2-circle text-success"></i> <?= htmlspecialchars($r['regla']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning mt-3">
            No hay reglas registradas por el momento.
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
