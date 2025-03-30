<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Cliente') {
    header("Location: ../auth/login.php");
    exit();
}
require_once '../database/conexion.php';
include '../includes/navbar.php';

$sql = $conn->query("SELECT * FROM horarios ORDER BY FIELD(dia, 'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo')");
$horarios = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h3 class="text-center mb-4">🕐 Horarios Disponibles</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>Día</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Actividad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($horarios as $h): ?>
                <tr>
                    <td><?= $h['dia'] ?></td>
                    <td><?= $h['hora_inicio'] ?></td>
                    <td><?= $h['hora_fin'] ?></td>
                    <td><?= $h['actividad'] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($horarios)): ?>
                <tr><td colspan="4" class="text-center text-muted">No hay horarios disponibles.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
