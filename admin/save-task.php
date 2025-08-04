<?php
require '../utils/pdf-generator.php'; // ✅ Include the PDF generator

// ✅ Connect to the database
$conn = new mysqli("localhost", "root", "", "internship_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Handle the form POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $conn->real_escape_string($_POST['task']);
    $deadline = $conn->real_escape_string($_POST['deadline']);
    $studentId = intval($_POST['id']);

    // ✅ Update task and deadline in DB
    $updateSQL = "UPDATE applications SET task='$task', deadline='$deadline' WHERE id=$studentId";
    
    if ($conn->query($updateSQL) === TRUE) {
        // ✅ Fetch student details for offer letter
        $student = $conn->query("SELECT * FROM applications WHERE id = $studentId")->fetch_assoc();
        if (!$student) {
            die("Student not found for offer letter.");
        }

        // ✅ Prepare data for offer letter
        $name = $student['name'];
        $course = $student['domain'];
        $date = date("d/m/Y");
        $pdfFilename = "offer_letter_$studentId.pdf";
        $pdfPath = "../offers/" . $pdfFilename;

        // ✅ Generate the PDF
        generateOfferLetterPDF($name, $course, $date, "CS24NY$studentId", $pdfPath);

        // ✅ Notify and redirect
        echo "<script>alert('✅ Task assigned & Offer letter generated successfully!'); window.location.href='dashboard.php';</script>";
        exit;
    } else {
        echo "<script>alert('❌ Error updating task: " . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('❌ Invalid request method.');</script>";
}
?>
