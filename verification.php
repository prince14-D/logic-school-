<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<?php include("includes/header.php"); ?>

<?php
$excelCsvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTk4Z1xLEu9PFb4JAvnYNckLcRFCrbbcHbU5bgjPbm56dMJzoS1EJQdNGCu5TeZ_JoGkdo_yO6zwfsU/pub?gid=0&single=true&output=csv';
$dataSource = 'data/student_verification.csv';
$defaultSchoolName = 'Logic - A Demonstration School';
$uidQuery = '';
$captchaAnswer = '';
$student = null;
$error = '';

function normalize_header_key($value)
{
    return strtolower(preg_replace('/[^a-z0-9]+/', '_', trim((string)$value)));
}

function find_header_index($headerMap, $candidates)
{
    foreach ($candidates as $candidate) {
        if (isset($headerMap[$candidate])) {
            return $headerMap[$candidate];
        }
    }

    return null;
}

function find_header_index_fuzzy($headerMap, $patterns)
{
  foreach ($headerMap as $headerName => $index) {
    $normalized = strtolower(str_replace('_', '', (string)$headerName));
    foreach ($patterns as $pattern) {
      $needle = strtolower(str_replace('_', '', (string)$pattern));
      if ($needle !== '' && strpos($normalized, $needle) !== false) {
        return $index;
      }
    }
  }

  return null;
}

  function is_http_url($value)
  {
    if (!is_string($value) || trim($value) === '') {
      return false;
    }

    if (!filter_var($value, FILTER_VALIDATE_URL)) {
      return false;
    }

    return preg_match('/^https?:\/\//i', $value) === 1;
  }

  function generate_verification_captcha()
  {
    $a = random_int(2, 20);
    $b = random_int(2, 20);

    $_SESSION['verify_captcha_a'] = $a;
    $_SESSION['verify_captcha_b'] = $b;
    $_SESSION['verify_captcha_answer'] = $a + $b;
  }

  function read_csv_rows_from_remote($url)
  {
    if (!$url) {
      return [];
    }

    $context = stream_context_create([
      'http' => [
        'method' => 'GET',
        'timeout' => 10,
        'header' => "User-Agent: LogicSchoolVerification/1.0\r\n",
      ],
      'https' => [
        'method' => 'GET',
        'timeout' => 10,
        'header' => "User-Agent: LogicSchoolVerification/1.0\r\n",
      ],
    ]);

    $csvContent = @file_get_contents($url, false, $context);
    if ($csvContent === false) {
      return [];
    }

    $lines = preg_split('/\r\n|\r|\n/', $csvContent);
    $rows = [];

    foreach ($lines as $line) {
      if (trim((string)$line) === '') {
        continue;
      }

      $rows[] = str_getcsv($line);
    }

    return $rows;
  }

  function read_csv_rows_from_local($path)
  {
    if (!is_readable($path)) {
      return [];
    }

    $handle = fopen($path, 'r');
    if ($handle === false) {
      return [];
    }

    $rows = [];
    while (($row = fgetcsv($handle)) !== false) {
      $rows[] = $row;
    }

    fclose($handle);
    return $rows;
  }

if (!isset($_SESSION['verify_captcha_answer'])) {
  generate_verification_captcha();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uidQuery = strtoupper(trim($_POST['uid'] ?? ''));
  $captchaAnswer = trim($_POST['captcha_answer'] ?? '');

  $expectedCaptcha = (int)($_SESSION['verify_captcha_answer'] ?? -1);
  $providedCaptcha = filter_var($captchaAnswer, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);

    if ($uidQuery === '') {
        $error = 'Please enter your student UID.';
  } elseif ($providedCaptcha === null || (int)$providedCaptcha !== $expectedCaptcha) {
    $error = 'Security check failed. Please solve the calculation correctly.';
    } elseif (!preg_match('/^[A-Z0-9-]{4,30}$/', $uidQuery)) {
        $error = 'Invalid UID format. Use letters, numbers, and dashes only.';
    } else {
      $rows = read_csv_rows_from_remote($excelCsvUrl);
      if (count($rows) < 2) {
        $rows = read_csv_rows_from_local($dataSource);
      }

      if (count($rows) < 2) {
        $error = 'Verification records are currently unavailable. Please contact the school office.';
        } else {
        $headerRow = $rows[0];
        if (isset($headerRow[0])) {
          $headerRow[0] = preg_replace('/^\xEF\xBB\xBF/', '', (string)$headerRow[0]);
        }

        $headerMap = [];
        foreach ($headerRow as $index => $columnName) {
          $headerMap[normalize_header_key($columnName)] = $index;
        }

        $uidIndex = find_header_index($headerMap, ['uid', 'student_uid', 'studentuid', 'id', 'certificatenumber', 'certificate_number', 'certificate_no', 'certificateno']);
        $nameIndex = find_header_index($headerMap, ['full_name', 'fullname', 'student_name', 'studentname', 'name']);
        $classIndex = find_header_index($headerMap, ['class', 'grade', 'course', 'program']);
        $statusIndex = find_header_index($headerMap, ['status', 'enrollment_status', 'enrollmentstatus']);
        $sessionIndex = find_header_index($headerMap, ['session', 'academic_session', 'academicsession', 'school_year', 'schoolyear', 'issuedate', 'issue_date']);
        $parentNameIndex = find_header_index($headerMap, ['parent_name', 'parentname', 'guardian_name', 'guardianname']);
        $parentPhoneIndex = find_header_index($headerMap, ['parent_phone', 'parentphone', 'guardian_phone', 'guardianphone', 'phone']);
        $behaviorIndex = find_header_index($headerMap, ['behavior', 'conduct', 'discipline']);
        $ageIndex = find_header_index($headerMap, ['age', 'student_age', 'studentage']);
        $photoIdIndex = find_header_index($headerMap, ['photo_id', 'photoid', 'student_photo_id', 'studentphotoid', 'photo']);
        $transcriptIndex = find_header_index($headerMap, ['transcript', 'transcript_id', 'transcriptid', 'transcript_reference', 'record_reference']);
        $schoolNameIndex = find_header_index($headerMap, ['school_name', 'schoolname', 'institution', 'institution_name']);

        if ($uidIndex === null) {
          $uidIndex = find_header_index_fuzzy($headerMap, ['uid', 'certificate', 'studentid']);
        }

        if ($uidIndex === null && isset($rows[1][0])) {
          $uidIndex = 0;
        }

        if ($uidIndex === null) {
          $error = 'CSV format error: missing UID column.';
        } else {
          for ($rowIndex = 1; $rowIndex < count($rows); $rowIndex++) {
            $row = $rows[$rowIndex];
            $rowUid = strtoupper(trim($row[$uidIndex] ?? ''));

            if ($rowUid !== $uidQuery) {
              continue;
            }

            $student = [
              'uid' => $rowUid,
              'school_name' => $schoolNameIndex !== null
                ? trim($row[$schoolNameIndex] ?? $defaultSchoolName)
                : $defaultSchoolName,
              'full_name' => trim($row[$nameIndex] ?? ''),
              'class' => trim($row[$classIndex] ?? ''),
              'status' => trim($row[$statusIndex] ?? ''),
              'session' => trim($row[$sessionIndex] ?? ''),
              'parent_name' => trim($row[$parentNameIndex] ?? ''),
              'parent_phone' => trim($row[$parentPhoneIndex] ?? ''),
              'behavior' => trim($row[$behaviorIndex] ?? ''),
              'age' => trim($row[$ageIndex] ?? ''),
              'photo_id' => trim($row[$photoIdIndex] ?? ''),
              'transcript' => trim($row[$transcriptIndex] ?? ''),
            ];
            break;
          }

          if ($student === null && $error === '') {
            $error = 'No record found for that UID. Please confirm and try again.';
                }
            }
        }
    }

        generate_verification_captcha();
}
?>

<style>
  .security-check-card {
    border: 1px solid rgba(30, 79, 163, 0.15);
    border-radius: 12px;
    background: #f8fbff;
    padding: 1rem;
  }

  .captcha-equation {
    font-size: 1.1rem;
    letter-spacing: 0.02em;
  }

  .captcha-input {
    max-width: 220px;
    margin: 0 auto;
  }

  .verify-actions {
    text-align: center;
  }

  .verify-actions .btn {
    min-width: 230px;
  }

  .photo-id-preview {
    width: 84px;
    height: 84px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #d6deea;
    background: #f6f8fc;
  }
</style>

<section class="page-banner page-banner-image d-flex align-items-center text-center text-light" style="background-image: linear-gradient(rgba(44, 0, 62, 0.6), rgba(75, 0, 130, 0.6)), url('assets/images/slider3.jpeg');">
  <div class="container">
    <h1 class="display-5 fw-bold">Student Verification</h1>
    <p class="lead">Verify student details securely using your unique UID.</p>
  </div>
</section>

<section class="py-5" data-animate>
  <div class="container">
    <div class="row g-4 align-items-start">
      <div class="col-lg-5">
        <div class="contact-card h-100">
          <h3 class="section-title">Verify Student Record</h3>
          <p class="text-muted">Enter the assigned UID or certificate number exactly as provided by the school.</p>

          <form method="POST" class="mt-3">
            <label for="uid" class="form-label">Student UID or Certificate Number</label>
            <input id="uid" type="text" name="uid" class="form-control" placeholder="e.g. TEC-2026-001" value="<?php echo htmlspecialchars($uidQuery); ?>" required>

            <div class="security-check-card mt-3 text-center">
              <h6 class="mb-2">Security Check</h6>
              <p class="mb-2 fw-semibold captcha-equation">
                Calculate
                <?php echo (int)($_SESSION['verify_captcha_a'] ?? 0); ?>
                +
                <?php echo (int)($_SESSION['verify_captcha_b'] ?? 0); ?>
              </p>
              <input
                id="captcha_answer"
                type="number"
                name="captcha_answer"
                class="form-control text-center captcha-input"
                placeholder="Enter answer"
                value="<?php echo htmlspecialchars($captchaAnswer); ?>"
                required
              >
            </div>

            <button type="submit" class="btn btn-school mt-3 w-100">Verify Information</button>
          </form>

          <div class="verify-note mt-4 text-center">
            <h6 class="mb-2">Excel Connection Setup</h6>
            <p class="mb-0 small">This page reads your published Excel/Google Sheet CSV first, and falls back to <strong>data/student_verification.csv</strong> when needed. Add columns like: certificateNumber, studentName, class/course, issueDate, status, parentName, parentPhone, behavior, age, photoId, transcript.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="contact-card h-100">
          <h3 class="section-title">Verification Result</h3>

          <?php if ($error): ?>
            <div class="alert alert-warning"><?php echo htmlspecialchars($error); ?></div>
          <?php endif; ?>

          <?php if ($student): ?>
            <div class="table-responsive">
              <table class="table table-bordered align-middle verify-table mb-0">
                <tbody>
                  <tr>
                    <th scope="row">Student UID</th>
                    <td><?php echo htmlspecialchars($student['uid']); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">School Name</th>
                    <td><?php echo htmlspecialchars(($student['school_name'] ?? '') !== '' ? $student['school_name'] : $defaultSchoolName); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Full Name</th>
                    <td><?php echo htmlspecialchars($student['full_name'] ?: 'N/A'); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Class</th>
                    <td><?php echo htmlspecialchars($student['class'] ?: 'N/A'); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Enrollment Status</th>
                    <td><span class="verify-badge"><?php echo htmlspecialchars($student['status'] ?: 'N/A'); ?></span></td>
                  </tr>
                  <tr>
                    <th scope="row">Academic Session</th>
                    <td><?php echo htmlspecialchars($student['session'] ?: 'N/A'); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Parent/Guardian</th>
                    <td><?php echo htmlspecialchars($student['parent_name'] ?: 'N/A'); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Parent Phone</th>
                    <td><?php echo htmlspecialchars($student['parent_phone'] ?: 'N/A'); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Behavior</th>
                    <td><?php echo htmlspecialchars($student['behavior'] ?: 'N/A'); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Age</th>
                    <td><?php echo htmlspecialchars($student['age'] ?: 'N/A'); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Photo ID</th>
                    <td>
                      <?php if (is_http_url($student['photo_id'] ?? '')): ?>
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                          <img
                            src="<?php echo htmlspecialchars($student['photo_id']); ?>"
                            alt="Student Photo ID"
                            class="photo-id-preview"
                            loading="lazy"
                            referrerpolicy="no-referrer"
                          >
                          <a href="<?php echo htmlspecialchars($student['photo_id']); ?>" target="_blank" rel="noopener noreferrer">View Photo ID</a>
                        </div>
                      <?php else: ?>
                        <?php echo htmlspecialchars($student['photo_id'] ?: 'N/A'); ?>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">Transcript</th>
                    <td><?php echo htmlspecialchars($student['transcript'] ?: 'N/A'); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="verify-actions mt-3">
              <button id="downloadVerificationPdf" class="btn btn-school">
                <i class="bi bi-download me-1"></i>Download Verification PDF
              </button>
            </div>
          <?php elseif ($_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
            <p class="text-muted mb-0">Submit a UID to view student verification information.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if ($student): ?>
  <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
  <script>
    (function () {
      const button = document.getElementById('downloadVerificationPdf');
      if (!button) {
        return;
      }

      const studentData = <?php echo json_encode($student, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

      button.addEventListener('click', async function () {
        if (!window.jspdf || !window.jspdf.jsPDF) {
          alert('PDF engine failed to load. Please refresh and try again.');
          return;
        }

        const doc = new window.jspdf.jsPDF({ unit: 'mm', format: 'a4' });
        const pageWidth = doc.internal.pageSize.getWidth();
        const generatedAt = new Date().toLocaleString();
        const photoIdValue = String(studentData.photo_id || '').trim();

        const schoolBlueDark = [12, 46, 87];
        const schoolBlue = [30, 79, 163];
        const schoolGold = [212, 175, 55];

        doc.setFillColor(schoolBlueDark[0], schoolBlueDark[1], schoolBlueDark[2]);
        doc.rect(0, 0, pageWidth, 26, 'F');
        doc.setFillColor(schoolBlue[0], schoolBlue[1], schoolBlue[2]);
        doc.rect(0, 26, pageWidth, 8, 'F');
        doc.setFillColor(schoolGold[0], schoolGold[1], schoolGold[2]);
        doc.rect(0, 34, pageWidth, 2.5, 'F');

        try {
          const logo = await loadImageAsDataUrl('assets/images/logo.png');
          doc.addImage(logo, 'PNG', 12, 6, 18, 18);
        } catch (e) {
          // If logo fails to load, continue PDF generation.
        }

        doc.setTextColor(255, 255, 255);
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(15);
        doc.text('Logic - A Demonstration School', 34, 14);
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(9.5);
        doc.text('Block C, Pagos Island, Congo Town, Liberia', 34, 20);
        doc.text('Phone: (+231) 777-297-443  |  Email: info@logicatschool.com', 34, 31);

        doc.setTextColor(10, 26, 43);
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(14);
        doc.text('OFFICIAL STUDENT VERIFICATION TRANSCRIPT', 14, 46);

        doc.setDrawColor(schoolGold[0], schoolGold[1], schoolGold[2]);
        doc.setLineWidth(0.8);
        doc.line(14, 49, pageWidth - 14, 49);

        const photoBoxX = pageWidth - 58;
        const photoBoxY = 56;
        const photoBoxW = 42;
        const photoBoxH = 52;

        doc.setDrawColor(140, 150, 165);
        doc.setLineWidth(0.5);
        doc.rect(photoBoxX, photoBoxY, photoBoxW, photoBoxH);
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(8);
        doc.setTextColor(60, 70, 82);
        doc.text('PHOTO ID', photoBoxX + (photoBoxW / 2), photoBoxY + 5, { align: 'center' });

        const rows = [
          ['Generated At', generatedAt],
          ['School Name', studentData.school_name || <?php echo json_encode($defaultSchoolName); ?>],
          ['Student UID', studentData.uid || 'N/A'],
          ['Full Name', studentData.full_name || 'N/A'],
          ['Class', studentData.class || 'N/A'],
          ['Enrollment Status', studentData.status || 'N/A'],
          ['Academic Session', studentData.session || 'N/A'],
          ['Parent/Guardian', studentData.parent_name || 'N/A'],
          ['Parent Phone', studentData.parent_phone || 'N/A'],
          ['Behavior', studentData.behavior || 'N/A'],
          ['Age', studentData.age || 'N/A'],
          ['Photo ID', studentData.photo_id || 'N/A'],
          ['Transcript', studentData.transcript || 'N/A']
        ];

        let y = 58;
        rows.forEach(function (row) {
          doc.setFont('helvetica', 'bold');
          doc.setFontSize(10.5);
          doc.text(row[0] + ':', 16, y);

          doc.setFont('helvetica', 'normal');
          const valueLines = doc.splitTextToSize(String(row[1]), 86);
          doc.text(valueLines, 62, y);

          y += Math.max(9, valueLines.length * 5 + 3);
        });

        if (isLikelyHttpUrl(photoIdValue)) {
          try {
            const photoDataUrl = await loadImageAsDataUrl(photoIdValue);
            const format = photoDataUrl.indexOf('data:image/jpeg') === 0 ? 'JPEG' : 'PNG';
            doc.addImage(photoDataUrl, format, photoBoxX + 2, photoBoxY + 8, photoBoxW - 4, photoBoxH - 12);
          } catch (e) {
            // Keep PDF generation resilient if external image loading is blocked.
            doc.setFont('helvetica', 'italic');
            doc.setFontSize(8);
            doc.setTextColor(110, 110, 110);
            doc.text('Photo unavailable', photoBoxX + (photoBoxW / 2), photoBoxY + (photoBoxH / 2), { align: 'center' });
          }
        } else {
          doc.setFont('helvetica', 'italic');
          doc.setFontSize(8);
          doc.setTextColor(110, 110, 110);
          doc.text('No valid image URL', photoBoxX + (photoBoxW / 2), photoBoxY + (photoBoxH / 2), { align: 'center' });
        }

        doc.setFont('helvetica', 'italic');
        doc.setFontSize(9);
        doc.setTextColor(40, 40, 40);
        const note = 'This report confirms that the student record was successfully verified against the school verification data.';
        const noteY = Math.max(y + 8, 128);
        doc.text(doc.splitTextToSize(note, pageWidth - 28), 14, noteY);

        const signatureY = Math.min(noteY + 26, 265);
        doc.setDrawColor(90, 90, 90);
        doc.setLineWidth(0.4);
        doc.line(20, signatureY, 85, signatureY);
        doc.line(120, signatureY, 185, signatureY);
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(10);
        doc.text('Registrar Signature', 52.5, signatureY + 5, { align: 'center' });
        doc.text('Principal Signature', 152.5, signatureY + 5, { align: 'center' });

        doc.setFont('helvetica', 'normal');
        doc.setFontSize(9);
        doc.text('Generated by Logic School Verification System', 14, 285);

        doc.save((studentData.uid || 'student') + '-verification-report.pdf');
      });

      function loadImageAsDataUrl(src) {
        return new Promise(function (resolve, reject) {
          const img = new Image();
          img.crossOrigin = 'anonymous';
          img.onload = function () {
            const canvas = document.createElement('canvas');
            canvas.width = img.naturalWidth;
            canvas.height = img.naturalHeight;
            const ctx = canvas.getContext('2d');

            if (!ctx) {
              reject(new Error('Canvas context unavailable'));
              return;
            }

            ctx.drawImage(img, 0, 0);
            resolve(canvas.toDataURL('image/png'));
          };
          img.onerror = function () {
            reject(new Error('Unable to load image'));
          };
          img.src = src;
        });
      }

      function isLikelyHttpUrl(value) {
        return /^https?:\/\//i.test(value);
      }
    })();
  </script>
<?php endif; ?>

<?php include("includes/footer.php"); ?>
