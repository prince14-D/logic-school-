<?php include("includes/header.php"); ?>

<?php
$allImages = glob('assets/images/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE) ?: [];

// Keep gallery-focused images and avoid branding/utility assets.
$excludedNames = ['logo.png', 'logo.jpg', 'logo.jpeg', 'sa.png'];
$galleryImages = array_filter($allImages, function ($path) use ($excludedNames) {
  $fileName = strtolower(basename($path));
  return !in_array($fileName, $excludedNames, true);
});

usort($galleryImages, function ($a, $b) {
  return filemtime($b) <=> filemtime($a);
});

$galleryImages = array_slice($galleryImages, 0, 20);

$categorizeImage = function ($path) {
  $name = strtolower(basename($path));
  if (strpos($name, 'activity') !== false) {
    return 'activities';
  }
  if (strpos($name, 'teacher') !== false || strpos($name, 'class') !== false || strpos($name, 'tc') === 0) {
    return 'classroom';
  }
  return 'events';
};

$buildAlt = function ($path) {
  $base = pathinfo($path, PATHINFO_FILENAME);
  $clean = preg_replace('/[_-]+/', ' ', $base);
  return ucwords(trim($clean));
};
?>

<section class="page-banner page-banner-image d-flex align-items-center text-center text-light" style="background-image: linear-gradient(rgba(44, 0, 62, 0.6), rgba(75, 0, 130, 0.6)), url('assets/images/slider2.jpeg');">
  <div class="container">
    <h1 class="display-5 fw-bold">Photo Gallery</h1>
    <p class="lead">Moments from school life and activities.</p>
  </div>
</section>

<section class="py-5" data-animate>
  <div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
      <p class="mb-0 text-muted">Showing <?php echo count($galleryImages); ?> photos (maximum 20 displayed).</p>
      <small class="text-muted">Add new photos in assets/images and they will appear automatically.</small>
    </div>

    <div class="text-center mb-4">
      <button class="btn btn-outline-primary filter-btn active" data-filter="all">All</button>
      <button class="btn btn-outline-primary filter-btn" data-filter="events">Events</button>
      <button class="btn btn-outline-primary filter-btn" data-filter="classroom">Classroom</button>
      <button class="btn btn-outline-primary filter-btn" data-filter="activities">Activities</button>
    </div>

    <div class="row g-3">
      <?php if (!empty($galleryImages)): ?>
        <?php foreach ($galleryImages as $path): ?>
          <?php
            $category = $categorizeImage($path);
            $alt = $buildAlt($path);
          ?>
          <div class="col-6 col-md-4 col-lg-3 gallery-item <?php echo $category; ?>">
            <div class="gallery-card">
              <img src="<?php echo $path; ?>" class="gallery-img" alt="<?php echo htmlspecialchars($alt); ?>" loading="lazy">
              <div class="gallery-caption"><?php echo htmlspecialchars($alt); ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="alert alert-warning text-center mb-0">No gallery photos found yet. Add images to assets/images to populate this gallery.</div>
        </div>
      <?php endif; ?>
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
          <iframe src="https://www.youtube.com/embed/Rdl2wjrnSos" title="School Video" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include("includes/footer.php"); ?>
