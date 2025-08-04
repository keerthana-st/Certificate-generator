<?php
require '../utils/pdf-generator.php'; // PDF generation with background image

// Connect to database
$conn = new mysqli("localhost", "root", "", "internship_db");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Get student details
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$student = $conn->query("SELECT * FROM applications WHERE id = $id")->fetch_assoc();
if (!$student) {
    die("Student not found.");
}

// Prepare data
$name = strtoupper($student['name']);
$course = strtoupper($student['domain']);
$date = "10/12/2024";
$startDate = "10 December 2024";
$endDate = "10 January 2025";
$company = "CodSoft";
$pdfFilename = "offer_letter_$id.pdf";
$pdfPath = "../offers/" . $pdfFilename;
$offerId = "CS24NY$id";

// Prepare letter content
$content = "
INTERNSHIP OFFER LETTER

Date: $date

Dear,

ID: $offerId

$name

We would like to congratulate you on being selected for the \"$course\" virtual internship position with \"$company\". We at $company are excited that you will join our team.

The duration of the internship will be of 4 weeks, starting from $startDate to $endDate. The internship is an educational opportunity for you hence the primary focus is on learning and developing new skills and gaining hands-on knowledge. We believe that you will perform all your tasks/projects.

As an intern, we expect you to perform all assigned tasks to the best of your ability and follow any lawful and reasonable instructions provided to you.

We are confident that this internship will be a valuable experience for you, we look forward to working with you and helping you achieve your career goals.

By accepting this offer, you commit to executing assigned tasks diligently and ensuring excellence in all aspects of your work.

Best of Luck!

Thank You!
";

// ✅ Call function to generate PDF with all 5 arguments
generateOfferLetterPDF($name, $content, $offerId, $pdfPath, "../assets/certificate-bg.jpg");

// Done
echo "<script>alert('✅ Offer letter generated with background!'); window.location.href='dashboard.php';</script>";
?>
