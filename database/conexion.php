<?php
$host = 'localhost';
$db = 'natacion_db';
$user = 'root';
$pass = 'ferr2812'; // cambia si tienes contraseña
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // ALIAS para compatibilidad con archivos anteriores
    $conexion = $pdo;
    $conn = $pdo;

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
