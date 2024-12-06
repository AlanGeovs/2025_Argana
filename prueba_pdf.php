<?php
require 'vendor/autoload.php'; // Cargar todas las dependencias instaladas por Composer

// Crear un nuevo documento PDF usando TCPDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('Helvetica', '', 12);
$pdf->Write(0, 'Hola, este es un PDF generado con TCPDF!');
$pdf->Output('ejemplo.pdf', 'I');
