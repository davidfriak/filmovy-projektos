<?= view('layout/header', ['title' => 'Populární filmy']) ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Domů</a></li>
        <li class="breadcrumb-item active">Populární filmy</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Populární filmy</h1>
    <?php if (session()->get('isLoggedIn')): ?>
        <a href="<?= site_url('popular/addForm') ?>" class="btn btn-success">Přidat populární film</a>
    <?php endif; ?>
</div>

<div class="row">
    <?php foreach ($movies as $movie): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="<?= base_url('uploads/posters/' . ($movie->poster ?: 'default.png')) ?>" class="card-img-top" style="height: 220px; object-fit: cover;" alt="<?= esc($movie->title) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= esc($movie->title) ?></h5>
                    <p class="card-text"><?= esc($movieService->shortText($movie->description)) ?></p>
                    <p><strong>Délka:</strong> <?= esc($movie->duration) ?> minut</p>
                    <p><strong>Hodnocení:</strong> <?= esc($movie->rating) ?> %</p>
                </div>
                <?php if (session()->get('isLoggedIn')): ?>
                    <div class="card-footer">
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePopularModal<?= $movie->pid_popular_movie ?>">Smazat</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="modal fade" id="deletePopularModal<?= $movie->pid_popular_movie ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="<?= site_url('popular/remove/' . $movie->pid_popular_movie) ?>">
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title">Smazat populární film</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Opravdu chceš smazat <strong><?= esc($movie->title) ?></strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušit</button>
                            <button type="submit" class="btn btn-danger">Smazat</button>
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
