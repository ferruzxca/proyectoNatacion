<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

// Insertar nueva promoción
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $stmt = $conn->prepare("INSERT INTO promociones (titulo, descripcion, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)");
    $stmt->execute([$titulo, $descripcion, $fecha_inicio, $fecha_fin]);

    header("Location: crear_promocion.php?ok=1");
    exit();
}

// Obtener promociones
$sql = $conn->query("SELECT * FROM promociones ORDER BY fecha_inicio DESC");
$promociones = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Promoción</title>
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

    <h2 class="titulo">Crear Nueva Promoción</h2>

    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-outline-primary"><i class="bi bi-arrow-left-circle"></i> Volver al Panel</a>
    </div>

    <?php if (isset($_GET['ok'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ Promoción registrada correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <!-- Formulario -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            Formulario de Promoción
        </div>
        <div class="card-body">
            <form method="post">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required>

                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>

                <div class="row">
                    <div class="col-md-6">
                        <label for="fecha_inicio" class="form-label">Inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_fin" class="form-label">Fin:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-3"><i class="bi bi-check-circle"></i> Crear Promoción</button>
            </form>
        </div>
    </div>

    <!-- Lista de promociones -->
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            Promociones Registradas
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($promociones)): ?>
                        <?php foreach ($promociones as $i => $p): ?>
                        <tr>
                            <td class="text-center"><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($p['titulo']) ?></td>
                            <td><?= htmlspecialchars($p['descripcion']) ?></td>
                            <td class="text-center"><?= $p['fecha_inicio'] ?></td>
                            <td class="text-center"><?= $p['fecha_fin'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
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
