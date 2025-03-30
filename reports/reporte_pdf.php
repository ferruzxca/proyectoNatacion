<?php
require('../fpdf/fpdf.php');
require('../database/conexion.php');

ob_start();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Encabezado del reporte
$pdf->Cell(190, 10, utf8_decode('Centro de Natación Innovex'), 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 10, utf8_decode('Reporte de Usuarios Inscritos'), 0, 1, 'C');
$pdf->Ln(10);

// Encabezados de tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C');
$pdf->Cell(60, 10, utf8_decode('Nombre'), 1, 0, 'C');
$pdf->Cell(20, 10, utf8_decode('Edad'), 1, 0, 'C');
$pdf->Cell(40, 10, utf8_decode('Nivel'), 1, 0, 'C');
$pdf->Cell(40, 10, utf8_decode('Inscripción'), 1, 1, 'C');

// Contenido de la tabla
$pdf->SetFont('Arial', '', 10);
$stmt = $conn->query("SELECT * FROM usuarios_natacion");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $u) {
    $pdf->Cell(10, 10, $u['id'], 1);
    $pdf->Cell(60, 10, utf8_decode($u['nombre']), 1);
    $pdf->Cell(20, 10, $u['edad'], 1);
    $pdf->Cell(40, 10, utf8_decode($u['nivel']), 1);
    $pdf->Cell(40, 10, $u['fecha_inscripcion'], 1);
    $pdf->Ln();
}

ob_end_clean();
$pdf->Output('I', 'reporte_usuarios_natacion.pdf');
exit;
