<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lihat Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Mata Kuliah yang Diambil</h1>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <a href="/dashboard" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Credits</th>
                    <th>Tanggal Ambil</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($enrolledCourses)): ?>
                    <tr><td colspan="4" class="text-center">Belum ada mata kuliah yang diambil.</td></tr>
                <?php else: ?>
                    <?php foreach ($enrolledCourses as $course): ?>
                        <tr>
                            <td><?= esc($course['id']) ?></td>
                            <td><?= esc($course['course_name']) ?></td>
                            <td><?= esc($course['credits']) ?></td>
                            <td><?= esc($course['enroll_date']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="/mahasiswa/enroll" class="btn btn-primary">Ambil Mata Kuliah Baru</a>
    </div>
</body>
</html>