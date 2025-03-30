<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] !== 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

include '../includes/navbar.php';

$id = $_GET['id'];
$sql = $conn->prepare("SELECT * FROM competencias WHERE id = ?");
$sql->execute([$id]);
$comp = $sql->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];

    $stmt = $conn->prepare("UPDATE competencias SET nombre=?, fecha=?, descripcion=? WHERE id=?");
    $stmt->execute([$nombre, $fecha, $descripcion, $id]);

    header("Location: gestionar_competencias.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Competencia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #caf0f8);
        }
        .card {
            margin-top: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4 mx-auto" style="max-width: 600px;">
        <h3 class="text-center mb-4"><i class="bi bi-trophy-fill"></i> Editar Competencia</h3>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nombre del Evento</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($comp['nombre']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control" value="<?= $comp['fecha'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="4" required><?= htmlspecialchars($comp['descripcion']) ?></textarea>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Guardar Cambios</button>
                <a href="gestionar_competencias.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Cancelar</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
