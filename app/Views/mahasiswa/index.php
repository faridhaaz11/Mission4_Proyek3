<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1><?= $title ?></h1>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <a href="/mahasiswa/create" class="btn btn-primary mb-3">Tambah Mahasiswa</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Umur</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mahasiswa as $m): ?>
                    <tr>
                        <td><?= $m['nim'] ?></td>
                        <td><?= $m['nama_lengkap'] ?></td>
                        <td><?= $m['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                        <td><?= $m['tanggal_lahir'] ?></td>
                        <td><?= $m['umur'] ?></td>
                        <td>
                            <a href="/mahasiswa/view/<?= $m['nim'] ?>" class="btn btn-info btn-sm">View</a>
                            <a href="/mahasiswa/edit/<?= $m['nim'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/mahasiswa/delete/<?= $m['nim'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <a href="/dashboard" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>