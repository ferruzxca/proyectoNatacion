<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../database/conexion.php';
include '../includes/navbar.php';

// Insertar horario nuevo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dia = $_POST['dia'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $actividad = $_POST['actividad'];

    $stmt = $conn->prepare("INSERT INTO horarios (dia, hora_inicio, hora_fin, actividad) VALUES (?, ?, ?, ?)");
    $stmt->execute([$dia, $hora_inicio, $hora_fin, $actividad]);

    header("Location: gestionar_horarios.php");
    exit();
}

// Consultar horarios
$sql = $conn->query("SELECT * FROM horarios ORDER BY FIELD(dia, 'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo')");
$horarios = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Horarios</title>
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
    <h2 class="titulo">Gestión de Horarios</h2>

    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-left-circle"></i> Volver al Panel</a>
    </div>

    <!-- Formulario -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Agregar Nuevo Horario
        </div>
        <div class="card-body">
            <form method="post">
                <input type="text" name="dia" class="form-control" placeholder="Día (ej. Lunes)" required>
                <label for="hora_inicio">Hora Inicio:</label>
                <input type="time" name="hora_inicio" class="form-control" required>
                <label for="hora_fin">Hora Fin:</label>
                <input type="time" name="hora_fin" class="form-control" required>
                <input type="text" name="actividad" class="form-control" placeholder="Nombre de la actividad" required>
                <button type="submit" class="btn btn-success mt-2"><i class="bi bi-plus-circle"></i> Agregar</button>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="card-header bg-info text-white">
            Horarios Registrados
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Actividad</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($horarios as $h): ?>
                    <tr>
                        <td><?= $h['dia'] ?></td>
                        <td><?= $h['hora_inicio'] ?></td>
                        <td><?= $h['hora_fin'] ?></td>
                        <td><?= $h['actividad'] ?></td>
                        <td class="text-center">
                            <a href="editar_horario.php?id=<?= $h['id'] ?>" class="text-warning me-2" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="eliminar_horario.php?id=<?= $h['id'] ?>" class="text-danger" title="Eliminar" onclick="return confirm('¿Eliminar este horario?')">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($horarios)): ?>
                        <tr><td colspan="5" class="text-center text-muted">No hay horarios registrados.</td></tr>
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
