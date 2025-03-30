<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../database/conexion.php';
include '../includes/navbar.php';

// Insertar nueva regla
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $regla = $_POST['regla'];
    $stmt = $conn->prepare("INSERT INTO reglamento (regla) VALUES (?)");
    $stmt->execute([$regla]);

    header("Location: gestionar_reglamento.php");
    exit();
}

// Consultar reglas
$sql = $conn->query("SELECT * FROM reglamento");
$reglas = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión del Reglamento</title>
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
    <h2 class="titulo">Gestión del Reglamento</h2>

    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-left-circle"></i> Volver al Panel</a>
    </div>

    <!-- Formulario -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Agregar Nueva Regla
        </div>
        <div class="card-body">
            <form method="post">
                <textarea name="regla" class="form-control" placeholder="Escribe la nueva regla..." rows="3" required></textarea>
                <button type="submit" class="btn btn-success mt-2"><i class="bi bi-plus-circle"></i> Agregar Regla</button>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="card-header bg-info text-white">
            Reglas Registradas
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Regla</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reglas as $r): ?>
                    <tr>
                        <td><?= $r['regla'] ?></td>
                        <td class="text-center">
                            <a href="editar_regla.php?id=<?= $r['id'] ?>" class="text-warning me-2" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="eliminar_regla.php?id=<?= $r['id'] ?>" class="text-danger" title="Eliminar" onclick="return confirm('¿Eliminar esta regla?')">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($reglas)): ?>
                        <tr><td colspan="2" class="text-center text-muted">No hay reglas registradas.</td></tr>
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
