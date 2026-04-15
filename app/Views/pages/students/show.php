<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-12 col-xl-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Student Detail</h1>
                <p class="text-muted mb-0">View the complete information for this record.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= base_url('students/' . $student['id'] . '/edit'); ?>" class="btn btn-warning text-dark">Edit</a>
                <a href="<?= base_url('students'); ?>" class="btn btn-outline-secondary">Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Full Name</dt>
                    <dd class="col-sm-8"><?= esc($student['name']); ?></dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8"><?= esc($student['email']); ?></dd>

                    <dt class="col-sm-4">Course</dt>
                    <dd class="col-sm-8"><?= esc($student['course']); ?></dd>

                    <dt class="col-sm-4">Year Level</dt>
                    <dd class="col-sm-8"><?= esc($student['year_level']); ?></dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8"><span class="badge bg-<?= $student['status'] === 'Active' ? 'success' : ($student['status'] === 'Graduated' ? 'primary' : 'secondary'); ?>"><?= esc($student['status']); ?></span></dd>

                    <dt class="col-sm-4">Description</dt>
                    <dd class="col-sm-8"><?= esc($student['description']); ?></dd>

                    <dt class="col-sm-4">Created At</dt>
                    <dd class="col-sm-8"><?= esc($student['created_at']); ?></dd>

                    <dt class="col-sm-4">Updated At</dt>
                    <dd class="col-sm-8"><?= esc($student['updated_at']); ?></dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>