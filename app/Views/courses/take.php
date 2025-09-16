<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Ambil Mata Kuliah</h2>
<form method="post" action="<?= site_url('take-course') ?>">
    <label>Pilih Mata Kuliah</label>
    <select name="course_id" class="form-select">
        <?php foreach($courses as $c): ?>
            <option value="<?= $c['course_id'] ?>"><?= $c['course_name'] ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-primary mt-3">Ambil</button>
</form>

<?= $this->endSection() ?>
