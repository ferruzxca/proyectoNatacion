<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido - Centro de Natación Innovex</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f8ff;
        }

        header, footer {
            background-color: #0077b6;
            color: white;
            padding: 25px;
            text-align: center;
            border-radius: 0 0 10px 10px;
        }

        .section-title {
            border-bottom: 3px solid #0077b6;
            padding-bottom: 5px;
            margin-top: 40px;
            margin-bottom: 25px;
        }

        .gallery img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }

        .btn-volver {
            background-color: #ffc107;
            color: black;
            font-weight: bold;
        }

        .btn-volver:hover {
            background-color: #e0a800;
        }
    </style>
</head>
<body>

<header>
    <h1>Centro de Natación Innovex</h1>
    <p class="lead">Consulta general para visitantes</p>
</header>

<div class="container mb-5">

    <!-- INSTALACIONES -->
    <h3 class="section-title">🏛 Instalaciones</h3>
    <div class="row gallery mb-4">
        <div class="col-md-4 mb-3">
            <img src="../assets/img/piscina1.jpg" class="img-fluid" alt="Piscina olímpica">
        </div>
        <div class="col-md-4 mb-3">
            <img src="../assets/img/piscina2.jpg" class="img-fluid" alt="Área para niños">
        </div>
        <div class="col-md-4 mb-3">
            <img src="../assets/img/vestidores.jpg" class="img-fluid" alt="Vestidores">
        </div>
    </div>

    <!-- HORARIOS -->
    <h3 class="section-title">🕑 Horarios</h3>
    <ul class="list-group mb-4">
        <li class="list-group-item">Lunes a Viernes: 6:00 AM - 9:00 PM</li>
        <li class="list-group-item">Sábado: 7:00 AM - 3:00 PM</li>
        <li class="list-group-item">Domingo: Cerrado</li>
    </ul>

    <!-- REGLAMENTO -->
    <h3 class="section-title">📜 Reglamento</h3>
    <ol class="mb-5">
        <li>El uso de gorra es obligatorio en todo momento.</li>
        <li>Está prohibido correr en las áreas húmedas.</li>
        <li>Respetar las indicaciones de los instructores y personal del centro.</li>
        <li>No se permite el ingreso con alimentos o bebidas.</li>
        <li>Respetar el aforo máximo en cada área.</li>
    </ol>

    <!-- BOTÓN VOLVER -->
    <div class="text-center">
        <a href="../auth/login.php" class="btn btn-volver">← Volver al Inicio</a>
    </div>
</div>

<footer>
    <p>&copy; 2025 Centro de Natación Innovex</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
