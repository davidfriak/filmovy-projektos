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