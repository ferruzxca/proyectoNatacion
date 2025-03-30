<?php require_once '../database/conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Información para Clientes - Innovex</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #dbeafe);
        }
        footer {
            background-color: #0077b6;
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .section-title {
            border-bottom: 2px solid #0077b6;
            padding-bottom: 5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-title i {
            font-size: 1.5rem;
            color: #0077b6;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="text-center text-primary mb-4">Centro de Natación <strong>Innovex</strong></h2>
    <p class="lead text-center text-muted mb-5">Bienvenido al sitio oficial del centro. Consulta la información más relevante para nuestros clientes.</p>

    <!-- INSTALACIONES -->
    <div class="section-title">
        <i class="bi bi-building"></i>
        <h3 class="m-0">Instalaciones</h3>
    </div>
    <div class="row">
        <?php
        $sql = $conn->query("SELECT * FROM instalaciones");
        foreach ($sql as $i):
        ?>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <img src="../assets/img/<?= $i['imagen'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><?= $i['nombre'] ?></h5>
                    <p class="card-text text-muted"><?= $i['descripcion'] ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- PROMOCIONES -->
    <div class="section-title mt-5">
        <i class="bi bi-megaphone-fill"></i>
        <h3 class="m-0">Promociones</h3>
    </div>
    <div class="row">
        <?php
        $sql = $conn->query("SELECT * FROM promociones WHERE fecha_fin >= CURDATE()");
        foreach ($sql as $p):
        ?>
        <div class="col-md-6 mb-4">
            <div class="card border-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success"><?= $p['titulo'] ?></h5>
                    <p class="card-text"><?= $p['descripcion'] ?></p>
                    <small class="text-muted">Válida del <?= $p['fecha_inicio'] ?> al <?= $p['fecha_fin'] ?></small>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- REGLAMENTO -->
    <div class="section-title mt-5">
        <i class="bi bi-file-earmark-text-fill"></i>
        <h3 class="m-0">Reglamento</h3>
    </div>
    <ul class="list-group mb-4">
        <?php
        $sql = $conn->query("SELECT * FROM reglamento");
        foreach ($sql as $r):
            echo "<li class='list-group-item'><i class='bi bi-check-circle-fill text-primary me-2'></i>{$r['regla']}</li>";
        endforeach;
        ?>
    </ul>

    <!-- HORARIOS -->
    <div class="section-title mt-5">
        <i class="bi bi-clock-history"></i>
        <h3 class="m-0">Horarios</h3>
    </div>
    <div class="table-responsive mb-4">
        <table class="table table-striped table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>Día</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Actividad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $conn->query("SELECT * FROM horarios ORDER BY FIELD(dia, 'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo')");
                foreach ($sql as $h):
                ?>
                <tr>
                    <td><?= $h['dia'] ?></td>
                    <td><?= $h['hora_inicio'] ?></td>
                    <td><?= $h['hora_fin'] ?></td>
                    <td><?= $h['actividad'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- COMPETENCIAS -->
    <div class="section-title mt-5">
        <i class="bi bi-trophy-fill"></i>
        <h3 class="m-0">Competencias</h3>
    </div>
    <ul class="list-group mb-4">
        <?php
        $sql = $conn->query("SELECT * FROM competencias ORDER BY fecha DESC");
        foreach ($sql as $c):
            echo "<li class='list-group-item'><strong>{$c['nombre']}</strong> ({$c['fecha']})<br><small class='text-muted'>{$c['descripcion']}</small></li>";
        endforeach;
        ?>
    </ul>

    <!-- FOOTER -->
    <footer class="mt-5">
        <p class="mb-2">© <?= date('Y') ?> Innovex. Todos los derechos reservados.</p>
        <a href="../auth/login.php" class="text-white text-decoration-underline me-3">🔐 Iniciar sesión</a>
        <a href="../index.php" class="text-white text-decoration-underline">🏠 Volver al inicio</a>
    </footer>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
