function generateOfferLetterPDF($name, $course, $startDate, $endDate, $duration, $id, $savePath, $bgPath) {
    $pdf = new PDFWithBackground();
    $pdf->AddPage();

    // White rectangle for text clarity
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Rect(10, 20, 190, 250, 'F');

    $pdf->SetFont('Arial', 'B', 18);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, 10, 'INTERNSHIP OFFER LETTER', 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Date: " . date("d-m-Y"), 0, 0, 'L');
    $pdf->Cell(0, 10, "Certificate No: $id", 0, 1, 'R');
    $pdf->Ln(5);

    $body = "Dear $name,\n\n".
        "We would like to congratulate you on being selected for the \"$course\" virtual internship position with \"Training Trains\". ".
        "We at Training Trains are excited that you will join our team.\n\n".
        "The duration of the internship will be of $duration weeks, starting from $startDate to $endDate. ".
        "The internship is an educational opportunity for you; hence the primary focus is on learning and developing new skills ".
        "and gaining hands-on knowledge. We believe that you will perform all your tasks/projects.\n\n".
        "As an intern, we expect you to perform all assigned tasks to the best of your ability and follow any lawful and reasonable instructions provided to you.\n\n".
        "We are confident that this internship will be a valuable experience for you. ".
        "We look forward to working with you and helping you achieve your career goals.\n\n".
        "By accepting this offer, you commit to executing assigned tasks diligently and ensuring excellence in all aspects of your work.\n\n".
        "Best of Luck!\n\nThank You!";

    $pdf->MultiCell(0, 8, $body);
    $pdf->Ln(10);
    $pdf->Cell(0, 10, '_______________________', 0, 1);
    $pdf->Cell(0, 7, 'Founder (Training Trains)', 0, 1);

    $pdf->Output('F', $savePath); // Save as file
}
