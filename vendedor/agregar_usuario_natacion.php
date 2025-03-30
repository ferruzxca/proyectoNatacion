<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

// Guardar nuevo usuario de natación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $nivel = $_POST['nivel'];
    $fecha = date("Y-m-d");

    $stmt = $conn->prepare("INSERT INTO usuarios_natacion (nombre, edad, nivel, fecha_inscripcion) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $edad, $nivel, $fecha]);

    header("Location: agregar_usuario_natacion.php?success=1");
    exit();
}

// Consultar todos los usuarios registrados
$consulta = $conn->query("SELECT * FROM usuarios_natacion ORDER BY fecha_inscripcion DESC");
$usuarios_natacion = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Usuario de Natación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #f0f8ff, #dbeafe);
        }
        .titulo {
            margin-top: 30px;
            text-align: center;
        }
        .form-control, .form-select {
            margin-bottom: 15px;
        }
        .table thead {
            background-color: #0077b6;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="titulo">Registrar Nuevo Usuario de Natación</h2>

    <div class="mb-3 text-start">
        <a href="dashboard.php" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-arrow-left-circle"></i> Volver al panel
        </a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ Usuario registrado correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Datos del Usuario
        </div>
        <div class="card-body">
            <form method="post">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej: Juan Pérez" required>

                <label for="edad" class="form-label">Edad</label>
                <input type="number" name="edad" id="edad" class="form-control" placeholder="Edad" min="3" max="100" required>

                <label for="nivel" class="form-label">Nivel</label>
                <select name="nivel" id="nivel" class="form-select" required>
                    <option value="">-- Selecciona un nivel --</option>
                    <option value="Básico">Básico</option>
                    <option value="Intermedio">Intermedio</option>
                    <option value="Avanzado">Avanzado</option>
                </select>

                <button type="submit" class="btn btn-success mt-2">
                    <i class="bi bi-person-plus-fill"></i> Registrar
                </button>
            </form>
        </div>
    </div>

    <!-- Tabla de usuarios ya registrados -->
    <div class="card">
        <div class="card-header bg-info text-white">
            Usuarios Registrados en Natación
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Nivel</th>
                        <th>Fecha de Inscripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuarios_natacion)): ?>
                        <?php foreach ($usuarios_natacion as $i => $u): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $u['nombre'] ?></td>
                            <td><?= $u['edad'] ?></td>
                            <td><?= $u['nivel'] ?></td>
                            <td><?= date("d/m/Y", strtotime($u['fecha_inscripcion'])) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center text-muted">No hay usuarios registrados aún.</td></tr>
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
