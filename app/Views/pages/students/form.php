<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<?php
$studentData = $student ?? [];
$isEdit = $method === 'PUT';
?>

<div class="row justify-content-center">
    <div class="col-12 col-xl-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1"><?= esc($title); ?></h1>
                <p class="text-muted mb-0"><?= $isEdit ? 'Update the existing student record.' : 'Create a new student record for the CRUD module.'; ?></p>
            </div>
            <a href="<?= base_url('students'); ?>" class="btn btn-outline-secondary">Back to List</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="<?= $action; ?>" method="post">
                    <?= csrf_field(); ?>
                    <?php if ($isEdit) : ?>
                        <input type="hidden" name="_method" value="PUT">
                    <?php endif; ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control <?= session('errors.name') ? 'is-invalid' : ''; ?>" value="<?= old('name', $studentData['name'] ?? ''); ?>">
                            <?php if (session('errors.name')) : ?>
                                <div class="text-danger small mt-1"><?= session('errors.name'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control <?= session('errors.email') ? 'is-invalid' : ''; ?>" value="<?= old('email', $studentData['email'] ?? ''); ?>">
                            <?php if (session('errors.email')) : ?>
                                <div class="text-danger small mt-1"><?= session('errors.email'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label for="course" class="form-label">Course</label>
                            <input type="text" id="course" name="course" class="form-control <?= session('errors.course') ? 'is-invalid' : ''; ?>" value="<?= old('course', $studentData['course'] ?? ''); ?>">
                            <?php if (session('errors.course')) : ?>
                                <div class="text-danger small mt-1"><?= session('errors.course'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label for="year_level" class="form-label">Year Level</label>
                            <?php $selectedYear = old('year_level', $studentData['year_level'] ?? 'First Year'); ?>
                            <select id="year_level" name="year_level" class="form-select <?= session('errors.year_level') ? 'is-invalid' : ''; ?>">
                                <?php foreach (['First Year', 'Second Year', 'Third Year', 'Fourth Year'] as $yearOption) : ?>
                                    <option value="<?= $yearOption; ?>" <?= $selectedYear === $yearOption ? 'selected' : ''; ?>><?= $yearOption; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (session('errors.year_level')) : ?>
                                <div class="text-danger small mt-1"><?= session('errors.year_level'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <?php $selectedStatus = old('status', $studentData['status'] ?? 'Active'); ?>
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select <?= session('errors.status') ? 'is-invalid' : ''; ?>">
                                <?php foreach (['Active', 'Inactive', 'Graduated'] as $statusOption) : ?>
                                    <option value="<?= $statusOption; ?>" <?= $selectedStatus === $statusOption ? 'selected' : ''; ?>><?= $statusOption; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (session('errors.status')) : ?>
                                <div class="text-danger small mt-1"><?= session('errors.status'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" rows="5" class="form-control <?= session('errors.description') ? 'is-invalid' : ''; ?>"><?= old('description', $studentData['description'] ?? ''); ?></textarea>
                            <?php if (session('errors.description')) : ?>
                                <div class="text-danger small mt-1"><?= session('errors.description'); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Update Record' : 'Create Record'; ?></button>
                        <a href="<?= base_url('students'); ?>" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>