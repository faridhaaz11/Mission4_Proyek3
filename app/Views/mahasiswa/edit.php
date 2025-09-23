<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="fw-bold"><?= $title ?></h1>
        <?php if (session()->getFlashdata('validation')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('validation')->listErrors() ?>
            </div>
        <?php endif; ?>
        <form method="post" action="/mahasiswa/update/<?= $mahasiswa['nim'] ?>">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" id="nim" value="<?= $mahasiswa['nim'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" value="<?= $mahasiswa['nama_lengkap'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                    <option value="L" <?= $mahasiswa['jenis_kelamin'] === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="P" <?= $mahasiswa['jenis_kelamin'] === 'P' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="<?= $mahasiswa['tanggal_lahir'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="umur" class="form-label">Umur</label>
                <input type="number" name="umur" class="form-control" id="umur" value="<?= $mahasiswa['umur'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/mahasiswa" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>