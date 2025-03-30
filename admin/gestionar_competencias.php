<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../database/conexion.php';
include '../includes/navbar.php';

// Insertar nueva competencia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];

    $stmt = $conn->prepare("INSERT INTO competencias (nombre, fecha, descripcion) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $fecha, $descripcion]);

    header("Location: gestionar_competencias.php");
    exit();
}

// Consultar competencias
$sql = $conn->query("SELECT * FROM competencias ORDER BY fecha DESC");
$competencias = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Competencias</title>
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
        .form-control, textarea {
            margin-bottom: 10px;
        }
        .table thead {
            background-color: #0077b6;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="titulo">Gestión de Competencias Acuáticas</h2>

    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-arrow-left-circle"></i> Volver al Panel
        </a>
    </div>

    <!-- Formulario -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Registrar Nueva Competencia
        </div>
        <div class="card-body">
            <form method="post">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre del evento" required>
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" class="form-control" required>
                <textarea name="descripcion" class="form-control" placeholder="Descripción..." rows="3" required></textarea>
                <button type="submit" class="btn btn-success mt-2">
                    <i class="bi bi-plus-circle"></i> Registrar
                </button>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="card-header bg-info text-white">
            Competencias Registradas
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($competencias as $c): ?>
                    <tr>
                        <td><?= $c['nombre'] ?></td>
                        <td><?= $c['fecha'] ?></td>
                        <td><?= $c['descripcion'] ?></td>
                        <td class="text-center">
                            <a href="editar_competencia.php?id=<?= $c['id'] ?>" class="text-warning me-2" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="eliminar_competencia.php?id=<?= $c['id'] ?>" class="text-danger" title="Eliminar" onclick="return confirm('¿Eliminar esta competencia?')">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($competencias)): ?>
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
