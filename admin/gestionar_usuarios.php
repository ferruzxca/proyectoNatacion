<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}
require_once '../database/conexion.php';
include '../includes/navbar.php';

// Consulta todos los usuarios
$sql = $conn->query("SELECT * FROM usuarios");
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
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
        .btn-panel {
            margin-right: 15px;
        }
        .table thead {
            background-color: #0077b6;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="titulo">Gestión de Usuarios</h2>

    <div class="mb-3 text-start">
        <a href="dashboard.php" class="btn btn-outline-primary btn-sm btn-panel"><i class="bi bi-arrow-left-circle"></i> Volver al Panel</a>
        <a href="registrar_usuario.php" class="btn btn-primary btn-sm"><i class="bi bi-person-plus"></i> Agregar Usuario</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Nivel</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= $u['nombre'] ?></td>
                    <td><?= $u['usuario'] ?></td>
                    <td><?= $u['nivel'] ?></td>
                    <td>
                        <span class="badge bg-<?= $u['estado'] ? 'success' : 'secondary' ?>">
                            <?= $u['estado'] ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="editar_usuario.php?id=<?= $u['id'] ?>" class="text-warning me-2" title="Editar"><i class="bi bi-pencil-square"></i></a>
                        <?php if ($u['estado']): ?>
                            <a href="inhabilitar_usuario.php?id=<?= $u['id'] ?>" class="text-danger" title="Inhabilitar" onclick="return confirm('¿Seguro que deseas inhabilitar este usuario?')">
                                <i class="bi bi-x-circle-fill"></i>
                            </a>
                        <?php else: ?>
                            <a href="rehabilitar_usuario.php?id=<?= $u['id'] ?>" class="text-success" title="Rehabilitar" onclick="return confirm('¿Reactivar este usuario?')">
                                <i class="bi bi-check-circle-fill"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
