<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Ambil Mata Kuliah</h2>
                    <form method="post" action="<?= site_url('enroll-course') ?>" class="needs-validation" novalidate>
                        <a href="<?= site_url('courses/enroll/'.$course->course_id) ?>" class="btn btn-primary mb-3 d-block text-center">
                           Ambil
                        </a>
                        <div class="mb-3">
                            <label for="course_id" class="form-label">Pilih Mata Kuliah</label>
                            <select name="course_id" id="course_id" class="form-select" required>
                                <option value="">--Pilih--</option>
                                <?php foreach($courses as $c): ?>
                                <option value="<?= esc($c['course_id']) ?>">
                                    <?= esc($c['course_name']) ?> (<?= esc($c['course_id']) ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Ambil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>