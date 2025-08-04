<?php
require_once('database/db-config.php'); // DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name          = $_POST['name'] ?? '';
    $email         = $_POST['email'] ?? '';
    $gender        = $_POST['gender'] ?? '';
    $domain        = $_POST['domain'] ?? '';
    $college       = $_POST['college'] ?? '';
    $contact       = $_POST['contact'] ?? '';
    $whatsapp      = $_POST['whatsapp'] ?? '';
    $qualification = $_POST['qualification'] ?? '';
    $year          = $_POST['current_year'] ?? '';
    $agree         = isset($_POST['terms']) ? 'Yes' : 'No';

    // Upload ID Proof
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0775, true);
    }

    $id_proof_path = "";

    if (isset($_FILES['id_proof']) && $_FILES['id_proof']['error'] == UPLOAD_ERR_OK) {
        $originalName = $_FILES['id_proof']['name'];
        $fileTmpPath = $_FILES['id_proof']['tmp_name'];
        $fileExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowedExt = ['pdf', 'jpg', 'jpeg', 'png'];

        if (in_array($fileExt, $allowedExt)) {
            $newFileName = time() . "_" . uniqid() . "." . $fileExt;
            $targetFilePath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                $id_proof_path = $targetFilePath;
            } else {
                echo "<script>alert('❌ Failed to upload ID proof.'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('❌ Invalid file type. Only PDF, JPG, JPEG, PNG allowed.'); window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('❌ Please upload your College ID proof.'); window.history.back();</script>";
        exit;
    }

    // Check for required fields
    if ($name && $email && $domain && $id_proof_path) {
        $sql = "INSERT INTO applications 
                (name, email, gender, domain, college, contact_no, whatsapp_no, qualification, current_year, id_proof) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", 
            $name, $email, $gender, $domain, $college, 
            $contact, $whatsapp, $qualification, $year, $id_proof_path);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Application submitted successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('❌ Database error: " . $conn->error . "'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('❌ Please fill all required fields.'); window.history.back();</script>";
    }

    $conn->close();
} else {
    echo "❌ Invalid request.";
}
