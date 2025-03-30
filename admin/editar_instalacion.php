<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] !== 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

include '../includes/navbar.php';

$id = $_GET['id'];
$sql = $conn->prepare("SELECT * FROM instalaciones WHERE id = ?");
$sql->execute([$id]);
$instalacion = $sql->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    if (!empty($_FILES['imagen']['name'])) {
        $imagen = $_FILES['imagen']['name'];
        $ruta = "../assets/img/" . $imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
    } else {
        $imagen = $instalacion['imagen'];
    }

    $update = $conn->prepare("UPDATE instalaciones SET nombre=?, descripcion=?, imagen=? WHERE id=?");
    $update->execute([$nombre, $descripcion, $imagen, $id]);

    header("Location: gestionar_instalaciones.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Instalación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #f0f8ff, #caf0f8);
        }
        .card {
            margin-top: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .img-preview {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4 mx-auto" style="max-width: 600px;">
        <h3 class="text-center mb-4"><i class="bi bi-building-fill"></i> Editar Instalación</h3>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($instalacion['nombre']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="4" required><?= htmlspecialchars($instalacion['descripcion']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen actual:</label><br>
                <img src="../assets/img/<?= $instalacion['imagen'] ?>" class="img-preview">
            </div>
            <div class="mb-3">
                <label class="form-label">Cambiar imagen (opcional)</label>
                <input type="file" name="imagen" class="form-control" accept="image/*">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Guardar Cambios</button>
                <a href="gestionar_instalaciones.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Cancelar</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
