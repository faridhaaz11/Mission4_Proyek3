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
        <table class="table">
            <tr><th>NIM</th><td><?= $mahasiswa['nim'] ?></td></tr>
            <tr><th>Nama Lengkap</th><td><?= $mahasiswa['nama_lengkap'] ?></td></tr>
            <tr><th>Jenis Kelamin</th><td><?= $mahasiswa['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></td></tr>
            <tr><th>Tanggal Lahir</th><td><?= $mahasiswa['tanggal_lahir'] ?></td></tr>
            <tr><th>Umur</th><td><?= $mahasiswa['umur'] ?></td></tr>
        </table>
        <a href="/mahasiswa" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>