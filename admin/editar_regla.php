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

$sql = $conn->prepare("SELECT * FROM reglamento WHERE id = ?");
$sql->execute([$id]);
$regla = $sql->fetch(PDO::FETCH_ASSOC);

if (!$regla) {
    echo "<div class='alert alert-warning'>Regla no encontrada.</div>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = $_POST['regla'];
    $update = $conn->prepare("UPDATE reglamento SET regla=? WHERE id=?");
    $update->execute([$texto, $id]);

    header("Location: gestionar_reglamento.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Regla</title>
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
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4 mx-auto" style="max-width: 600px;">
        <h3 class="text-center mb-4"><i class="bi bi-file-earmark-text-fill"></i> Editar Regla</h3>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Texto de la Regla</label>
                <textarea name="regla" class="form-control" required><?= htmlspecialchars($regla['regla']) ?></textarea>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill"></i> Guardar Cambios</button>
                <a href="gestionar_reglamento.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Volver</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
