<?php include("includes/header.php"); ?>

<section class="page-banner page-banner-image d-flex align-items-center text-center text-light" style="background-image: linear-gradient(rgba(44, 0, 62, 0.6), rgba(75, 0, 130, 0.6)), url('assets/images/slider2.jpeg');">
  <div class="container">
    <h1 class="display-5 fw-bold">Photo Gallery</h1>
    <p class="lead">Moments from school life and activities.</p>
  </div>
</section>

<section class="py-5" data-animate>
  <div class="container">
    <div class="text-center mb-4">
      <button class="btn btn-outline-primary filter-btn active" data-filter="all">All</button>
      <button class="btn btn-outline-primary filter-btn" data-filter="events">Events</button>
      <button class="btn btn-outline-primary filter-btn" data-filter="classroom">Classroom</button>
      <button class="btn btn-outline-primary filter-btn" data-filter="activities">Activities</button>
    </div>

    <div class="row g-3">
      <div class="col-md-4 gallery-item events"><img src="assets/images/slider1.jpeg" class="gallery-img" alt="Event"></div>
      <div class="col-md-4 gallery-item classroom"><img src="assets/images/slider2.jpeg" class="gallery-img" alt="Classroom"></div>
      <div class="col-md-4 gallery-item activities"><img src="assets/images/slider3.jpeg" class="gallery-img" alt="Activity"></div>
      <div class="col-md-4 gallery-item events"><img src="assets/images/slider2.jpeg" class="gallery-img" alt="Event"></div>
      <div class="col-md-4 gallery-item classroom"><img src="assets/images/slider3.jpeg" class="gallery-img" alt="Classroom"></div>
      <div class="col-md-4 gallery-item activities"><img src="assets/images/slider1.jpeg" class="gallery-img" alt="Activity"></div>
    </div>
  </div>
</section>

<div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body text-center">
        <img src="" id="lightboxImage" class="img-fluid rounded" alt="Preview">
      </div>
    </div>
  </div>
</div>

<section class="py-5 bg-light" data-animate>
  <div class="container text-center">
    <h2 class="section-title">Watch Logic School In Action</h2>
    <p class="lead">A quick look into our classrooms and student activities.</p>
    <div class="row justify-content-center mt-3">
      <div class="col-lg-8">
        <div class="ratio ratio-16x9 shadow rounded overflow-hidden">
          <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="School Video" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include("includes/footer.php"); ?>
