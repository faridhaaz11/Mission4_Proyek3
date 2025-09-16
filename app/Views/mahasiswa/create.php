<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1><?= $title ?></h1>
        <?php if (session()->getFlashdata('validation')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('validation')->listErrors() ?>
            </div>
        <?php endif; ?>


    <form action="<?= site_url('mahasiswa/store') ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" id="nim" required>
            </div>
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required>
            </div>
            <div class="mb-3">
                <label for="umur" class="form-label">Umur</label>
                <input type="number" name="umur" class="form-control" id="umur" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/mahasiswa" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
