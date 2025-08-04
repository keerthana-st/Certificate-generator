<?php
// ✅ Connect to the database
$conn = new mysqli("localhost", "root", "", "internship_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Get student data by ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$student = $conn->query("SELECT * FROM applications WHERE id = $id")->fetch_assoc();
if (!$student) {
    die("Student not found.");
}

// ✅ Handle form POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $conn->real_escape_string($_POST['task']);
    $deadline = $conn->real_escape_string($_POST['deadline']);
    $studentId = intval($_POST['id']);

    // ✅ UPDATE the task and deadline
    $sql = "UPDATE applications SET task='$task', deadline='$deadline' WHERE id=$studentId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Task assigned successfully!'); window.location.href='dashboard.php';</script>";
        exit;
    } else {
        echo "<script>alert('❌ Database Error: " . $conn->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Assign Task - <?= htmlspecialchars($student['name']) ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

  <h2 class="mb-4">Assign Task to <?= htmlspecialchars($student['name']) ?></h2>

  <form method="post">
    <input type="hidden" name="id" value="<?= $id ?>">

    <div class="mb-3">
      <label class="form-label">Task Description</label>
      <textarea name="task" class="form-control" rows="4" required placeholder="Enter task to assign..."></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Deadline</label>
      <input type="date" name="deadline" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Assign Task</button>
    <a href="dashboard.php" class="btn btn-secondary">Back</a>
  </form>

</body>
</html>
