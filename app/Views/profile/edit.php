<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-12 col-xl-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Edit Profile</h1>
                <p class="text-muted mb-0">Update your student and contact details.</p>
            </div>
            <a href="<?= base_url('profile'); ?>" class="btn btn-outline-secondary">Back to Profile</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('profile/update'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control <?= session('errors.name') ? 'is-invalid' : ''; ?>" value="<?= old('name', esc($user['name'] ?? $user['fullname'] ?? '')); ?>">
                            <?php if (session('errors.name')) : ?>
                                <div class="invalid-feedback"><?= session('errors.name'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control <?= session('errors.email') ? 'is-invalid' : ''; ?>" value="<?= old('email', esc($user['email'] ?? $user['username'] ?? '')); ?>">
                            <?php if (session('errors.email')) : ?>
                                <div class="invalid-feedback"><?= session('errors.email'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" id="student_id" name="student_id" class="form-control <?= session('errors.student_id') ? 'is-invalid' : ''; ?>" value="<?= old('student_id', esc($user['student_id'] ?? '')); ?>">
                            <?php if (session('errors.student_id')) : ?>
                                <div class="invalid-feedback"><?= session('errors.student_id'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <label for="course" class="form-label">Course</label>
                            <input type="text" id="course" name="course" class="form-control <?= session('errors.course') ? 'is-invalid' : ''; ?>" value="<?= old('course', esc($user['course'] ?? '')); ?>">
                            <?php if (session('errors.course')) : ?>
                                <div class="invalid-feedback"><?= session('errors.course'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <label for="year_level" class="form-label">Year Level</label>
                            <?php $yearValue = old('year_level', esc((string) ($user['year_level'] ?? ''))); ?>
                            <select id="year_level" name="year_level" class="form-select <?= session('errors.year_level') ? 'is-invalid' : ''; ?>">
                                <option value="">Select year level</option>
                                <?php foreach ([1, 2, 3, 4, 5] as $year) : ?>
                                    <option value="<?= $year; ?>" <?= (string) $yearValue === (string) $year ? 'selected' : ''; ?>><?= $year; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (session('errors.year_level')) : ?>
                                <div class="invalid-feedback"><?= session('errors.year_level'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="section" class="form-label">Section</label>
                            <input type="text" id="section" name="section" class="form-control <?= session('errors.section') ? 'is-invalid' : ''; ?>" value="<?= old('section', esc($user['section'] ?? '')); ?>">
                            <?php if (session('errors.section')) : ?>
                                <div class="invalid-feedback"><?= session('errors.section'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" id="phone" name="phone" class="form-control <?= session('errors.phone') ? 'is-invalid' : ''; ?>" value="<?= old('phone', esc($user['phone'] ?? '')); ?>">
                            <?php if (session('errors.phone')) : ?>
                                <div class="invalid-feedback"><?= session('errors.phone'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea id="address" name="address" rows="3" class="form-control <?= session('errors.address') ? 'is-invalid' : ''; ?>"><?= old('address', esc($user['address'] ?? '')); ?></textarea>
                            <?php if (session('errors.address')) : ?>
                                <div class="invalid-feedback"><?= session('errors.address'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" id="profile_image" name="profile_image" accept="image/*" class="form-control <?= session('errors.profile_image') ? 'is-invalid' : ''; ?>">
                            <?php if (session('errors.profile_image')) : ?>
                                <div class="invalid-feedback"><?= session('errors.profile_image'); ?></div>
                            <?php endif; ?>
                            <small class="text-muted d-block mt-1">Allowed: JPG, PNG, WEBP. Max size: 2MB.</small>
                        </div>

                        <div class="col-md-6">
                            <?php
                            $previewImage = ! empty($user['profile_image'])
                                ? base_url('uploads/profiles/' . esc($user['profile_image']))
                                : base_url('assets/images/avatar.png');
                            ?>
                            <label class="form-label">Preview</label>
                            <div>
                                <img id="preview" src="<?= $previewImage; ?>" class="img-thumbnail" alt="Profile preview" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="<?= base_url('profile'); ?>" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('profile_image');
    const preview = document.getElementById('preview');

    if (!fileInput || !preview) {
        return;
    }

    fileInput.addEventListener('change', function (event) {
        if (!event.target.files || !event.target.files[0]) {
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
});
</script>
<?= $this->endSection(); ?>
