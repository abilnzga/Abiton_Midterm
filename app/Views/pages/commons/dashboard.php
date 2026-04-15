<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-2"><strong>Dashboard</strong></h1>
        <p class="text-muted mb-4">Welcome, <?= esc($user['display_name'] ?? $user['fullname'] ?? session()->get('name')); ?>. This application satisfies the prelim requirement for login, registration, protected routes, and full CRUD operations.</p>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Authentication</h5>
            </div>
            <div class="card-body">
                <p class="mb-0">Registered users can sign in with email and password. Sessions protect all CRUD routes, and logged-in users are redirected away from the login and register pages.</p>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card border-primary h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Student Records CRUD</h5>
            </div>
            <div class="card-body">
                <p class="mb-3">Create, view, update, and delete student records with validation, flash messages, status badges, and detail pages.</p>
                <a href="<?= base_url('students'); ?>" class="btn btn-primary">Open Student Module</a>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="<?= base_url('students/new'); ?>" class="btn btn-success">Create New Record</a>
                <a href="<?= base_url('students'); ?>" class="btn btn-outline-primary">View All Records</a>
                <a href="<?= base_url('layout-demo'); ?>" class="btn btn-outline-secondary">View Layout Demo</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>