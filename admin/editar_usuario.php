<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

include '../includes/navbar.php'; // Navbar dinámico

// Validar existencia del ID
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>No se ha especificado un usuario.</div>";
    exit();
}

$id = $_GET['id'];

// Obtener datos del usuario
$sql = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$sql->execute([$id]);
$usuario = $sql->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<div class='alert alert-danger'>Usuario no encontrado.</div>";
    exit();
}

// Actualizar datos si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $nivel = $_POST['nivel'];

    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, nivel = ? WHERE id = ?");
    $stmt->execute([$nombre, $nivel, $id]);

    header("Location: gestionar_usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & Icons -->
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
    <div class="card p-4 mx-auto" style="max-width: 500px;">
        <h3 class="text-center mb-4">✏️ Editar Usuario</h3>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nombre completo</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nivel</label>
                <select name="nivel" class="form-select" required>
                    <option value="Administrador" <?= $usuario['nivel'] === 'Administrador' ? 'selected' : '' ?>>Administrador</option>
                    <option value="Vendedor" <?= $usuario['nivel'] === 'Vendedor' ? 'selected' : '' ?>>Vendedor</option>
                    <option value="Cliente" <?= $usuario['nivel'] === 'Cliente' ? 'selected' : '' ?>>Cliente</option>
                </select>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Actualizar</button>
                <a href="gestionar_usuarios.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Volver</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
