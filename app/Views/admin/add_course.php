<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Mata Kuliah</h1>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <form method="post" action="/manage-courses/add">
            <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="course_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Credits</label>
                <input type="number" name="credits" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/manage-courses" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>