<!DOCTYPE html>
<html lang="cs">
<head>

    <meta charset="UTF-8">

    <title><?= $title ?? 'Filmová databáze' ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">
<style>
.pagination {
    margin-top: 25px;
}

.pagination a,
.pagination strong {
    display: inline-block;
    padding: 10px 15px;
    margin: 0 4px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
}

.pagination a {
    background: #f0f0f0;
    color: #333;
    border: 1px solid #ddd;
}

.pagination a:hover {
    background: #0d6efd;
    color: white;
}

.pagination strong {
    background: #0d6efd;
    color: white;
    border: 1px solid #0d6efd;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">

    <div class="container">

        <a class="navbar-brand" href="<?= base_url('/') ?>">
            FilmDB
        </a>

        <div class="navbar-nav">

            <a class="nav-link" href="<?= base_url('/') ?>">
                Domů
            </a>

            <a class="nav-link" href="<?= base_url('/movies') ?>">
                Filmy
            </a>

            <a class="nav-link" href="<?= base_url('/movies/statistics') ?>">
                Statistiky
            </a>

            <a class="nav-link" href="<?= base_url('/popular') ?>">
                Populární filmy
            </a>

        </div>

        <div>

            <?php if(session()->get('isLoggedIn')): ?>

                <span class="text-white me-2">
                    <?= session()->get('username') ?>
                </span>

                <a
                    href="<?= base_url('/logout') ?>"
                    class="btn btn-outline-light btn-sm"
                >
                    Odhlásit
                </a>

            <?php else: ?>

                <a
                    href="<?= base_url('/login') ?>"
                    class="btn btn-outline-light btn-sm"
                >
                    Přihlášení
                </a>

            <?php endif; ?>

        </div>

    </div>

</nav>

<div class="container">

<?php if(session()->getFlashdata('success')): ?>

    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>

<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>

    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>

<?php endif; ?>