<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 mb-1">Student Records</h1>
        <p class="text-muted mb-0">Manage student records through a protected CRUD module built with CodeIgniter 4.</p>
    </div>
    <a href="<?= base_url('students/new'); ?>" class="btn btn-primary">Add New Student</a>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($students)) : ?>
                    <?php foreach ($students as $student) : ?>
                        <tr>
                            <td>
                                <a href="<?= base_url('students/' . $student['id']); ?>" class="fw-semibold text-decoration-none">
                                    <?= esc($student['name']); ?>
                                </a>
                            </td>
                            <td><?= esc($student['email']); ?></td>
                            <td><?= esc($student['course']); ?></td>
                            <td><?= esc($student['year_level']); ?></td>
                            <td>
                                <?php $badgeClass = $student['status'] === 'Active' ? 'success' : ($student['status'] === 'Graduated' ? 'primary' : 'secondary'); ?>
                                <span class="badge bg-<?= $badgeClass; ?>"><?= esc($student['status']); ?></span>
                            </td>
                            <td class="text-end">
                                <a href="<?= base_url('students/' . $student['id']); ?>" class="btn btn-sm btn-outline-secondary">View</a>
                                <a href="<?= base_url('students/' . $student['id'] . '/edit'); ?>" class="btn btn-sm btn-warning text-dark">Edit</a>
                                <form action="<?= base_url('students/' . $student['id']); ?>" method="post" class="d-inline" onsubmit="return confirm('Delete this student record?');">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center py-4">No student records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (isset($pager)) : ?>
        <div class="card-footer d-flex justify-content-center">
            <?= $pager->links(); ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>