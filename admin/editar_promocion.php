<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] !== 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

include '../includes/navbar.php';

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID no proporcionado.</div>";
    exit();
}

$id = $_GET['id'];

$sql = $conn->prepare("SELECT * FROM promociones WHERE id = ?");
$sql->execute([$id]);
$promo = $sql->fetch(PDO::FETCH_ASSOC);

if (!$promo) {
    echo "<div class='alert alert-warning'>Promoción no encontrada.</div>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $update = $conn->prepare("UPDATE promociones SET titulo=?, descripcion=?, fecha_inicio=?, fecha_fin=? WHERE id=?");
    $update->execute([$titulo, $descripcion, $fecha_inicio, $fecha_fin, $id]);

    header("Location: gestionar_promociones.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Promoción</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #caf0f8);
        }
        .card {
            margin-top: 50px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4 mx-auto" style="max-width: 600px;">
        <h3 class="text-center mb-4"><i class="bi bi-tag-fill"></i> Editar Promoción</h3>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($promo['titulo']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" required><?= htmlspecialchars($promo['descripcion']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" value="<?= $promo['fecha_inicio'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de fin</label>
                <input type="date" name="fecha_fin" class="form-control" value="<?= $promo['fecha_fin'] ?>" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Guardar Cambios
                </button>
                <a href="gestionar_promociones.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
