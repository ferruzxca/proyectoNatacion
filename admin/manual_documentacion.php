<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] !== 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

include '../includes/navbar.php';
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">📘 Manual del Sistema - Centro de Natación Innovex</h2>

    <div class="card shadow p-4 mb-4">
        <h4>📖 Visualizar Documentación</h4>
        <p>Puedes consultar aquí el manual completo del sistema en formato PDF:</p>
        <iframe src="../documentacion/manual.pdf" width="100%" height="600px" style="border: 1px solid #ccc;"></iframe>
    </div>

    <div class="card shadow p-4">
        <h4>📥 Descargar Manual</h4>
        <p>Haz clic en el siguiente botón para descargar la documentación completa del sistema:</p>
        <a href="../documentacion/manual.pdf" class="btn btn-success" download="Manual_Centro_Natacion_Innovex.pdf">
            📎 Descargar Manual (PDF)
        </a>
    </div>
</div>