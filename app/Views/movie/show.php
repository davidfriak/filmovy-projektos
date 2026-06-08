<?= view('layout/header', ['title' => $movie->title]) ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Domů</a></li>
        <li class="breadcrumb-item"><a href="<?= site_url('movies') ?>">Filmy</a></li>
        <li class="breadcrumb-item active"><?= esc($movie->title) ?></li>
    </ol>
</nav>

<?php
$releaseDate = 'Neuvedeno';

if (!empty($movie->release_date)) {
    $timestamp = (int)$movie->release_date;

    $year = (int)date('Y', $timestamp);

    // Pokud je rok větší než 2026, nastav náhodný rok 2000–2026
    if ($year > 2026) {
        $randomYear = rand(2000, 2026);

        $timestamp = mktime(
            0,
            0,
            0,
            (int)date('m', $timestamp),
            (int)date('d', $timestamp),
            $randomYear
        );
    }

    $releaseDate = date('d.m.Y', $timestamp);
}
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1><?= esc($movie->title) ?></h1>
    </div>

    <div class="card-body">
        <p><strong>Datum vydání:</strong> <?= esc($releaseDate) ?></p>

        <p><strong>Délka:</strong> <?= esc($movie->duration) ?> minut</p>

        <p><strong>Hodnocení:</strong> <?= esc($movie->rating) ?> %</p>

        <p>
            <strong>Žánry:</strong>
            <?php if (!empty($genres)): ?>
                <?php foreach ($genres as $genre): ?>
                    <span class="badge bg-primary"><?= esc($genre->name) ?></span>
                <?php endforeach; ?>
            <?php else: ?>
                Neuvedeno
            <?php endif; ?>
        </p>

        <hr>

        <h3>Herci</h3>

        <?php if (!empty($actors)): ?>
            <ul>
                <?php foreach ($actors as $actor): ?>
                    <li>
                        <?= esc($actor->name) ?> <?= esc($actor->surname) ?>
                        <?php if (!empty($actor->role_name)): ?>
                           <?= esc($actor->role_name) ?>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Herci nejsou přiřazeni.</p>
        <?php endif; ?>

        <hr>

        <h3>Popis</h3>
        <p><?= esc($movie->description) ?></p>
    </div>
</div>

<a href="<?= site_url('movies') ?>" class="btn btn-secondary mt-3">
    Zpět
</a>

<?= view('layout/footer') ?>