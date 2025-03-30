<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>validar_login.php</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f0f8ff, #dbeafe);
        }
        header, footer {
            background-color: #0077b6;
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
        nav a {
            margin: 10px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        section {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-4 mb-5">
<?php
session_start();
require_once '../database/conexion.php';

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? AND estado = 1");
$sql->execute([$usuario]);
$user = $sql->fetch(PDO::FETCH_ASSOC);

if ($user && hash('sha256', $password) === $user['password']) {
    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['nivel'] = $user['nivel'];
    $_SESSION['id'] = $user['id'];

    if (isset($_POST['recordar'])) {
        setcookie("usuario", $user['usuario'], time() + (86400 * 30), "/");
        setcookie("nivel", $user['nivel'], time() + (86400 * 30), "/");
    }

    switch ($user['nivel']) {
        case 'Administrador': header("Location: ../admin/dashboard.php"); break;
        case 'Vendedor': header("Location: ../vendedor/dashboard.php"); break;
        case 'Cliente': header("Location: ../cliente/dashboard.php"); break;
    }
} else {
    echo "<script>alert('Datos incorrectos'); location.href='login.php';</script>";
}
?>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
