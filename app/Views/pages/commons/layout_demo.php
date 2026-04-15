<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-4"><strong>Custom Layout Demo</strong></h1>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">What is a Master Layout?</h5>
            </div>
            <div class="card-body">
                <p>A master layout is a template that wraps around your page content. It provides:</p>
                <ul class="mb-0">
                    <li><strong>Header:</strong> Navigation and user menu</li>
                    <li><strong>Sidebar:</strong> Navigation menu based on user role</li>
                    <li><strong>Content Section:</strong> Page-specific content</li>
                    <li><strong>Footer:</strong> Copyright and links</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">How This Page Was Created</h5>
            </div>
            <div class="card-body">
                <ol class="mb-0">
                    <li>Created <code>LayoutDemo.php</code> controller</li>
                    <li>Created <code>layout_demo.php</code> view extending main layout</li>
                    <li>Added a route in <code>Routes.php</code></li>
                    <li>Added menu entry with role-based access</li>
                    <li>Page automatically inherits all layout styling</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">File Structure</h5>
            </div>
            <div class="card-body">
                <pre class="mb-0"><code>
app/
├── Controllers/
│   └── LayoutDemo.php
├── Views/
│   ├── layouts/
│   │   └── main.php (extends this)
│   ├── partials/
│   │   ├── header.php
│   │   ├── sidebar.php
│   │   └── footer.php
│   └── pages/commons/
│       └── layout_demo.php (this page)
└── Config/
    └── Routes.php (declares the route)
                </code></pre>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script>
    console.log('Custom Layout Demo Page - Understanding reusable layouts');
</script>
<?= $this->endSection(); ?>
