<?php
$conn = new mysqli("localhost", "root", "", "internship");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$payment_status = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $payment_status = "❌ Invalid email address.";
    } else {
        $stmt = $conn->prepare("UPDATE applications SET payment_done = 1 WHERE email = ?");
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $payment_status = "✅ Payment marked as complete! You’ll receive your certificate soon.";
        } else {
            $payment_status = "❌ Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pay for Certificate</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

  <h2 class="text-center mb-4">Internship Certificate Payment</h2>

  <?php if ($payment_status): ?>
    <div class="alert alert-info text-center"><?= $payment_status ?></div>
  <?php endif; ?>

  <form method="post" class="p-4 border rounded bg-light">
    <div class="mb-3">
      <label class="form-label">Registered Email</label>
      <input type="email" name="email" class="form-control" required placeholder="Enter your registered email">
    </div>

    <div class="mb-3">
      <p>Pay ₹99 via UPI / Razorpay / Google Pay.<br>
      <strong>UPI ID:</strong> cip@upi<br>
      <strong>Note:</strong> Use your <u>email</u> as payment reference.</p>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">✅ I Have Paid ₹99</button>
    </div>
  </form>

</body>
</html>
