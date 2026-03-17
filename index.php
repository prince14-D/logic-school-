<?php include("includes/header.php"); ?>

<section id="homeSlider">
  <div id="mainCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4500">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/images/slider1.jpeg" class="d-block w-100 slider-img" alt="School campus">
        <div class="carousel-caption">
          <h1>Logic - A Demonstration School</h1>
          <p class="lead">Come As A Student, Leave As A Student</p>
          <a href="admission.php" class="btn btn-school btn-lg">Apply Now</a>
        </div>
      </div>

      <div class="carousel-item">
        <img src="assets/images/slider2.jpeg" class="d-block w-100 slider-img" alt="Students learning">
        <div class="carousel-caption">
          <h1>Creative Learning Environment</h1>
          <p>Building strong foundations for young minds.</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="assets/images/slider3.jpeg" class="d-block w-100 slider-img" alt="School values">
        <div class="carousel-caption">
          <h1>Values and Excellence</h1>
          <p>Love, unity, discipline, and growth.</p>
        </div>
      </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</section>

<section class="container my-5 admissions-cta p-4 p-md-5" data-animate>
  <div class="row align-items-center">
    <div class="col-lg-8 text-center text-lg-start">
      <h2 class="section-title text-white">Admissions Now Open</h2>
      <p class="mb-0">Give your child a strong academic and moral foundation in a nurturing school community.</p>

      <div id="countdown" data-deadline="2026-09-30T23:59:59" class="d-flex flex-wrap gap-2 gap-md-3 mt-4 justify-content-center justify-content-lg-start">
        <div class="time-box"><h3 id="days">00</h3><small>Days</small></div>
        <div class="time-box"><h3 id="hours">00</h3><small>Hours</small></div>
        <div class="time-box"><h3 id="minutes">00</h3><small>Minutes</small></div>
        <div class="time-box"><h3 id="seconds">00</h3><small>Seconds</small></div>
      </div>
    </div>

    <div class="col-lg-4 text-center mt-4 mt-lg-0">
      <a href="admission.php" class="btn btn-school btn-lg w-100 mb-2">Start Application</a>
      <a href="contact.php" class="btn btn-outline-light btn-lg w-100">Talk To Us</a>
    </div>
  </div>
</section>

<section class="py-3" data-animate>
  <div class="container">
    <div class="row g-3">
      <div class="col-md-4">
        <div class="why-card text-center">
          <div class="why-icon">🎓</div>
          <h5>Experienced Teachers</h5>
          <p class="mb-0">Dedicated educators guiding every child to excel.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="why-card text-center">
          <div class="why-icon">🛡️</div>
          <h5>Safe Environment</h5>
          <p class="mb-0">A secure and supportive space for learning and growth.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="why-card text-center">
          <div class="why-icon">🌱</div>
          <h5>Strong Values</h5>
          <p class="mb-0">Discipline, unity, and responsibility at the core.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5" data-animate>
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-md-6">
        <img src="assets/images/logo.png" class="img-fluid rounded shadow" alt="School logo">
      </div>
      <div class="col-md-6">
        <h2 class="section-title">Welcome To Logic School</h2>
        <p>Logic Demonstration School was established in the 2019-2020 academic year with a mission to deliver quality education and shape future leaders.</p>
        <p>We combine academic excellence with character development to prepare students for success in school and life.</p>
        <a href="about.php" class="btn btn-school">Learn More About Us</a>
      </div>
    </div>
  </div>
</section>

<section class="stats-section py-5 text-center text-light" data-animate>
  <div class="container">
    <h2 class="text-white">Our Impact</h2>
    <div class="row g-3 mt-3">
      <div class="col-md-3"><div class="stat-card"><h3>2019</h3><p>Founded</p></div></div>
      <div class="col-md-3"><div class="stat-card"><h3><?php echo date("Y") - 2019; ?>+</h3><p>Years</p></div></div>
      <div class="col-md-3"><div class="stat-card"><h3>98%</h3><p>Success Rate</p></div></div>
      <div class="col-md-3"><div class="stat-card"><h3>3</h3><p>Academic Levels</p></div></div>
    </div>
  </div>
</section>

<section class="py-5 text-center" data-animate>
  <div class="container">
    <h2 class="section-title">Academic Programs</h2>
    <div class="row g-4 mt-2">
      <div class="col-md-4">
        <div class="program-card">
          <div class="program-icon">🧸</div>
          <h5>Early Childhood</h5>
          <p class="mb-0">Daycare, Pre-Nursery, and Kindergarten.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="program-card">
          <div class="program-icon">📘</div>
          <h5>Lower Elementary</h5>
          <p class="mb-0">Grades 1-3 focused on foundational mastery.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="program-card">
          <div class="program-icon">📗</div>
          <h5>Upper Elementary</h5>
          <p class="mb-0">Grades 4-6 preparing for higher levels.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="gallery-section py-5" data-animate>
  <div class="container text-center">
    <h2 class="section-title">School Activities</h2>
    <div class="row g-3 mt-2">
      <div class="col-md-4"><img src="assets/images/slider1.jpeg" class="gallery-img" alt="Activity one"></div>
      <div class="col-md-4"><img src="assets/images/slider2.jpeg" class="gallery-img" alt="Activity two"></div>
      <div class="col-md-4"><img src="assets/images/slider3.jpeg" class="gallery-img" alt="Activity three"></div>
    </div>
    <a href="gallery.php" class="btn btn-school mt-4">View Full Gallery</a>
  </div>
</section>

<div class="contact-float">
  <div class="contact-options">
    <a href="tel:+231886126154" class="contact-item"><i class="bi bi-telephone-fill"></i></a>
    <a href="mailto:info@logicschool.edu.lr" class="contact-item"><i class="bi bi-envelope-fill"></i></a>
    <a href="https://wa.me/231886126154" class="contact-item"><i class="bi bi-whatsapp"></i></a>
  </div>
  <button class="contact-toggle"><i class="bi bi-chat-dots-fill"></i></button>
</div>

<?php include("includes/footer.php"); ?>
