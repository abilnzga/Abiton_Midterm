<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-3"><strong>Master Layout</strong> Activity</h1>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">How This Page Reuses The Layout</h5>
            </div>
            <div class="card-body">
                <ol class="mb-0">
                    <li>This page extends <code>layouts/main</code>.</li>
                    <li>The header, sidebar, footer, and alerts come from the layout includes.</li>
                    <li>Only this content section changes per page.</li>
                    <li>Page-specific scripts can be added in the <code>javascript</code> section.</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Route</h5>
            </div>
            <div class="card-body">
                <p class="mb-0"><code>/master-layout</code></p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script>
    console.log('Master Layout Activity page loaded');
</script>
<?= $this->endSection(); ?>
