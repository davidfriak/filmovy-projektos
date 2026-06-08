<?= view('layout/header', ['title' => 'Filmy']) ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Domů</a></li>
        <li class="breadcrumb-item active">Filmy</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Filmy</h1>

    <?php if (session()->get('isLoggedIn')): ?>
        <a href="<?= site_url('movies/addForm') ?>" class="btn btn-success">
            Přidat film
        </a>
    <?php endif; ?>
</div>

<div class="row">
    <?php foreach ($movies as $movie): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">

                <div class="card-body">
                    <h5 class="card-title">
                        <?= esc($movie->title) ?>
                    </h5>

                    <p class="card-text">
                        <?= substr(strip_tags($movie->description), 0, 120) ?>...
                    </p>

                    <p>
                        <strong>Délka:</strong> <?= esc($movie->duration) ?> minut
                    </p>

                    <p>
                        <strong>Hodnocení:</strong> <?= esc($movie->rating) ?> %
                    </p>
                </div>

                <div class="card-footer">
                    <a href="<?= site_url('movies/show/' . $movie->pid_movie) ?>" class="btn btn-primary btn-sm">
                        Detail
                    </a>

                    <?php if (session()->get('isLoggedIn')): ?>
                        <a href="<?= site_url('movies/editForm/' . $movie->pid_movie) ?>" class="btn btn-warning btn-sm">
                            Upravit
                        </a>

                        <button
                            class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal<?= $movie->pid_movie ?>"
                        >
                            Smazat
                        </button>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <div class="modal fade" id="deleteModal<?= $movie->pid_movie ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form method="post" action="<?= site_url('movies/remove/' . $movie->pid_movie) ?>">
                        <?= csrf_field() ?>

                        <div class="modal-header">
                            <h5 class="modal-title">Smazat film</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            Opravdu chceš smazat film
                            <strong><?= esc($movie->title) ?></strong>?
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Zrušit
                            </button>

                            <button type="submit" class="btn btn-danger">
                                Smazat
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="text-center">
    <?= $pager->links() ?>
</div>

<?= view('layout/footer') ?>