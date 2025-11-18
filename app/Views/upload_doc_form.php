
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Document File to Convert PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4">Convert Docs to PDF</h2>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('convert-doc-pdf') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="docs" class="form-label">Choose Docs</label>
                <input type="file" name="docs" id="docs" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Convert & Download PDF</button>
        </form>
    </div>
</div>

</body>
</html>
<?= $this->endSection() ?>
