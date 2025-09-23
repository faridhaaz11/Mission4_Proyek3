<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ambil Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1 class="fw-bold">Ambil Mata Kuliah</h1>
                <a href="/dashboard" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form id="enrollForm" method="post" action="/mahasiswa/enroll/store" novalidate>
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Pilih</th>
                                <th>ID</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Credits</th>
                            </tr>
                        </thead>
                        <tbody id="course-list-body">
                            <!-- Data akan diisi oleh JS -->
                        </tbody>
                    </table>

                    <div class="mt-3 text-end">
                        <h5>
                            <strong>Total SKS Terpilih:</strong> 
                            <span id="totalSKS" class="badge bg-primary">0</span>
                        </h5>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/student/my-courses" class="btn btn-info">
                            Lihat Mata Kuliah yang Diambil
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Ambil Mata Kuliah yang Dipilih
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Validasi -->
    <div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="validationModalLabel">Peringatan Validasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p id="validationMessage"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <script>
        const coursesData = <?= json_encode($allCourses) ?>;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>
</html>
