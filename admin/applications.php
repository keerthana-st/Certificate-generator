<!DOCTYPE html>
<html>
<head>
  <title>Applications - Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

<h2 class="mb-4">Student Internship Applications</h2>

<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Course</th>
      <th>Email</th>
      <th>Task</th>
      <th>Offer Letter</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $conn = new mysqli("localhost", "root", "", "internship_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM applications ORDER BY id DESC");

    while ($row = $result->fetch_assoc()) {
  ?>
    <tr>
      <td><?= htmlspecialchars($row['id']) ?></td>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['domain']) ?></td> <!-- Use 'domain' if 'course' doesn't exist -->
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td><?= nl2br(htmlspecialchars($row['task'])) ?></td>
      <td>
        <a href="send-offer.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">
          Generate Offer Letter
        </a>
        <br>
        <a href="../offers/offer_letter_<?= $row['id'] ?>.pdf" target="_blank" class="btn btn-sm btn-outline-secondary mt-1">
          View PDF
        </a>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>

<a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>

</body>
</html>
