<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Centro de Natación Innovex</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #e0f7ff, #cfe9f9);
            font-family: 'Segoe UI', sans-serif;
        }

        header {
            background-color: #0077b6;
            color: white;
            padding: 40px 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-weight: 700;
        }

        .btn-custom {
            min-width: 200px;
            font-size: 1.1rem;
        }

        .info-section {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-top: 40px;
        }

        .info-section h2 {
            color: #0077b6;
        }

        footer {
            background-color: #0077b6;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 60px;
            text-align: center;
        }

        .wave-img {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-height: 400px;
            object-fit: cover;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- HEADER -->
        <header class="mb-5">
            <h1>Centro de Natación Innovex</h1>
            <p class="lead">Alto rendimiento acuático y bienestar para toda la familia 🏊‍♂️</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
                <a href="auth/login.php" class="btn btn-success btn-lg btn-custom">
                    <i class="bi bi-lock-fill"></i> Iniciar Sesión
                </a>
            </div>
        </header>

        <!-- QUIÉNES SOMOS -->
        <div class="info-section text-center">
            <h2>¿Quiénes somos?</h2>
            <p class="mt-3 fs-5 text-muted">
                En Innovex ofrecemos clases de natación para todas las edades, programas de rehabilitación personalizados y competencias oficiales. Nuestro objetivo es formar atletas y promover la salud integral a través del deporte acuático.
            </p>
            <img src="assets/img/natacion.jpg" alt="Natación en Innovex" class="wave-img mt-4">
        </div>

        <!-- FOOTER -->
        <footer>
            <p class="mb-0">© <?= date('Y') ?> Centro de Natación Innovex | Todos los derechos reservados.</p>
        </footer>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>