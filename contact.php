<?php include("includes/header.php"); ?>

<?php
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } else {
            $to = "info@logicschool.com";
            $email_subject = "Contact Form: $subject";

            $body = "\nNew Contact Message:\n\nName: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message\n";

            $headers = "From: no-reply@logicatschool.com\r\n";
            $headers .= "Reply-To: $email\r\n";

            mail($to, $email_subject, $body, $headers);
            $success = "Your message has been sent successfully!";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<section class="page-banner page-banner-image d-flex align-items-center text-center text-light" style="background-image: linear-gradient(rgba(44, 0, 62, 0.6), rgba(75, 0, 130, 0.6)), url('assets/images/banner7.jpeg');">
  <div class="container">
    <h1 class="display-5 fw-bold">Contact Us</h1>
    <p class="lead">We would love to hear from you.</p>
  </div>
</section>

<section class="py-5" data-animate>
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-5">
        <div class="contact-card">
          <h3 class="section-title">Get In Touch</h3>
          <p><strong>Address:</strong><br>Block C, Pagos Island, Congo Town, Liberia</p>
          <p><strong>Phone:</strong><br>(+231) 777-297-443</p>
          <p><strong>Email:</strong><br>info@logicatschool.com</p>
          <p><strong>Office Hours:</strong><br>Monday - Friday: 8:00 AM - 4:00 PM</p>
          <a href="https://wa.me/231777297443?text=Hello%20Logic%20School,%20I%20need%20more%20information." class="btn btn-success" target="_blank">Chat on WhatsApp</a>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="contact-card">
          <h3 class="section-title">Send A Message</h3>

          <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
          <?php endif; ?>

          <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
          <?php endif; ?>

          <form method="POST">
            <div class="mb-3"><input type="text" name="name" class="form-control" placeholder="Full Name *" required></div>
            <div class="mb-3"><input type="email" name="email" class="form-control" placeholder="Email Address *" required></div>
            <div class="mb-3"><input type="text" name="subject" class="form-control" placeholder="Subject *" required></div>
            <div class="mb-3"><textarea name="message" rows="5" class="form-control" placeholder="Your Message *" required></textarea></div>
            <button type="submit" class="btn btn-school btn-lg">Send Message</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="pb-5" data-animate>
  <div class="container">
    <div class="ratio ratio-16x9 shadow rounded overflow-hidden">
      <iframe src="https://www.google.com/maps?q=CongoTown,Liberia&output=embed" allowfullscreen></iframe>
    </div>
  </div>
</section>

<?php include("includes/footer.php"); ?>
