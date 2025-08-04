<!DOCTYPE html>
<html>
<head>
  <title>Internship Application Form</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

  <h2 class="text-center mb-4">Internship Application Form</h2>

  <form action="submit-application.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light">

    <!-- ✅ Select Domain -->
    <div class="mb-3">
      <label for="domain" class="form-label">Select Domain</label>
      <select class="form-select" name="domain" id="domain" required>
        <option value="" disabled selected>Select your preferred domain</option>
        <option value="AI">AI</option>
        <option value="Cybersecurity">Cybersecurity</option>
        <option value="Web Development">Web Development</option>
        <option value="IoT">IoT</option>
        <option value="Machine Learning">Machine Learning</option>
        <option value="Full Stack">Full Stack</option>
      </select>
    </div>

    <!-- Full Name -->
    <div class="mb-3">
      <label for="name" class="form-label">Full Name (as on Certificate)</label>
      <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your full name">
      <small class="form-text text-danger">Please make sure there is no spelling mistake. It will not be corrected later.</small>
    </div>

    <!-- Email -->
    <div class="mb-3">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
    </div>

    <!-- Gender -->
    <div class="mb-3">
      <label class="form-label">Gender</label><br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
        <label class="form-check-label" for="male">Male</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
        <label class="form-check-label" for="female">Female</label>
      </div>
    </div>

    <!-- College -->
    <div class="mb-3">
      <label for="college" class="form-label">College Name</label>
      <input type="text" class="form-control" id="college" name="college" required placeholder="Enter your college name">
    </div>

    <!-- Contact Number -->
    <div class="mb-3">
      <label for="contact" class="form-label">Contact Number</label>
      <input type="tel" class="form-control" id="contact" name="contact" required placeholder="Enter your mobile number">
    </div>

    <!-- WhatsApp Number -->
    <div class="mb-3">
      <label for="whatsapp" class="form-label">WhatsApp Number</label>
      <input type="tel" class="form-control" id="whatsapp" name="whatsapp" required placeholder="Enter your WhatsApp number">
    </div>

    <!-- Academic Qualification -->
    <div class="mb-3">
      <label for="qualification" class="form-label">Highest Academic Qualification</label>
      <input type="text" class="form-control" id="qualification" name="qualification" required placeholder="e.g., B.E. CSE, BCA, M.Sc. IT">
    </div>

    <!-- Current Year -->
    <div class="mb-3">
      <label for="current_year" class="form-label">Current Academic Year</label>
      <select class="form-select" id="current_year" name="current_year" required>
        <option value="" disabled selected>Select Year</option>
        <option>1st Year</option>
        <option>2nd Year</option>
        <option>3rd Year</option>
        <option>Final Year</option>
        <option>Passed Out</option>
      </select>
    </div>

    <!-- ID Proof Upload -->
    <div class="mb-3">
      <label for="id_proof" class="form-label">Upload Your College ID Proof (PDF/JPG/PNG)</label>
      <input type="file" class="form-control" id="id_proof" name="id_proof" accept=".pdf,.jpg,.jpeg,.png" required>
    </div>

    <!-- Terms and Conditions -->
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
      <label class="form-check-label" for="terms">
        I have understood the internship details and I hereby acknowledge and accept the terms and conditions of CIP.
      </label>
    </div>

    <!-- Submit -->
    <div class="text-center">
      <button type="submit" class="btn btn-primary px-5">Submit Application</button>
    </div>
  </form>

</body>
</html>
