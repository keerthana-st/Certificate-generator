<?php
$conn = new mysqli("localhost", "root", "", "internship_db");
$result = $conn->query("SELECT * FROM applications");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2 class="mb-4 text-center">Internship Applications</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th><th>Name</th><th>Email</th><th>Domain</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['name'] ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= $row['domain'] ?></td>
          <td>
            <a href="send-offer.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Generate Offer Letter</a>
            <a href="assign-task.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Assign Task</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
