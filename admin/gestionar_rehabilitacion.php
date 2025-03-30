<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../database/conexion.php';
include '../includes/navbar.php';

// Obtener lista de pacientes
$pacientes = $conn->query("SELECT id, nombre FROM usuarios_natacion")->fetchAll(PDO::FETCH_ASSOC);

// Insertar nueva sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paciente = $_POST['paciente_nombre'];
    $fecha = $_POST['fecha'];
    $terapia = $_POST['tipo_terapia'];
    $observaciones = $_POST['observaciones'];

    $stmt = $conn->prepare("INSERT INTO rehabilitacion (paciente_nombre, fecha, tipo_terapia, observaciones) VALUES (?, ?, ?, ?)");
    $stmt->execute([$paciente, $fecha, $terapia, $observaciones]);

    header("Location: gestionar_rehabilitacion.php");
    exit();
}

// Consultar sesiones
$sql = $conn->query("SELECT * FROM rehabilitacion ORDER BY fecha DESC");
$sesiones = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Rehabilitación</title>
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
        .table thead {
            background-color: #0077b6;
            color: white;
        }
        .form-control, textarea {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="titulo">Gestión de Rehabilitación de Nadadores</h2>

    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-left-circle"></i> Volver al Panel</a>
    </div>

    <!-- Formulario -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Registrar Nueva Sesión
        </div>
        <div class="card-body">
            <form method="post">
                <!-- Seleccionar paciente -->
                <label class="form-label">Paciente:</label>
                <select name="paciente_nombre" class="form-select" required>
                    <option value="">Selecciona un usuario de natación</option>
                    <?php foreach ($pacientes as $p): ?>
                        <option value="<?= htmlspecialchars($p['nombre']) ?>"><?= htmlspecialchars($p['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Fecha -->
                <label class="form-label">Fecha:</label>
                <input type="date" name="fecha" class="form-control" required>

                <!-- Tipo de terapia -->
                <label class="form-label">Tipo de terapia:</label>
                <select name="tipo_terapia" class="form-select" required>
                    <option value="">Selecciona tipo de terapia</option>
                    <option>Terapia acuática</option>
                    <option>Ejercicio terapéutico</option>
                    <option>Movilización articular</option>
                    <option>Estiramiento muscular</option>
                    <option>Entrenamiento de equilibrio</option>
                    <option>Reeducación postural</option>
                    <option>Terapia funcional</option>
                </select>

                <!-- Observaciones -->
                <label class="form-label">Observaciones:</label>
                <textarea name="observaciones" class="form-control" rows="3" required></textarea>

                <button type="submit" class="btn btn-success mt-2"><i class="bi bi-save2"></i> Registrar</button>
            </form>
        </div>
    </div>

    <!-- Tabla de sesiones -->
    <div class="card">
        <div class="card-header bg-info text-white">
            Sesiones Registradas
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Fecha</th>
                        <th>Terapia</th>
                        <th>Observaciones</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sesiones as $s): ?>
                    <tr>
                        <td><?= htmlspecialchars($s['paciente_nombre']) ?></td>
                        <td><?= $s['fecha'] ?></td>
                        <td><?= htmlspecialchars($s['tipo_terapia']) ?></td>
                        <td><?= htmlspecialchars($s['observaciones']) ?></td>
                        <td class="text-center">
                            <a href="editar_rehabilitacion.php?id=<?= $s['id'] ?>" class="text-warning me-2" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="eliminar_rehabilitacion.php?id=<?= $s['id'] ?>" class="text-danger" title="Eliminar" onclick="return confirm('¿Eliminar esta sesión?')">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($sesiones)): ?>
                        <tr><td colspan="5" class="text-center text-muted">No hay sesiones registradas.</td></tr>
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
