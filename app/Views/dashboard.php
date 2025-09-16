<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body style="font-family: 'Roboto', sans-serif;">
    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="fas fa-university"></i> Sistem Akademik</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav ms-auto">
                        <?php if (session()->get('isLoggedIn')): ?>
                            <span class="nav-link text-white">Selamat datang, <?= esc($user_name) ?></span>
                            <?php if ($role === 'admin'): ?>
                                <a class="nav-link" href="/mahasiswa"><i class="fas fa-users"></i> Kelola Mahasiswa</a>
                                <a class="nav-link" href="/manage-courses"><i class="fas fa-book"></i> Kelola Mata Kuliah</a>
                            <?php elseif ($role === 'mahasiswa'): ?>
                                <a class="nav-link" href="/student/my-courses"><i class="fas fa-list"></i> Mata Kuliah Saya</a>
                                <a class="nav-link" href="/view-courses"><i class="fas fa-eye"></i> Lihat Mata Kuliah</a>
                                <a class="nav-link" href="/enroll-course"><i class="fas fa-plus"></i> Ambil Mata Kuliah</a>
                            <?php endif; ?>
                            <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        <?php else: ?>
                            <a class="nav-link" href="/login"><i class="fas fa-sign-in-alt"></i> Login</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-primary">Dashboard</h5>
                <p class="card-text">Selamat datang di dashboard. Menu di atas disesuaikan dengan role Anda: <?= esc($role) ?>.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>