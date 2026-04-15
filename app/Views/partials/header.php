<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard'); ?>">CI4 CRUD Exam</a>
            </li>
            <li class="nav-item d-none d-md-inline-block">
                <a class="nav-link" href="<?= base_url('students'); ?>">Student Records</a>
            </li>
            <li class="nav-item d-none d-md-inline-block">
                <a class="nav-link" href="<?= base_url('students/new'); ?>">Add Student</a>
            </li>
            <li class="nav-item d-none d-md-inline-block">
                <a class="nav-link" href="<?= base_url('profile'); ?>">My Profile</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="<?= base_url('assets/images/avatar.png') ?>" class="avatar img-fluid rounded me-1" alt="<?= esc($user['display_name'] ?? $user['fullname'] ?? session()->get('name')); ?>" /> <span class="text-dark"><?= esc($user['display_name'] ?? $user['fullname'] ?? session()->get('name')); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="<?= base_url('profile'); ?>">My Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('logout'); ?> ">Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
