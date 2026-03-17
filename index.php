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

<section class="py-5 proprietor-section" data-animate>
  <div class="container">
    <div class="proprietor-wrap">
      <div class="row g-4 align-items-center">
        <div class="col-lg-5 text-center text-lg-start">
          <div class="proprietor-photo-frame mx-auto mx-lg-0">
            <img src="assets/images/logo.png" class="img-fluid proprietor-photo" alt="Proprietor portrait">
          </div>
        </div>
        <div class="col-lg-7">
          <span class="proprietor-kicker">Proprietor's Message</span>
          <h2 class="section-title mb-3">A Welcome From The Proprietor</h2>
          <p class="proprietor-text">At Logic Demonstration School, we believe every child deserves a safe and inspiring environment where excellence and values grow together.</p>
          <p class="proprietor-text">Our mission is to nurture confident learners through quality teaching, discipline, creativity, and strong partnership with families and the community.</p>
          <div class="proprietor-signature mt-3">
            <h6 class="mb-0">Proprietor Name</h6>
            <small>Proprietor, Logic Demonstration School</small>
          </div>
          <a href="about.php" class="btn btn-school mt-4">Read More About Our Vision</a>
        </div>
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

<!-- ================= VIDEO + WHY CHOOSE US ================= -->
<section class="py-5 bg-light" data-animate>
  <div class="container">
    <div class="row g-4 align-items-center">

      <div class="col-lg-6">
        <div class="ratio ratio-16x9 rounded overflow-hidden shadow">
          <iframe src="https://www.youtube.com/embed/Eh_i8UBr7MQ?rel=0"
            title="Logic Demonstration School"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        </div>
      </div>

      <div class="col-lg-6">
        <h2 class="section-title mb-1">Why Choose Logic School?</h2>
        <p class="text-muted mb-4">We don't just teach — we shape futures.</p>

        <div class="why-list">
          <div class="why-list-item">
            <div class="why-list-icon"><i class="bi bi-patch-check-fill"></i></div>
            <div>
              <h6 class="mb-1">Quality Academic Programs</h6>
              <p class="mb-0 text-muted">A structured curriculum from Early Childhood through Upper Elementary.</p>
            </div>
          </div>
          <div class="why-list-item">
            <div class="why-list-icon"><i class="bi bi-people-fill"></i></div>
            <div>
              <h6 class="mb-1">Experienced & Caring Staff</h6>
              <p class="mb-0 text-muted">Qualified teachers dedicated to every child's growth and wellbeing.</p>
            </div>
          </div>
          <div class="why-list-item">
            <div class="why-list-icon"><i class="bi bi-shield-fill-check"></i></div>
            <div>
              <h6 class="mb-1">Safe & Nurturing Environment</h6>
              <p class="mb-0 text-muted">A secure space where students feel valued, confident, and motivated.</p>
            </div>
          </div>
          <div class="why-list-item">
            <div class="why-list-icon"><i class="bi bi-heart-fill"></i></div>
            <div>
              <h6 class="mb-1">Values-Based Education</h6>
              <p class="mb-0 text-muted">Love, unity, discipline, and peaceful co-existence woven into every lesson.</p>
            </div>
          </div>
        </div>

        <a href="about.php" class="btn btn-school mt-4">Discover More About Us</a>
      </div>

    </div>
  </div>
</section>

<!-- ================= ADMINISTRATION ================= -->
<section class="py-5" data-animate>
  <div class="container">
    <h2 class="section-title text-center mb-2">Meet Our Administration</h2>
    <p class="text-center text-muted mb-5">The dedicated leaders who guide our school every day.</p>
    <div class="row g-4 justify-content-center">

      <div class="col-6 col-md-4 col-lg-3">
        <div class="admin-card text-center">
          <div class="admin-photo-wrap">
            <img src="assets/images/Princapal.jpeg" class="team-photo" alt="Principal">
          </div>
          <h6 class="mt-3 mb-1">Mr. Gabriel G. P. Zeekor </h6>
          <span class="admin-role">Principal</span>
        </div>
      </div>

      <div class="col-6 col-md-4 col-lg-3">
        <div class="admin-card text-center">
          <div class="admin-photo-wrap">
            <img src="assets/images/SA.png" class="team-photo" alt="Vice Principal">
          </div>
          <h6 class="mt-3 mb-1">Mr. G. Alphanso Menyon </h6>
          <span class="admin-role">Chief Learning Officer</span>
        </div>
      </div>

      <div class="col-6 col-md-4 col-lg-3">
        <div class="admin-card text-center">
          <div class="admin-photo-wrap">
            <img src="assets/images/Dean.jpeg" class="team-photo" alt="Academic Dean">
          </div>
          <h6 class="mt-3 mb-1">Ms. Joevina C. Grant</h6>
          <span class="admin-role">Academic Dean</span>
        </div>
      </div>

      <div class="col-6 col-md-4 col-lg-3">
        <div class="admin-card text-center">
          <div class="admin-photo-wrap">
            <img src="assets/images/Business_manager.jpeg" class="team-photo" alt="Bursar">
          </div>
          <h6 class="mt-3 mb-1">Mrs. Meme Johnson Menyon </h6>
          <span class="admin-role">Business Manager</span>
        </div>
      </div>

    </div>
    <div class="text-center mt-4">
      <a href="about.php#administration" class="btn btn-outline-secondary">View Full Team</a>
    </div>
  </div>
</section>

<!-- ================= PARENT TESTIMONIALS ================= -->
<section class="py-5 testimonial-section" data-animate>
  <div class="container">
    <h2 class="section-title text-center mb-2">What Parents Say</h2>
    <p class="text-center text-muted mb-5">Hear from families who trust us with their children's education.</p>

    <div class="row g-4">

      <div class="col-md-4">
        <div class="testimonial-card">
          <div class="testimonial-quote"><i class="bi bi-quote"></i></div>
          <p class="testimonial-text">"Logic School has transformed my child's confidence and love for learning. The teachers are caring and very professional."</p>
          <div class="testimonial-author">
            <img src="assets/images/logo.png" class="testimonial-avatar" alt="Parent">
            <div>
              <strong>Parent Name</strong>
              <small class="d-block text-muted">Parent of Grade 3 Student</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="testimonial-card">
          <div class="testimonial-quote"><i class="bi bi-quote"></i></div>
          <p class="testimonial-text">"The values and discipline taught at Logic School are remarkable. My son has grown so much both academically and in character."</p>
          <div class="testimonial-author">
            <img src="assets/images/logo.png" class="testimonial-avatar" alt="Parent">
            <div>
              <strong>Parent Name</strong>
              <small class="d-block text-muted">Parent of Grade 5 Student</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="testimonial-card">
          <div class="testimonial-quote"><i class="bi bi-quote"></i></div>
          <p class="testimonial-text">"I am proud to have my daughter enrolled here. The school genuinely cares about every child and it shows in the results."</p>
          <div class="testimonial-author">
            <img src="assets/images/logo.png" class="testimonial-avatar" alt="Parent">
            <div>
              <strong>Parent Name</strong>
              <small class="d-block text-muted">Parent of Kindergarten Student</small>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ================= DOWNLOADS ================= -->
<section class="py-5 downloads-section" data-animate>
  <div class="container">
    <div class="downloads-wrap">
      <div class="text-center mb-4">
        <h2 class="section-title mb-2">Download School Documents</h2>
        <p class="text-muted mb-0">Get the latest brochure and information sheet for admissions and programs.</p>
      </div>
      <div class="row g-4 justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="download-card">
            <div class="download-icon"><i class="bi bi-file-earmark-pdf-fill"></i></div>
            <h5 class="mb-2">School Brochure</h5>
            <p class="mb-3">Overview of our programs, facilities, and student life at Logic Demonstration School.</p>
            <a href="assets/files/logic-school-brochure.pdf" class="btn btn-school" download>
              <i class="bi bi-download me-1"></i> Download Brochure
            </a>
          </div>
        </div>
        <div class="col-md-6 col-lg-5">
          <div class="download-card">
            <div class="download-icon"><i class="bi bi-file-earmark-text-fill"></i></div>
            <h5 class="mb-2">Information Sheet</h5>
            <p class="mb-3">Quick facts on admission process, school calendar, contacts, and key requirements.</p>
            <a href="assets/files/logic-school-information-sheet.pdf" class="btn btn-outline-secondary" download>
              <i class="bi bi-download me-1"></i> Download Info Sheet
            </a>
          </div>
        </div>
      </div>
      <p class="text-center text-muted small mt-4 mb-0">Need help? Call us at (+231) 886-126-154 for assistance.</p>
    </div>
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
