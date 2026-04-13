<?php include("includes/header.php"); ?>

<?php
$calendarEvents = [
  '2026-08-25' => ['title' => 'Registration Begins', 'term' => 'term-one'],
  '2026-09-08' => ['title' => 'Classes Begin', 'term' => 'term-one'],
  '2026-10-19' => ['title' => 'Midterm Tests Begin', 'term' => 'term-one'],
  '2026-11-06' => ['title' => 'Open House', 'term' => 'term-one'],
  '2026-12-07' => ['title' => 'Final Exams Begin', 'term' => 'term-one'],
  '2026-12-18' => ['title' => 'First Term Results', 'term' => 'term-one'],
  '2027-01-11' => ['title' => 'Second Term Resumption', 'term' => 'term-two'],
  '2027-02-08' => ['title' => 'Continuous Assessment Begins', 'term' => 'term-two'],
  '2027-02-26' => ['title' => 'Midterm Break', 'term' => 'term-two'],
  '2027-03-15' => ['title' => 'Project Week Begins', 'term' => 'term-two'],
  '2027-03-29' => ['title' => 'Final Exams Begin', 'term' => 'term-two'],
  '2027-04-09' => ['title' => 'Second Term Results', 'term' => 'term-two'],
  '2027-04-19' => ['title' => 'Third Term Resumption', 'term' => 'term-three'],
  '2027-05-24' => ['title' => 'Revision Week Begins', 'term' => 'term-three'],
  '2027-06-07' => ['title' => 'Promotion Exams Begin', 'term' => 'term-three'],
  '2027-06-25' => ['title' => 'Graduation Ceremony', 'term' => 'term-three'],
  '2027-06-30' => ['title' => 'Session Closes', 'term' => 'term-three'],
  '2027-07-12' => ['title' => 'Summer Program Begins', 'term' => 'term-three'],
];

$calendarMonths = [];
$monthCursor = new DateTime('2026-08-01');
$monthEnd = new DateTime('2027-07-01');

while ($monthCursor <= $monthEnd) {
  $calendarMonths[] = clone $monthCursor;
  $monthCursor->modify('+1 month');
}

$monthEvents = [];
foreach ($calendarEvents as $date => $eventData) {
  $monthKey = substr($date, 0, 7);
  if (!isset($monthEvents[$monthKey])) {
    $monthEvents[$monthKey] = [];
  }

  $monthEvents[$monthKey][] = [
    'label' => date('M j, Y', strtotime($date)),
    'title' => $eventData['title'],
  ];
}
?>

<section class="page-banner page-banner-image d-flex align-items-center text-center text-light" style="background-image: linear-gradient(rgba(44, 0, 62, 0.6), rgba(75, 0, 130, 0.6)), url('assets/images/slider2.jpeg');">
  <div class="container">
    <h1 class="display-5 fw-bold">Academic Programs</h1>
    <p class="lead">Strong foundations for lifelong learning.</p>
  </div>
</section>

<section class="py-5" data-animate>
  <div class="container text-center">
    <h2 class="section-title">Our Academic Structure</h2>
    <p class="lead">A child-centered curriculum designed for growth, confidence, and excellence.</p>
  </div>
</section>

<section class="py-5 bg-light" data-animate>
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="academic-card text-center">
          <div class="program-icon">🧸</div>
          <h5>Early Childhood</h5>
          <p class="mb-0">Daycare, Pre-Nursery, and Kindergarten with focus on social and literacy readiness.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="academic-card text-center">
          <div class="program-icon">📘</div>
          <h5>Lower Elementary</h5>
          <p class="mb-0">Grades 1-3 focused on reading, writing, phonics, and mathematics foundations.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="academic-card text-center">
          <div class="program-icon">📗</div>
          <h5>Upper Elementary</h5>
          <p class="mb-0">Grades 4-6 with critical thinking, research, and higher-level preparation.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5" data-animate>
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="section-title">Academic Calendar</h2>
      <p class="lead mb-0">2026-2027 session schedule with dates for all major academic activities.</p>
    </div>

    <div class="school-calendar-wrap">
      <div class="row g-4 align-items-start">
        <div class="col-lg-8">
          <div id="academicCalendarCarousel" class="carousel slide calendar-carousel" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover">
            <div class="carousel-inner">
              <?php foreach ($calendarMonths as $index => $monthDate): ?>
                <?php
                  $monthLabel = $monthDate->format('F Y');
                  $monthKey = $monthDate->format('Y-m');
                  $monthFirstDay = (int)$monthDate->format('N');
                  $daysInMonth = (int)$monthDate->format('t');
                  $currentMonthEvents = $monthEvents[$monthKey] ?? [];
                ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                  <div class="calendar-month-card">
                    <div class="calendar-month-head d-flex justify-content-between align-items-center">
                      <h5 class="mb-0"><?php echo $monthLabel; ?></h5>
                      <small>Slide <?php echo $index + 1; ?> of <?php echo count($calendarMonths); ?></small>
                    </div>
                    <table class="calendar-table" aria-label="<?php echo $monthLabel; ?> academic calendar">
                      <thead>
                        <tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr>
                      </thead>
                      <tbody>
                        <?php
                          $day = 1;
                          for ($week = 0; $week < 6; $week++):
                            if ($day > $daysInMonth) {
                              break;
                            }
                        ?>
                        <tr>
                          <?php for ($weekday = 1; $weekday <= 7; $weekday++): ?>
                            <?php if (($week === 0 && $weekday < $monthFirstDay) || $day > $daysInMonth): ?>
                              <td></td>
                            <?php else: ?>
                              <?php
                                $dateKey = $monthDate->format('Y-m-') . str_pad((string)$day, 2, '0', STR_PAD_LEFT);
                                $event = $calendarEvents[$dateKey] ?? null;
                                $dayClass = $event ? 'event-day ' . $event['term'] : '';
                                $title = $event ? $event['title'] . ' - ' . $monthDate->format('M ') . $day . ', ' . $monthDate->format('Y') : '';
                              ?>
                              <td class="<?php echo $dayClass; ?>" title="<?php echo htmlspecialchars($title); ?>"><?php echo $day; ?></td>
                              <?php $day++; ?>
                            <?php endif; ?>
                          <?php endfor; ?>
                        </tr>
                        <?php endfor; ?>
                      </tbody>
                    </table>

                    <div class="d-none month-side-events">
                      <h6 class="month-events-title mb-2">Key Dates In <?php echo $monthLabel; ?></h6>
                      <ul class="list-unstyled month-events-list mb-0">
                        <?php if (!empty($currentMonthEvents)): ?>
                          <?php foreach ($currentMonthEvents as $monthEvent): ?>
                            <li><strong><?php echo $monthEvent['label']; ?>:</strong> <?php echo $monthEvent['title']; ?></li>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <li>No key academic dates in this month.</li>
                        <?php endif; ?>
                      </ul>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#academicCalendarCarousel" data-bs-slide="prev" aria-label="Previous month">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#academicCalendarCarousel" data-bs-slide="next" aria-label="Next month">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="info-card calendar-side-info">
            <h5 class="mb-3">Key Dates And Information</h5>
            <p class="small mb-3">Marked dates on the calendar are highlighted by term color.</p>

            <ul class="list-unstyled calendar-legend mb-4">
              <li><span class="legend-dot term-one"></span> First Term</li>
              <li><span class="legend-dot term-two"></span> Second Term</li>
              <li><span class="legend-dot term-three"></span> Third Term</li>
            </ul>

            <h6 id="activeMonthInfoTitle" class="mb-2">Key Dates In This Month</h6>
            <ul id="activeMonthInfoList" class="list-unstyled calendar-events mb-0"></ul>
          </div>
        </div>
      </div>

      <div class="text-center mt-4">
        <button type="button" class="btn btn-school btn-lg" onclick="window.print()">
          <i class="bi bi-file-earmark-pdf-fill me-2"></i>Download Calendar PDF
        </button>
        <p class="small text-muted mt-2 mb-0">Click the button and choose Save as PDF in the print dialog.</p>
      </div>

      <div class="info-card text-center mt-4">
        <p class="mb-0"><strong>Note:</strong> Dates may be adjusted by school management when necessary. Please confirm updates through the school office or the contact page.</p>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const carousel = document.getElementById('academicCalendarCarousel');
  const titleEl = document.getElementById('activeMonthInfoTitle');
  const listEl = document.getElementById('activeMonthInfoList');

  if (!carousel || !titleEl || !listEl) {
    return;
  }

  function syncMonthInfo() {
    const activeSlide = carousel.querySelector('.carousel-item.active');
    if (!activeSlide) {
      return;
    }

    const sourceTitle = activeSlide.querySelector('.month-events-title');
    const sourceList = activeSlide.querySelector('.month-events-list');

    titleEl.textContent = sourceTitle ? sourceTitle.textContent : 'Key Dates In This Month';
    listEl.innerHTML = sourceList ? sourceList.innerHTML : '<li>No key academic dates in this month.</li>';
  }

  syncMonthInfo();
  carousel.addEventListener('slid.bs.carousel', syncMonthInfo);
});
</script>

<section class="py-5" data-animate>
  <div class="container">
    <h2 class="section-title text-center mb-4">Curriculum Highlights</h2>
    <div class="row g-3">
      <div class="col-md-6"><div class="info-card"><h6>Core Subjects</h6><p class="mb-0">Mathematics, English Language, General Science, and Social Studies.</p></div></div>
      <div class="col-md-6"><div class="info-card"><h6>Values and Life Skills</h6><p class="mb-0">Civic education, moral instruction, communication, and teamwork.</p></div></div>
      <div class="col-md-6"><div class="info-card"><h6>Creative Learning</h6><p class="mb-0">Music, arts, and activity-based instruction for holistic development.</p></div></div>
      <div class="col-md-6"><div class="info-card"><h6>Physical Development</h6><p class="mb-0">Sports and structured play for health and discipline.</p></div></div>
    </div>
  </div>
</section>

<section class="container py-5 cta-block text-center" data-animate>
  <h2 class="text-white">Ready To Join Our Programs?</h2>
  <p class="mb-4">Take the next step and begin your child's admission journey today.</p>
  <a href="admission.php" class="btn btn-school btn-lg">Apply For Admission</a>
</section>

<?php include("includes/footer.php"); ?>
