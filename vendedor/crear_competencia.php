<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];

    $stmt = $conn->prepare("INSERT INTO competencias (nombre, fecha, descripcion) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $fecha, $descripcion]);

    header("Location: crear_competencia.php?ok=1");
    exit();
}

// Obtener competencias
$sql = $conn->query("SELECT * FROM competencias ORDER BY fecha DESC");
$competencias = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Competencia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #caf0f8);
        }
        .titulo {
            text-align: center;
            margin-top: 30px;
        }
        .form-control, textarea {
            margin-bottom: 12px;
        }
        .table thead {
            background-color: #0077b6;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="titulo">Crear Nueva Competencia</h2>

    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-outline-primary"><i class="bi bi-arrow-left-circle"></i> Volver al Panel</a>
    </div>

    <?php if (isset($_GET['ok'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ Competencia registrada exitosamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <!-- Formulario -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            Formulario de Competencia
        </div>
        <div class="card-body">
            <form method="post">
                <label for="nombre" class="form-label">Nombre del evento:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>

                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>

                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>

                <button type="submit" class="btn btn-success mt-3"><i class="bi bi-check-circle"></i> Registrar Competencia</button>
            </form>
        </div>
    </div>

    <!-- Lista de competencias -->
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            Competencias Registradas
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($competencias)): ?>
                        <?php foreach ($competencias as $i => $c): ?>
                        <tr>
                            <td class="text-center"><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($c['nombre']) ?></td>
                            <td class="text-center"><?= $c['fecha'] ?></td>
                            <td><?= htmlspecialchars($c['descripcion']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center text-muted">No hay competencias registradas.</td></tr>
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
