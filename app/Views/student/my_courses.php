<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah Saya - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">Sistem Akademik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/enroll"><i class="fas fa-book"></i> Ambil Mata Kuliah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/student/my-courses"><i class="fas fa-list"></i> Mata Kuliah Saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mt-4">
        <h2 class="text-center mb-4 text-primary">Mata Kuliah Saya</h2>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success text-center"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger text-center"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php if (empty($enrolledCourses)): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <p class="card-text">Kamu belum mengambil mata kuliah apa pun.</p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($enrolledCourses as $course): ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($course['course_name']) ?></h5>
                                <p class="card-text"><strong>Credits:</strong> <?= esc($course['credits']) ?></p>
                                <p class="card-text"><small class="text-muted">Tanggal Ambil: <?= esc($course['enroll_date']) ?></small></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; 2025 Sistem Akademik. Semua hak dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>