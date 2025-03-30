<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] !== 'Cliente') {
    header("Location: ../auth/login.php");
    exit();
}
require_once '../database/conexion.php';
include '../includes/navbar.php';

// Obtener promociones activas
$sql = $conn->query("SELECT * FROM promociones WHERE fecha_fin >= CURDATE() ORDER BY fecha_inicio ASC");
$promociones = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Promociones - Centro de Natación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #e0f7fa);
        }
        .promo-card {
            border-left: 6px solid #0077b6;
        }
        .promo-title {
            color: #0077b6;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">🎉 Promociones Activas</h2>

    <div class="row">
        <?php if (count($promociones) > 0): ?>
            <?php foreach ($promociones as $promo): ?>
                <div class="col-md-6 mb-4">
                    <div class="card promo-card shadow-sm">
                        <div class="card-body">
                            <h5 class="promo-title"><?= htmlspecialchars($promo['titulo']) ?></h5>
                            <p><?= nl2br(htmlspecialchars($promo['descripcion'])) ?></p>
                            <p class="text-muted">
                                Válido del <strong><?= $promo['fecha_inicio'] ?></strong> al <strong><?= $promo['fecha_fin'] ?></strong>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">No hay promociones activas por el momento.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
