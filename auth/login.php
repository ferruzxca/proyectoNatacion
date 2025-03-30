<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Centro de Natación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #f0f8ff, #dbeafe);
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #0077b6;
            border: none;
        }
        .btn-primary:hover {
            background-color: #023e8a;
        }
        .btn-visita {
            background-color: #ffc107;
            color: #000;
        }
        .btn-visita:hover {
            background-color: #e0a800;
            color: #000;
        }
        footer {
            background-color: #0077b6;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 0 0 10px 10px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-4"><i class="bi bi-person-circle"></i> Iniciar Sesión</h3>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <form method="post" action="validar_login.php">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" id="usuario" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="recordar" class="form-check-input" id="recordar">
                <label class="form-check-label" for="recordar">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-2">
                <i class="bi bi-box-arrow-in-right"></i> Entrar
            </button>

            <!-- Botón Visita -->
            <a href="../visita/visita.php" class="btn btn-visita w-100">
                👁️ Ingresar como Visita
            </a>
        </form>
    </div>
</div>

<footer>
    <p>&copy; <?= date('Y') ?> Centro de Natación. Todos los derechos reservados.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
