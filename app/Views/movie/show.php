<?= view('layout/header', ['title' => $movie->title]) ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Domů</a></li>
        <li class="breadcrumb-item"><a href="<?= site_url('movies') ?>">Filmy</a></li>
        <li class="breadcrumb-item active"><?= esc($movie->title) ?></li>
    </ol>
</nav>

<div class="card">
    <div class="card-header">
        <h1><?= esc($movie->title) ?></h1>
    </div>

    <div class="card-body">

        <?php if (!empty($movie->poster)): ?>
            <img
                src="<?= base_url('uploads/posters/' . $movie->poster) ?>"
                class="img-fluid mb-3"
                style="max-height: 400px;"
                alt="<?= esc($movie->title) ?>"
            >
        <?php endif; ?>

        <p>
            <strong>Datum vydání:</strong>
            <?php
                $date = $movie->published_at ?? $movie->release_date;
                echo is_numeric($date) ? 'Neuvedeno' : date('d.m.Y', strtotime($date));
            ?>
        </p>

        <p>
            <strong>Délka:</strong>
            <?= esc($movie->duration) ?> minut
        </p>

        <p>
            <strong>Hodnocení:</strong>
            <?= esc($movie->rating) ?> %
        </p>

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

        <p>
            <strong>Vytvořeno:</strong>
            <?= !empty($movie->created_at) && !is_numeric($movie->created_at) ? date('d.m.Y H:i', strtotime($movie->created_at)) : 'Neuvedeno' ?>
        </p>

        <p>
            <strong>Upraveno:</strong>
            <?= !empty($movie->updated_at) && !is_numeric($movie->updated_at) ? date('d.m.Y H:i', strtotime($movie->updated_at)) : 'Neuvedeno' ?>
        </p>

        <hr>

        <h3>Herci</h3>

        <?php if (!empty($actors)): ?>
            <ul>
                <?php foreach ($actors as $actor): ?>
                    <li>
                        <?= esc($actor->name) ?> <?= esc($actor->surname) ?>
                        <?php if (!empty($actor->role_name)): ?>
                            — role: <?= esc($actor->role_name) ?>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Herci nejsou přiřazeni.</p>
        <?php endif; ?>

        <hr>

        <h3>Popis</h3>

        <div>
            <?= $movie->description ?>
        </div>
    </div>
</div>

<a href="<?= site_url('movies') ?>" class="btn btn-secondary mt-3">
    Zpět
</a>

<?= view('layout/footer') ?>