<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Daftar Mata Kuliah</h2>
<table class="table">
    <tr><th>ID</th><th>Nama</th><th>SKS</th></tr>
    <?php foreach($courses as $c): ?>
    <tr>
        <td><?= $c['course_id'] ?></td>
        <td><?= $c['course_name'] ?></td>
        <td><?= $c['credits'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="/dashboard" class="btn btn-secondary">Kembali</a>

<?= $this->endSection() ?>
