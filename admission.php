<?php include("includes/header.php"); ?>

<?php
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $class = trim($_POST['class']);
    $message = trim($_POST['message']);

    if (!empty($fullname) && !empty($email) && !empty($phone) && !empty($class)) {
        $whatsapp_number = "231886126154";

        $text = "New Admission Application:%0A";
        $text .= "Name: " . urlencode($fullname) . "%0A";
        $text .= "Email: " . urlencode($email) . "%0A";
        $text .= "Phone: " . urlencode($phone) . "%0A";
        $text .= "Class: " . urlencode($class) . "%0A";
        $text .= "Message: " . urlencode($message);

        $whatsapp_url = "https://wa.me/$whatsapp_number?text=$text";

        $to = "info@logicschool.edu.lr";
        $subject = "New Admission Application";
        $body = "\nNew Admission Application:\n\nFull Name: $fullname\nEmail: $email\nPhone: $phone\nClass: $class\nMessage: $message\n";
        $headers = "From: no-reply@logicschool.edu.lr";

        mail($to, $subject, $body, $headers);
        header("Location: $whatsapp_url");
        exit();
    } else {
        $error = "Please fill all required fields.";
    }
}
?>

<section class="page-banner page-banner-image d-flex align-items-center text-center text-light" style="background-image: linear-gradient(rgba(44, 0, 62, 0.6), rgba(75, 0, 130, 0.6)), url('assets/images/slider1.jpeg');">
  <div class="container">
    <h1 class="display-5 fw-bold">Admissions</h1>
    <p class="lead">Join Logic Demonstration School today.</p>
  </div>
</section>

<section class="container py-4 cta-block text-center" data-animate>
  <h4 class="text-white mb-2">Admissions Office</h4>
  <p class="mb-0">Monday - Friday, 8:00 AM - 4:00 PM</p>
</section>

<section class="py-5" data-animate>
  <div class="container">
    <h2 class="section-title text-center mb-4">Admission Requirements</h2>
    <div class="row g-3">
      <div class="col-md-6"><div class="info-card">Completed Application Form</div></div>
      <div class="col-md-6"><div class="info-card">Birth Certificate</div></div>
      <div class="col-md-6"><div class="info-card">Previous School Records</div></div>
      <div class="col-md-6"><div class="info-card">Two Passport Photos</div></div>
    </div>
  </div>
</section>

<section class="py-5 bg-light" data-animate>
  <div class="container text-center">
    <h2 class="section-title mb-4">Admission Process</h2>
    <div class="row g-3">
      <div class="col-md-3"><div class="process-card">1. Apply Online</div></div>
      <div class="col-md-3"><div class="process-card">2. Review</div></div>
      <div class="col-md-3"><div class="process-card">3. Approval</div></div>
      <div class="col-md-3"><div class="process-card">4. Enrollment</div></div>
    </div>
  </div>
</section>

<section class="py-5" data-animate>
  <div class="container">
    <h2 class="section-title text-center mb-4">Online Application Form</h2>

    <?php if ($error): ?>
      <div class="alert alert-danger text-center"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="row g-3">
        <div class="col-md-6"><input type="text" name="fullname" class="form-control" placeholder="Full Name *" required></div>
        <div class="col-md-6"><input type="email" name="email" class="form-control" placeholder="Email Address *" required></div>
        <div class="col-md-6"><input type="text" name="phone" class="form-control" placeholder="Phone Number *" required></div>
        <div class="col-md-6">
          <select name="class" class="form-select" required>
            <option value="">Select Class *</option>
            <option>Daycare</option>
            <option>Pre-Nursery</option>
            <option>Kindergarten</option>
            <option>Grade 1</option>
            <option>Grade 2</option>
            <option>Grade 3</option>
            <option>Grade 4</option>
            <option>Grade 5</option>
            <option>Grade 6</option>
          </select>
        </div>
        <div class="col-12"><textarea name="message" rows="4" class="form-control" placeholder="Additional Information (Optional)"></textarea></div>
        <div class="col-12 text-center"><button type="submit" class="btn btn-school btn-lg">Submit Application</button></div>
      </div>
    </form>
  </div>
</section>

<?php include("includes/footer.php"); ?>
