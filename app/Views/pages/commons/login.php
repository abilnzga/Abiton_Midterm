<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="Gilang Heavy">
    <meta name="keywords" content="Gilang Heavy, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title><?= esc($title ?? 'Login'); ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">

    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <?= $this->include('components/alerts'); ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mt-4">
                                    <h1 class="h2">CI4 CRUD Practical Exam</h1>
                                    <p class="lead">
                                        Sign in to your account to continue
                                    </p>
                                </div>
                                <div class="m-sm-4">
                                    <form action="<?= base_url('login'); ?>" method="POST">
                                        <?= csrf_field(); ?>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg <?= session('errors.inputEmail') ? 'is-invalid' : ''; ?>" type="email" name="inputEmail" value="<?= old('inputEmail'); ?>" placeholder="Enter your email" />
                                            <?php if (session('errors.inputEmail')) : ?>
                                                <div class="text-danger small mt-1"><?= session('errors.inputEmail'); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg <?= session('errors.inputPassword') ? 'is-invalid' : ''; ?>" type="password" name="inputPassword" placeholder="Enter your password" />
                                            <?php if (session('errors.inputPassword')) : ?>
                                                <div class="text-danger small mt-1"><?= session('errors.inputPassword'); ?></div>
                                            <?php endif; ?>
                                            <small>
                                                <a href="<?= base_url('register') ?>">Don't have an account? Register</a>
                                            </small>
                                        </div>
                                        <div class="text-end mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>