<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../database/conexion.php';
include '../includes/navbar.php';

// Registrar nueva instalación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $imagen = $_FILES['imagen']['name'];
    $ruta = "../assets/img/" . $imagen;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

    $stmt = $conn->prepare("INSERT INTO instalaciones (nombre, descripcion, imagen) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $imagen]);

    header("Location: gestionar_instalaciones.php");
    exit();
}

// Consultar instalaciones
$sql = $conn->query("SELECT * FROM instalaciones");
$instalaciones = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Instalaciones</title>
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

        .form-control,
        textarea {
            margin-bottom: 10px;
        }

        .table thead {
            background-color: #0077b6;
            color: white;
        }

        img.img-mini {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2 class="titulo">Gestión de Instalaciones</h2>

        <div class="mb-3">
            <a href="dashboard.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-left-circle"></i> Volver al Panel</a>
        </div>

        <!-- Formulario -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Agregar Nueva Instalación
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre de la instalación" required>
                    <textarea name="descripcion" class="form-control" placeholder="Descripción..." rows="3" required></textarea>
                    <label class="form-label">Imagen:</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*" required>
                    <button type="submit" class="btn btn-success mt-2"><i class="bi bi-plus-circle"></i> Registrar</button>
                </form>
            </div>
        </div>

        <!-- Tabla -->
        <div class="card">
            <div class="card-header bg-info text-white">
                Instalaciones Registradas
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Imagen</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($instalaciones as $i): ?>
                            <tr>
                                <td><?= $i['nombre'] ?></td>
                                <td><?= $i['descripcion'] ?></td>
                                <td><img src="../assets/img/<?= $i['imagen'] ?>" class="img-mini"></td>
                                <td class="text-center">
                                    <a href="editar_instalacion.php?id=<?= $i['id'] ?>" class="text-warning me-2" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="eliminar_instalacion.php?id=<?= $i['id'] ?>" class="text-danger" title="Eliminar" onclick="return confirm('¿Eliminar esta instalación?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($instalaciones)): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">No hay instalaciones registradas.</td>
                            </tr>
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