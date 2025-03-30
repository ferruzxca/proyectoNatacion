<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Cliente') {
    header("Location: ../auth/login.php");
    exit();
}
require_once '../database/conexion.php';
include '../includes/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_SESSION['id'];
    $id_competencia = $_POST['competencia_id'];

    $verifica = $conn->prepare("SELECT * FROM inscripciones WHERE id_usuario = ? AND id_competencia = ?");
    $verifica->execute([$id_usuario, $id_competencia]);

    if ($verifica->rowCount() === 0) {
        $insert = $conn->prepare("INSERT INTO inscripciones (id_usuario, id_competencia) VALUES (?, ?)");
        $insert->execute([$id_usuario, $id_competencia]);
        $mensaje = "✅ Inscripción exitosa.";
    } else {
        $mensaje = "⚠️ Ya estás inscrito en esta competencia.";
    }
}

$competencias = $conn->query("SELECT * FROM competencias ORDER BY fecha DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Competencias - Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #e0f7ff, #ffffff);
        }
        .titulo {
            text-align: center;
            margin-top: 30px;
        }
        .gallery img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h3 class="titulo mb-4">🏊 Inscribirse en Competencias</h3>

    <?php if (isset($mensaje)): ?>
        <div class="alert alert-info"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="post" class="card p-4 shadow-sm mb-4">
        <div class="mb-3">
            <label for="competencia_id" class="form-label">Selecciona una competencia:</label>
            <select name="competencia_id" id="competencia_id" class="form-select" required>
                <option value="">-- Selecciona --</option>
                <?php foreach ($competencias as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?> (<?= $c['fecha'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle"></i> Inscribirme
        </button>
    </form>

    <h4 class="mb-3 text-center">📸 Galería de Competencias</h4>
    <div class="row gallery">
        <div class="col-md-4 mb-3">
            <img src="../assets/img/competencia1.jpg" alt="Competencia 1" class="img-fluid">
        </div>
        <div class="col-md-4 mb-3">
            <img src="../assets/img/competencia2.jpg" alt="Competencia 2" class="img-fluid">
        </div>
        <div class="col-md-4 mb-3">
            <img src="../assets/img/competencia3.jpg" alt="Competencia 3" class="img-fluid">
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
