<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Learning PHP') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">MyCI4App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('hello') ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('about') ?>">About</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('jobPost') ?>">Job Send Email</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('upload-image') ?>">Image To Pdf</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('convert-doc') ?>">Doc File To Pdf</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('contact') ?>">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page content -->
<main class="container mt-5">
    <?= $this->renderSection('content') ?>
</main>

<!-- Footer -->
<footer class="footer bg-dark text-white text-center" style="height: 36px;">
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <p class="mb-0 small" style="line-height: 1;">&copy; <?= date('Y') ?> MyCI4App</p>
    </div>
</footer>

<!-- jQuery (must be loaded first) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Validation (must come after jQuery) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- View-specific scripts -->
<?= $this->renderSection('scripts') ?>
</body>
</html>
