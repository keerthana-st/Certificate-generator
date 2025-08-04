<?php
$conn = new mysqli("localhost", "root", "", "internship_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $college = $_POST['college'] ?? '';
    $domain = $_POST['domain'] ?? '';
    $github_link = $_POST['task_submission_link'] ?? '';
    $linkedin_link = $_POST['linkedin_link'] ?? '';
    $certificate_id = $_POST['certificate_id'] ?? '';

    // Validation
    if ($name && $college && $domain && $github_link && $linkedin_link && $certificate_id) {
        $name = $conn->real_escape_string($name);
        $college = $conn->real_escape_string($college);
        $domain = $conn->real_escape_string($domain);
        $github_link = $conn->real_escape_string($github_link);
        $linkedin_link = $conn->real_escape_string($linkedin_link);
        $certificate_id = $conn->real_escape_string($certificate_id);

        // Update based on offer letter ID
        $sql = "UPDATE applications SET 
                    linkedin_link='$linkedin_link',
                    task_submission_link='$github_link'
                WHERE CONCAT('CS24NY', id) = '$certificate_id'";

        if ($conn->query($sql) === TRUE) {
            $message = "✅ Task submitted successfully!";
        } else {
            $message = "❌ Database error: " . $conn->error;
        }
    } else {
        $message = "❌ Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Submit Internship Task</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2 class="mb-4 text-center">Internship Task Submission Form</h2>

  <?php if ($message): ?>
    <div class="alert alert-info"><?= $message ?></div>
  <?php endif; ?>

  <form method="post" class="p-4 border rounded bg-light">
    <div class="mb-3">
      <label class="form-label">Your Full Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">College Name</label>
      <input type="text" name="college" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Course / Domain Name</label>
      <input type="text" name="domain" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">GitHub Project Link</label>
      <input type="url" name="task_submission_link" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">LinkedIn Offer Letter Post Link</label>
      <input type="url" name="linkedin_link" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Offer Letter ID</label>
      <input type="text" name="certificate_id" class="form-control" required placeholder="e.g., CS24NY6">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-primary px-5">Submit</button>
    </div>
  </form>
</body>
</html>
