<?= view('layout/header', ['title' => 'Statistiky']) ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Domů</a></li>
        <li class="breadcrumb-item active">Statistiky</li>
    </ol>
</nav>

<h1>Statistiky</h1>

<div class="row">

    <div class="col-md-6">

        <div class="card mb-3">

            <div class="card-body">

                <h3>Počet filmů</h3>

                <p class="display-6">
                    <?= esc($totalMovies) ?>
                </p>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card mb-3">

            <div class="card-body">

                <h3>Průměrné hodnocení</h3>

                <p class="display-6">
                    <?= round($averageRating->average_rating ?? 0, 2) ?> %
                </p>

            </div>

        </div>

    </div>

</div>

<a href="<?= base_url('/movies') ?>" class="btn btn-secondary">
    Zpět na filmy
</a>

<?= view('layout/footer') ?>