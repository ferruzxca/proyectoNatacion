<?php
session_start();

// Borrar variables de sesión
session_unset();
session_destroy();

// Borrar cookies si existen
if (isset($_COOKIE['usuario'])) {
    setcookie('usuario', '', time() - 3600, '/');
}
if (isset($_COOKIE['nivel'])) {
    setcookie('nivel', '', time() - 3600, '/');
}

// Mensaje para mostrar en login
session_start();
$_SESSION['mensaje'] = "Sesión cerrada correctamente.";

// Redirigir al login
header("Location: ../auth/login.php");
exit();
