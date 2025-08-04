<?php
require_once('utils/fpdf/fpdf.php');

// Accept POST data or use default values
$name = isset($_POST['name']) ? $_POST['name'] : 'A.NAVEENKUMAR';
$regNo = isset($_POST['regno']) ? $_POST['regno'] : '23UCS142';
$college = isset($_POST['college']) ? $_POST['college'] : 'K.S.RANGASAMY COLLEGE OF ARTS AND SCIENCE (Autonomous)';
$domain = isset($_POST['domain']) ? $_POST['domain'] : 'MACHINE LEARNING AND DEEP LEARNING USING PYTHON';
$certificateId = isset($_POST['id']) ? $_POST['id'] : '04062025201';
$startDate = isset($_POST['start']) ? $_POST['start'] : '15.05.2025';
$endDate = isset($_POST['end']) ? $_POST['end'] : '04.06.2025';
$date = date('d-m-Y');

// Save PDF path
$filename = "certificate_$certificateId.pdf";
$certificatePath = "certificates/" . $filename;

// Create 'certificates' directory if not exists
if (!is_dir('certificates')) {
    mkdir('certificates', 0777, true);
}

// Initialize PDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// Optional: Add background image
if (file_exists('assets/certificate-bg.jpg')) {
    $pdf->Image('assets/certificate-bg.jpg', 0, 0, 210, 297);
}

// Set text color and font
$pdf->SetTextColor(0, 0, 0);

// Header Title
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetXY(0, 40);
$pdf->Cell(210, 10, "Internship Training", 0, 1, 'C');

// Certificate Number
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(20, 55);
$pdf->Cell(0, 10, "Certificate No: $certificateId", 0, 1, 'L');

// Certificate Body
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(20, 70);
$pdf->MultiCell(170, 8,
    "This is to inform that $name (Reg no: $regNo) student of $college handled $domain Internship in our organization from ($startDate) to ($endDate).\n\n" .
    "During this internship training, he has learned the overview concepts of $domain."
);

// Footer with issue date
$pdf->SetFont('Arial', '', 11);
$pdf->SetXY(20, 250);
$pdf->Cell(0, 10, "Date: $date", 0, 0, 'L');

// Output PDF to file
$pdf->Output('F', $certificatePath);

// Display confirmation message and download link
echo "<h3>✅ Certificate generated successfully!</h3>";
echo "<p><a href='$certificatePath' target='_blank'>🎓 View Certificate</a></p>";
?>
