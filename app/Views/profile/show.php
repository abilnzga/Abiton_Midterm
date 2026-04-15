<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-12 col-xl-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Student Profile</h1>
                <p class="text-muted mb-0">View your account and academic details.</p>
            </div>
            <a href="<?= base_url('profile/edit'); ?>" class="btn btn-primary">Edit Profile</a>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row g-4 align-items-start">
                    <div class="col-12 col-md-4 text-center">
                        <?php if (! empty($user['profile_image'])) : ?>
                            <img src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])); ?>" class="img-fluid rounded-circle border" alt="<?= esc($user['name'] ?? $user['fullname'] ?? 'Profile Image'); ?>" style="width: 180px; height: 180px; object-fit: cover;">
                        <?php else : ?>
                            <div class="rounded-circle border d-inline-flex align-items-center justify-content-center bg-light" style="width: 180px; height: 180px;">
                                <span class="h5 mb-0 text-muted">No Image</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-md-8">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Name</dt>
                            <dd class="col-sm-8"><?= esc($user['name'] ?? $user['fullname'] ?? '-'); ?></dd>

                            <dt class="col-sm-4">Email</dt>
                            <dd class="col-sm-8"><?= esc($user['email'] ?? $user['username'] ?? '-'); ?></dd>

                            <dt class="col-sm-4">Course</dt>
                            <dd class="col-sm-8"><?= esc($user['course'] ?? '-'); ?></dd>

                            <dt class="col-sm-4">Year Level</dt>
                            <dd class="col-sm-8"><?= esc($user['year_level'] ?? '-'); ?></dd>

                            <dt class="col-sm-4">Section</dt>
                            <dd class="col-sm-8"><?= esc($user['section'] ?? '-'); ?></dd>

                            <dt class="col-sm-4">Student ID</dt>
                            <dd class="col-sm-8"><?= esc($user['student_id'] ?? '-'); ?></dd>

                            <dt class="col-sm-4">Phone Number</dt>
                            <dd class="col-sm-8"><?= esc($user['phone'] ?? '-'); ?></dd>

                            <dt class="col-sm-4">Address</dt>
                            <dd class="col-sm-8"><?= esc($user['address'] ?? '-'); ?></dd>

                            <dt class="col-sm-4">Created At</dt>
                            <dd class="col-sm-8"><?= esc($user['created_at'] ?? '-'); ?></dd>

                            <dt class="col-sm-4">Updated At</dt>
                            <dd class="col-sm-8"><?= esc($user['updated_at'] ?? '-'); ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
