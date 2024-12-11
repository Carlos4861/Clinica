<?php
require 'fpdf/fpdf.php';

class Pdf {
    public static function generate($patient_id, $doctor_id, $datetime) {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Confirmación de Cita', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, "Paciente ID: $patient_id", 0, 1);
        $pdf->Cell(0, 10, "Doctor ID: $doctor_id", 0, 1);
        $pdf->Cell(0, 10, "Fecha y Hora: $datetime", 0, 1);

        $pdf->Output('I', 'Cita.pdf');
    }
}
?>
