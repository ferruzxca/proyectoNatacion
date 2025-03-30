<?php
if (!isset($_SESSION)) session_start();

$nivel = $_SESSION['nivel'] ?? 'Invitado';
$usuario = $_SESSION['usuario'] ?? 'Desconocido';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Navbar - Centro de Natación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .navbar-custom {
            background-color: #0077b6;
        }

        .navbar-custom .nav-link {
            color: white !important;
            font-weight: 500;
            margin-right: 10px;
        }

        .navbar-custom .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
        }

        .navbar-custom .navbar-brand {
            font-weight: bold;
            color: white !important;
        }

        .navbar-custom .dropdown-menu {
            background-color: #0077b6;
        }

        .navbar-custom .dropdown-item {
            color: white;
        }

        .navbar-custom .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom px-4">
        <a class="navbar-brand" href="#">🏊 Centro de Natación</a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContenido">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php if ($nivel == 'Administrador'): ?>
                    <li class="nav-item"><a class="nav-link" href="../admin/dashboard.php">🏠 Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="../admin/gestionar_usuarios.php">👥 Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="../admin/gestionar_horarios.php">🕐 Horarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="../admin/gestionar_promociones.php">🎉 Promociones</a></li>
                    <li class="nav-item"><a class="nav-link" href="../admin/gestionar_reglamento.php">📜 Reglamento</a></li>
                    <li class="nav-item"><a class="nav-link" href="../admin/gestionar_instalaciones.php">🏛 Instalaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="../admin/gestionar_competencias.php">🏊 Competencias</a></li>
                    <li class="nav-item"><a class="nav-link" href="../admin/gestionar_rehabilitacion.php">🩺 Rehabilitación</a></li>
                    <li class="nav-item"><a class="nav-link" href="../admin/visitas.php">👩🏻‍🤝‍👨🏾 Visitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="../reports/reporte_pdf.php" target="_blank">📄 PDF</a></li>
                    <li class="nav-item"><a class="nav-link" href="../reports/grafica_mes.php" target="_blank">📊 Gráfica</a></li>

                <?php elseif ($nivel == 'Vendedor'): ?>
                    <li class="nav-item"><a class="nav-link" href="../vendedor/dashboard.php">🏠 Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="../vendedor/agregar_usuario_natacion.php">➕ Usuario Natación</a></li>
                    <li class="nav-item"><a class="nav-link" href="../vendedor/ver_horarios.php">🕐 Horarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="../vendedor/crear_promocion.php">🎉 Nueva Promoción</a></li>
                    <li class="nav-item"><a class="nav-link" href="../vendedor/ver_reglamento.php">📜 Reglamento</a></li>
                    <li class="nav-item"><a class="nav-link" href="../vendedor/crear_competencia.php">➕ Crear Competencia</a></li>

                <?php elseif ($nivel == 'Cliente'): ?>
                    <li class="nav-item"><a class="nav-link" href="../cliente/dashboard.php">🏠 Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="../cliente/ver_horarios.php">🕐 Ver Horarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="../cliente/inscribirse_competencia.php">🏅 Competencias</a></li>
                    <li class="nav-item"><a class="nav-link" href="../cliente/agendar_rehabilitacion.php">🩺 Rehabilitación</a></li>
                    <li class="nav-item"><a class="nav-link" href="../cliente/ver_promociones.php">🎉 Promociones</a></li>
                    <li class="nav-item"><a class="nav-link" href="../cliente/ver_reglamento.php">📜 Reglamento</a></li>


                <?php endif; ?>

            </ul>

            <span class="navbar-text me-3 text-white fw-semibold">
                👤 <?= $usuario ?> (<?= $nivel ?>)
            </span>
            <a href="../auth/logout.php" class="btn btn-light">🚪 Cerrar Sesión</a>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>