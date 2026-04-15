<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-start">
                <p class="mb-0">
                    <strong>CI4 CRUD Exam App</strong> &copy; Your Name <?= date('Y'); ?> | Page rendered in {elapsed_time} seconds | Environment: <?= ucfirst(ENVIRONMENT) ?>
                </p>
            </div>
            <div class="col-6 text-end">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-muted" href="<?= base_url('dashboard'); ?>">Dashboard</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="<?= base_url('students'); ?>">Student Records</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
