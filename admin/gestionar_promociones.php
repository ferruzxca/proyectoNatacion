<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../database/conexion.php';
include '../includes/navbar.php';

// Insertar nueva promoción
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $stmt = $conn->prepare("INSERT INTO promociones (titulo, descripcion, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)");
    $stmt->execute([$titulo, $descripcion, $fecha_inicio, $fecha_fin]);

    header("Location: gestionar_promociones.php");
    exit();
}

// Consultar promociones
$sql = $conn->query("SELECT * FROM promociones ORDER BY fecha_inicio DESC");
$promociones = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Promociones</title>
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
    <h2 class="titulo">Gestión de Promociones</h2>

    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-left-circle"></i> Volver al Panel</a>
    </div>

    <!-- Formulario -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Agregar Nueva Promoción
        </div>
        <div class="card-body">
            <form method="post">
                <input type="text" name="titulo" class="form-control" placeholder="Título de la promoción" required>
                <textarea name="descripcion" class="form-control" placeholder="Descripción" rows="3" required></textarea>
                <label>Fecha de inicio:</label>
                <input type="date" name="fecha_inicio" class="form-control" required>
                <label>Fecha de fin:</label>
                <input type="date" name="fecha_fin" class="form-control" required>
                <button type="submit" class="btn btn-success mt-2"><i class="bi bi-plus-circle"></i> Agregar</button>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="card-header bg-info text-white">
            Promociones Registradas
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($promociones as $p): ?>
                    <tr>
                        <td><?= $p['titulo'] ?></td>
                        <td><?= $p['descripcion'] ?></td>
                        <td><?= $p['fecha_inicio'] ?></td>
                        <td><?= $p['fecha_fin'] ?></td>
                        <td class="text-center">
                            <a href="editar_promocion.php?id=<?= $p['id'] ?>" class="text-warning me-2" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="eliminar_promocion.php?id=<?= $p['id'] ?>" class="text-danger" title="Eliminar" onclick="return confirm('¿Eliminar esta promoción?')">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($promociones)): ?>
                        <tr><td colspan="5" class="text-center text-muted">No hay promociones registradas.</td></tr>
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
