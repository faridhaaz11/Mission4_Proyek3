<!DOCTYPE html>
<html>
<head>
    <title>Kelola Mata Kuliah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="card-title mb-0">Kelola Mata Kuliah</h1>
            </div>
            <div class="card-body">
                <a href="/admin/add-course" class="btn btn-primary mb-3">Tambah Mata Kuliah</a>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Credits</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><?= $course['course_id'] ?></td>
                            <td><?= $course['course_name'] ?></td>
                            <td><?= $course['credits'] ?></td>
                            <td>
                                <a href="/admin/edit-course/<?= $course['course_id'] ?>" class="btn btn-warning btn-sm me-2">Edit</a>
                                <a href="/admin/delete-course/<?= $course['course_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="/dashboard" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>