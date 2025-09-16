<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h2>Mata Kuliah yang Diambil</h2>
<table class="table table-striped">
    <tr>
        <th>Kode</th>
        <th>Nama</th>
        <th>SKS</th>
        <th>Tanggal Ambil</th>
    </tr>
    <?php foreach($mycourses as $c): ?>
    <tr>
        <td><?= esc($c->course_id) ?></td>
        <td><?= esc($c->course_name) ?></td>
        <td><?= esc($c->credits) ?></td>
        <td><?= esc($c->enroll_date) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection() ?>
