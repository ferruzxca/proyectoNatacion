<?php
include '../database/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $fecha = date('Y-m-d H:i:s');

    try {
        // Verificar si el correo ya existe
        $stmt = $conn->prepare("SELECT id FROM visitas WHERE correo = ?");
        $stmt->execute([$correo]);
        $existe = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existe) {
            $_SESSION['error'] = "El correo ya está registrado.";
        } else {
            // Insertar nueva visita
            $insert = $conn->prepare("INSERT INTO visitas (nombre, correo, fecha_registro) VALUES (?, ?, ?)");
            $insert->execute([$nombre, $correo, $fecha]);

            $_SESSION['mensaje'] = "Registro exitoso. Ahora puedes iniciar sesión como visita.";
        }

    } catch (Exception $e) {
        $_SESSION['error'] = "Error al registrar la visita: " . $e->getMessage();
    }

    header("Location: ../auth/login.php");
    exit();
} else {
    header("Location: ../auth/login.php");
    exit();
}
